<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Faq;
use App\Models\TeamMember;
use App\Models\Village;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'featured' => Article::published()->where('is_featured', true)->first() ?? Article::published()->first(),
            'articles' => Article::published()->take(4)->get(),
            'activities' => Activity::published()->with('village')->take(4)->get(),
            'stats' => [
                'villages' => Village::count(),
                'activities' => Activity::where('status', 'published')->count(),
            ],
        ]);
    }

    public function about()
    {
        $team = TeamMember::active()->get()->groupBy('group');

        return view('pages.about', [
            'researchers' => $team->get('peneliti', collect()),
            'staff' => $team->get('pelaksana', collect()),
        ]);
    }

    public function education()
    {
        return view('pages.education', [
            'faqs' => Faq::active()->get()->groupBy('category'),
        ]);
    }

    public function villages()
    {
        $villages = Village::withCount(['activities' => fn ($q) => $q->where('status', 'published')])
            ->orderBy('order_index')->get();

        return view('pages.villages', [
            'districts' => $villages->groupBy('district'),
            'total' => $villages->count(),
        ]);
    }

    public function villageMapData()
    {
        $data = json_decode(
            File::get(resource_path('data/bicsmart-12-villages.geojson')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        if (($data['type'] ?? null) !== 'FeatureCollection'
            || !is_array($data['features'] ?? null)
            || count($data['features']) !== 12) {
            throw new \LogicException('The village map data must contain 12 GeoJSON features.');
        }

        $villages = Village::query()->get(['slug', 'district'])->keyBy('slug');

        foreach ($data['features'] as &$feature) {
            $name = $feature['properties']['name'] ?? null;
            if (!is_string($name) || !isset($feature['geometry'])) {
                throw new \LogicException('A village map feature is missing its name or geometry.');
            }

            $slug = Str::slug(Str::after($name, 'Desa '), '_');
            $village = $villages->get($slug);

            if (!$village) {
                throw new \LogicException("No village record matches the map feature \"{$name}\".");
            }

            $feature['properties'] = [
                'name' => $name,
                'district' => $village->district,
            ];
        }
        unset($feature);

        return response()->json($data);
    }
}
