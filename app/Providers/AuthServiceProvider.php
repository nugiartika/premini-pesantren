<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
<<<<<<< Updated upstream
        Berita::class => BeritaPolicy::class,
        Gallery::class => GalleryPolicy::class,
        Kelulusan::class => KelulusanPolicy::class,
=======

        'App\Models\Asatidlist' => 'App\Policies\AsatidlistPolicy',

>>>>>>> Stashed changes
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
