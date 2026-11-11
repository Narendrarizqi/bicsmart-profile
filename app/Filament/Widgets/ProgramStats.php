<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Village;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProgramStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();
        $mine = Activity::where('author_id', $user->id);

        if (! $user->canPublish()) {
            return [
                Stat::make('Catatan saya', (clone $mine)->count())->icon('heroicon-o-camera'),
                Stat::make('Menunggu persetujuan', (clone $mine)->where('status', 'draft')->count())->color('warning')->icon('heroicon-o-clock'),
                Stat::make('Sudah terbit', (clone $mine)->where('status', 'published')->count())->color('success')->icon('heroicon-o-check-circle'),
            ];
        }

        return [
            Stat::make('Dokumentasi bulan ini', Activity::whereYear('activity_date', now()->year)->whereMonth('activity_date', now()->month)->count())
                ->description('Total '.Activity::count().' catatan')->icon('heroicon-o-camera')->color('primary'),
            Stat::make('Draf menunggu persetujuan', Activity::where('status', 'draft')->count())
                ->description('Dari kontributor lapangan')->icon('heroicon-o-clock')->color('warning'),
            Stat::make('Berita terbit', Article::where('status', 'published')->count())
                ->description(Article::where('status', 'draft')->count().' draf')->icon('heroicon-o-newspaper'),
            Stat::make('Desa mitra', Village::count())->icon('heroicon-o-map')->color('info'),
        ];
    }
}
