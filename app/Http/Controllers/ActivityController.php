<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Village;
use Illuminate\Http\Request;

/**
 * Dokumentasi kegiatan harian (publik).
 */
class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->string('kategori')->toString();
        $village = $request->string('desa')->toString();
        $month = $request->string('bulan')->toString(); // format YYYY-MM

        $activities = Activity::published()->with('village')
            ->when(array_key_exists($category, Activity::CATEGORIES), fn ($x) => $x->where('category', $category))
            ->when($village !== '', fn ($x) => $x->whereHas('village', fn ($v) => $v->where('slug', $village)))
            ->when(preg_match('/^\d{4}-\d{2}$/', $month), fn ($x) => $x->whereYear('activity_date', substr($month, 0, 4))->whereMonth('activity_date', substr($month, 5, 2)))
            ->paginate(12)->withQueryString();

        // Kelompokkan per bulan untuk tampilan linimasa
        $grouped = $activities->getCollection()->groupBy(fn ($a) => $a->activity_date->translatedFormat('F Y'));

        $months = Activity::where('status', 'published')->pluck('activity_date')
            ->map(fn ($d) => $d->format('Y-m'))->unique()->sortDesc()->values();

        return view('activities.index', [
            'activities' => $activities,
            'grouped' => $grouped,
            'villages' => Village::orderBy('order_index')->get(),
            'months' => $months,
            'filters' => compact('category', 'village', 'month'),
        ]);
    }

    public function show(Activity $activity)
    {
        abort_unless($activity->status === 'published', 404);

        return view('activities.show', [
            'activity' => $activity->load('village', 'author'),
            'others' => Activity::published()->whereKeyNot($activity->id)->with('village')->take(3)->get(),
        ]);
    }
}
