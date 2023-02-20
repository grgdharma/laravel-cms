<?php

namespace App\Providers;
use App\Models\General;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
class GeneralServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('generals', function ($app) {
            return new General();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('General', General::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Only use the General package if the General table is present in the database
        if (!\App::runningInConsole() && count(Schema::getColumnListing('generals'))) {
            $generals = General::all();
            foreach ($generals as $key => $general)
            {
                Config::set('generals.'.$general->key, $general->value);
            }
        }
    }
}
