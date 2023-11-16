<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Blade::directive('thumbnail', function ($expression) {
            return "<?php echo formatThumbnail($expression); ?>";
        });
        Blade::directive('currency', function ($expression) {
            return "<?php echo formatCurrency($expression); ?>";
        });
        Blade::directive('sec2HMS', function ($expression) {
            return "<?php echo sec2HMS($expression);?>";
        });
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
