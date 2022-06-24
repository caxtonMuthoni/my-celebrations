<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
        
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->greeting("Dear $notifiable->name,")
                ->line("Hi $notifiable->name, Welcome to MyCelebrationBooks. We're thrilled to see you here! We're confident that our service will help you greatly.")
                ->line('Click the button below to activate your account.')
                ->action('Verify Email Address', $url);
        });


        Gate::define('free-subscription', function (User $user) {
            return Book::where('user_id', $user->id)->count() < 1;
        });

        Gate::define('hasPlan', function (User $user) {
            $subs = Subscriber::where([['user_id', $user->id], ['is_active', true]])->count();
            $books = Book::where('user_id', $user->id)->count();
            return  ($subs > 0) || ($books <= 0);
        });
    }
}
