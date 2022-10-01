<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use App\Model\Movies;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MovieResource::collection(Movies::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllDramas()
    {
        $movies = Movies::where('genres', 'like','%Drama%')->get();
        return MovieResource::collection($movies);
    }

    public function getAllThrillers()
    {
        $movies = Movies::where('genres', 'like','%Thriller%')->get();
        return MovieResource::collection($movies);
    }

    public function getAllLatestMovies()
    {
        $movies = Movies::where('genres', 'like','%Latest Movie%')->get();
        return MovieResource::collection($movies);
    }

    
    public function getAllAnimations()
    {
        $movies = Movies::where('genres', 'like','%Animation%')->get();
        return MovieResource::collection($movies);
    }

    public function getMoviesByGenreName($genreName)
    {
        $movieGenre = Movies::where('genres', 'like','%'.$genreName.'%')->get();
        return MovieResource::collection($movieGenre);
    }


}



    
