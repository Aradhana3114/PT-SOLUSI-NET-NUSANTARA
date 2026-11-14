<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::share('setting', new SiteSetting([
            'site_name' => 'PT Solusi Net Nusantara',
            'email' => 'info@solusikoneksianda.com',
            'phone' => '6281295312290',
        ]));
        try {
            if (Schema::hasTable('site_settings')) {
                View::share('setting', SiteSetting::current());
            }
        } catch (Throwable) {

        }
    }
}
