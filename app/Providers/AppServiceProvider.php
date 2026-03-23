<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Booking;
use App\Models\Contact;



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
          View::composer('*', function ($view) {
        $newBookingsCount = Booking::where('status', 'pending')->count();
        $newBookings = Booking::where('status', 'pending')->latest()->take(5)->get();


      $newMessagesCount = Contact::where('status', 'unread')->count();
        $newMessages = Contact::where('status', 'unread')
                                ->latest()
                                ->take(5)
                                ->get();
                                 $view->with(compact(
            'newBookingsCount',
            'newBookings',
            'newMessagesCount',
            'newMessages'
        ));
    });
        Paginator::useBootstrap();
    }
}
