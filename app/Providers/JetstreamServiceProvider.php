<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerComponent('welcome_entrepreneur');
        $this->registerComponentadmin('welcome_admin');
        $this->registerComponentadmin('welcome_bank');
        $this->registerComponentadmin('welcome_acounthead');
        $this->registerComponentadmin('welcome_associatedirector');
        $this->registerComponentadmin('welcome_department');
        $this->registerComponentadmin('welcome_systemadmin');
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }

    protected function registerComponent(string $component) {
    \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
}
    protected function registerComponentadmin(string $component) {
    \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
}

}
