<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

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
    public function boot(Dispatcher $events)
    {
        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
            $event->menu->add('MENU DE NAVEGACION');

            $event->menu->add(
                [
                    'text'  => 'Escritorio',
                    'route' => 'home',
                    'icon'  => 'dashboard'
                ],
                [
                    'text'  => 'Perfil',
                    'route' => 'profile',
                    'icon'  => 'user'
                ],
                [
                    'text'  => 'Vendedores',
                    'route' => 'users.index',
                    'icon'  => 'money'
                ],
                [
                    'text'  => 'Clientes',
                    'route' => 'customers.index',
                    'icon'  => 'users'
                ],
                [
                    'text'  => 'Productos',
                    'route' => 'products.index',
                    'icon'  => 'list'
                ],
                [
                    'text'  => 'Ordenes',
                    'route' => 'orders.index',
                    'icon'  => 'file'
                ]
            );
        });
    }
}
