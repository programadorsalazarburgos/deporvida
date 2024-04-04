<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);
         \URL::forceRootUrl(\Config::get('app.url'));
        // And this if you wanna handle https URL scheme
        // It's not usefull for http://www.example.com, it's just to make it more independant from the constant value
        if (Str::contains(\Config::get('app.url'), 'https://'))
        {
            \URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {






        $this->registerBindings();
        $this->registerViewComposers();
    }

    /**
     * Binds to the application
     */
    public function registerBindings(){
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );
    }

    /**
     * View Composers
     */
    public function registerViewComposers(){
        $view = $this->app->make('view');
        $view->composer("app", 'App\ViewComposers\NgServicesAndControllersComposer');
        $view->composer("app2", 'App\ViewComposers\NgServicesAndControllersComposer');
         $view->composer("postsider.appsider", 'App\ViewComposers\NgServicesAndControllersComposer');
         $view->composer("posteps.appeps", 'App\ViewComposers\NgServicesAndControllersComposer');


        $view->composer("postroles.approles", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postusuarios.appusuarios", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postprogramas.appprogramas", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postzonas.appzonas", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postcomunas.appcomunas", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postbarrios.appbarrios", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postinstituciones.appinstituciones", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postsedes.appsedes", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("posttipoescenarios.apptipoescenarios", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postescenarios.appescenarios", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postgrupos.appgrupos", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postbeneficiarios.appbeneficiarios", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postlocalizacion.applocalizacion", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postreporteficha.appreporteficha", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postreporteficha.appreportefichabasica", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postreporteparrilla.appreporteparrilla", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postreporteador.appreporteador", 'App\ViewComposers\NgServicesAndControllersComposer');

        $view->composer("postevaluaciones.appevaluaciones", 'App\ViewComposers\NgServicesAndControllersComposer');

    }
}
