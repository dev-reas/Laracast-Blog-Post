<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->username === 'RigorSagun';
        });

        // A custom blade directive to check if the user is admin or not. instead of calling @can('admin), we can use @admin instead
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
