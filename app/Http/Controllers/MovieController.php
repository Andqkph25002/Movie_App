<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genreArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        //Chuyển về mảng key value
        // $genres = collect($genreArray)->mapWithKeys(function ($genre) {
        //     return [$genre['id'] => $genre['name']];
        // });


        $moviesViewModel =  new MoviesViewModel($popularMovies , $nowPlayingMovies , $genreArray );
        // return view('index', [
        //     'popularMovies' => $popularMovies,
        //     'genres' => $genres,
        //     'nowPlaying' => $nowPlaying
        // ]);
        return view('movies.index' , $moviesViewModel);
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();
      

        // $video = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')
        //     ->json();
        
        $movieViewModel = new MovieViewModel($movie);
        return view('movies.show', $movieViewModel);
    }
}
