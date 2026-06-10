<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'partials.*', 'admin.layout', 'admin.login'], function ($view): void {
            $logo = SiteSetting::get('image_logo_kemenhaj', 'images/logo-kemenhaj.png');

            $view->with([
                's' => SiteSetting::allKeyed(),
                'siteTitle' => SiteSetting::get('site_title', 'Kementerian Haji dan Umrah Kabupaten Purbalingga'),
                'siteFavicon' => asset($logo),
            ]);
        });
    }
}
