<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading(! $this->app->isProduction());
        Paginator::useBootstrapFive();

        View::composer('Front.app.navbar', function ($view) {
            $categories = Category::withCount(['estates'])
                ->orderBy('sort_order')
                ->orderBy('slug')
                ->get();
            $locations = Location::withCount(['estates'])
                ->orderBy('sort_order')
                ->orderBy('slug')
                ->get();

            return $view->with([
                'categories' => $categories,
                'locations' => $locations,
            ]);
        });
        View::composer('Front.app.footer', function ($view) {
            $categories = Category::withCount(['estates'])
                ->orderBy('sort_order')
                ->orderBy('slug')
                ->get();
            $locations = Location::withCount(['estates'])
                ->orderBy('sort_order')
                ->orderBy('slug')
                ->get();

            return $view->with([
                'categories' => $categories,
                'locations' => $locations,
            ]);
        });
    }

}
