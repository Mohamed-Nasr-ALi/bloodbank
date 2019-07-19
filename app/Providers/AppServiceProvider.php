<?php

namespace App\Providers;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $bloodtypes=BloodType::all();
        view()->share(['bloodtypes'=>$bloodtypes]);

        $categories=Category::all();
        view()->share(['categories'=>$categories]);

        $governorates=Governorate::all();
        view()->share(['governorates'=>$governorates]);

        $settings=Setting::all();
        view()->share(['settings'=>$settings]);

        $cities=City::all();
        view()->share(['cities'=>$cities]);

    }
}
