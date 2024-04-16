<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        Paginator::useBootstrap();

        Blade::directive('can', function (...$expression) {
            return  '<?php if(isAutherized('.implode(",",$expression).')){ ?>';
        });
        Blade::directive('endcan', function () {
            return  "<?php } ?>";
        });
    }
}
