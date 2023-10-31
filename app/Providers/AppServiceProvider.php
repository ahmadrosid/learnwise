<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Blade::directive('thumbnail', function ($expression) {
            return "<?php echo formatThumbnail($expression); ?>";
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Blade::directive('currency', function ($expression) {
            return formatCurrency($expression);
            // $currency = getenv('CURRENCY');
            //

        });
    }
}
