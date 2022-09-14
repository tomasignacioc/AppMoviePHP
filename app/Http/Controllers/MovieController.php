<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all('id', 'title', 'image_url');

        return $movies;
    }

    public function addToFavorites(Request $request, Movie $movie)
    {
        try
        {
            if ($request->user()->hasMovie($movie))
            {
                throw new AuthorizationException('Movie already added.');
            }
            $request->user()->movies()->attach($movie);
        }
        catch (\Throwable $th)
        {
            throw $th;
        }
    }

    /**
     * Display movies ordered by score.
     *
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        return Movie::select('id', 'title', 'score')->orderBy('score', 'desc')->take(10)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $movie =  Movie::create($request->validated());

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie->load('comments:id,movie_id,content,username');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $result = $movie->delete();

        if ($result)
        {
            return response()->json(["message" => "movie deleted successfully"], 200);
        }
    }
}
