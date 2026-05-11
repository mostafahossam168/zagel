<?php

namespace App\Providers;

use App\Interfaces\AdminInterface;
use App\Interfaces\AuthInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\FaqInterface;
use App\Interfaces\PartnerInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AdminRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FaqRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\RoleInterfaceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(RoleInterface::class, RoleInterfaceRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(PartnerInterface::class, PartnerRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(FaqInterface::class, FaqRepository::class);
    }

    public function boot(): void {}
}
