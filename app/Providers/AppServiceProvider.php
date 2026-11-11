<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale(config('app.locale', 'id'));

        // Super Admin boleh melakukan semua aksi.
        Gate::before(fn (User $user) => $user->isSuperAdmin() ? true : null);

        // FAQ untuk widget maskot di semua halaman publik.
        View::composer('partials.mascot-widget', function ($view) {
            $view->with('widgetFaqs', Faq::active()->where('show_in_widget', true)->take(8)->get());
        });
    }
}
