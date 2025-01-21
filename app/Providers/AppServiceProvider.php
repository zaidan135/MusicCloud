<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Playlist;
use App\Models\Liked;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.aside', function ($view) {
            $userId = Auth::id();
        
            $playlists = Playlist::where('id_users', $userId)
                ->with(['musicPosts.details', 'user'])
                ->get()
                ->map(function ($playlist) {
                    $playlist->music_count = $playlist->musicPosts->count(); // Hitung jumlah musik di setiap playlist
                    return $playlist;
                });
        
            $likedMusic = Liked::where('id_users', $userId)
                ->with('musicPost.details')
                ->get();
        
            $view->with(compact('playlists', 'likedMusic'));
        });
        
    }
}
