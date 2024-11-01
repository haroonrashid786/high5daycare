<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class UnreadCountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('layouts.partials.sidebar', function ($view) {
            $unreadMessages = 0;
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->tickets->isNotEmpty()) {
                    $unreadMessages = $user->tickets->sum(function ($ticket) {
                        return $ticket->messages->where('receiver_id', auth()->id())->where('read_at', null)->count();
                    });
                }
            }
            $view->with('unreadMessages', $unreadMessages);
        });

        View::composer('layouts.partials.header', function ($view) {
            $unreadNotifications = 0;
            $notifications = [];

            if (auth()->check()) {
                $user = auth()->user();
                if ($user->notices->isNotEmpty()) {
                    $notifications = Notification::where('user_id',Auth::id())->where('read_at',null)
                    ->latest()->limit(10)->get();
                    $unreadNotifications = $user->unread_count;
                }
            }
            $view->with('unreadNotifications', $unreadNotifications)->with('notifications', $notifications);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
