<?php

namespace App\Providers;

use App\Models\Gepex;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(
            BuildingMenu::class,
            function (BuildingMenu $event) {

                // Add some items to the menu...

                $event->menu->addAfter('menu', [
                    'text' => 'GEPEX Finalizadas',
                    'url'  => 'admin/gepex-finalizadas',
                    'icon' => 'fas fa-duotone fa-map-pin',
                    'can' => 'prefeito',
                    'label' => Gepex::where('status', 'FINALIZADO')->count(),



                ]);
                $event->menu->addAfter('menu',[
                    'text' => 'GEPEX em Execução',
                    'url'  => 'admin/gepex-execucao',
                    'icon' => 'fas fa-upload',
                    'can' => 'prefeito',
                    'label' => Gepex::where('status', 'EM EXECUÇÃO')->count(),
                ]);
                $event->menu->addAfter('menu',[
                    'text' => 'GEPEX Aprovadas',
                    'url'  => 'admin/gepex-aprovacao',
                    'icon' => 'fas fa-download',
                    'can' => 'prefeito',
                    'label' => Gepex::where('status', 'APROVADO')->count(),
                ]);

                $event->menu->addAfter('menu', [
                    'text' => 'GEPEX Enviadas',
                    'url'  => 'admin/gepex-enviadas',
                    'icon' => 'fas fa-upload',
                    'can' => 'prefeito',
                    'label' => Gepex::where('status', 'ENVIADO')->count(),



                ]);
               
                $event->menu->addAfter(
                    'menu',
                    
                 [
            'text' => 'Minhas GEPEXs',
            'url'  => 'admin/gepex',
            'icon' => 'fas fa-duotone fa-folder-open',
            'can' => 'secretaria'
            
        ],
         );
         
            }
            
        );
    }
}
