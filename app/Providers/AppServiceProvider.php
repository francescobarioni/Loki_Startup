<?php

namespace App\Providers;

use App\Models\Marketplace;
use App\Models\Rating;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // --- PAGINATOR --- //
        Paginator::useBootstrap();

        // --- MARKETPLACE --- //
        // Permission to create on Marketplace model
        Gate::define('create_marketplace', function (User $user) {
            return $user->role == User::ROLE_ADMIN;
        });

        // Permission to update on Marketplace model
        Gate::define('update_marketplace', function (User $user) {
            return $user->role == User::ROLE_ADMIN;
        });

        // Permission to delete on Marketplace model
        Gate::define('delete_marketplace', function (User $user) {
            return $user->role == User::ROLE_ADMIN;
        });

        // --- RATING -- //
        // Permission to create on Rating model
        Gate::define('create_rating', function (User $user, Marketplace $marketplace) {
            if ($user->role >= User::ROLE_BASIC_USER) {
                if (DB::table('payment_market')->where('item_id', '=', $marketplace->id)->where('user_id', '=', $user->id)->first()) {
                    return true;
                }
            }
        });

        // Permission to update on Rating model
        Gate::define('update_rating', function (User $user, Rating $rating) {
            if ($user->id == $rating->user_id || $user->role == User::ROLE_ADMIN) {
                return true;
            }
        });

        // Permission to delete on Marketplace model
        Gate::define('delete_rating', function (User $user, Rating $rating) {
            if ($user->id == $rating->user_id || $user->role == User::ROLE_ADMIN) {
                return true;
            }
        });

        // Loki VR Plot middleware
        Gate::define('vr_plot_access', function(User $user) {
            if ($user->role == User::ROLE_ADMIN) {
                return true;
            }
            if (!is_null($user->subscription)) {
                if ($user->subscription->package_type >= Subscription::SUBSCRIPTION_TYPE_BRIGHT) {
                    return true;
                }
            }
            return abort(403, 'You must be subscribed to one of the Loki subscription plans to access VR Plots.');
        });
    }
}
