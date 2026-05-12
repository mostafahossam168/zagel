<?php

namespace App\Providers;

use App\Interfaces\AdminInterface;
use App\Interfaces\AuthInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\FaqInterface;
use App\Interfaces\PartnerInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\ServiceInterface;
use App\Interfaces\TestimonialInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AdminRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FaqRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\RoleInterfaceRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\UserRepository;
use App\Models\Contact;
use App\Models\ProjectSubmission;
use App\Models\ProviderListing;
use App\Observers\ContactObserver;
use App\Observers\ProjectSubmissionObserver;
use App\Observers\ProviderListingObserver;
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
        $this->app->bind(ServiceInterface::class, ServiceRepository::class);
        $this->app->bind(TestimonialInterface::class, TestimonialRepository::class);
    }

    public function boot(): void
    {
        ProjectSubmission::observe(ProjectSubmissionObserver::class);
        ProviderListing::observe(ProviderListingObserver::class);
        Contact::observe(ContactObserver::class);
    }
}
