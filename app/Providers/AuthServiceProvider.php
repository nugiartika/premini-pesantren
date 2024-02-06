<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Berita;
use App\Models\Kelulusan;
use App\Policies\BeritaPolicy;
use App\Policies\KelulusanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Berita::class => BeritaPolicy::class,
        Gallery::class => GalleryPolicy::class,
        Kelulusan::class => KelulusanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
