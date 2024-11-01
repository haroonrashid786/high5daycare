<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Blade directives
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>"; //return this if statement inside php tag
        });
        
        Blade::directive('elserole', function ($role) {
            return "<?php elseif(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('else', function () {
            return '<?php else : ?>';
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>"; //return this endif statement inside php tag
        });

        // @role('user')

        //     This is user role

        // @endrole
    }
}
