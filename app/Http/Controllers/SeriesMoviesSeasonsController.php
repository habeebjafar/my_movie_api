<?php

namespace App\Http\Controllers;

use App\Model\SeriesMoviesSeasons;
use Illuminate\Http\Request;

use App\Model\SeriesMovies;


class SeriesMoviesSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = SeriesMoviesSeasons::all();
        return view('season.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $series = SeriesMovies::all();

        return view('season.create', compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $season = new SeriesMoviesSeasons();
        $season->series_id = $request->input('seriesTitle');
        $season->season_number = $request->input('seasonNumber');
        $season->season_thumbnail = "";

        if($season->save()){
            $seasonThumbnail = $request->file('seasonThumbnail');

            if($seasonThumbnail != null){

                $ext = $seasonThumbnail->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.'. $ext;
                if($ext == 'jpg' || $ext == 'png'){

                    if($seasonThumbnail->move(public_path(), $fileName)){

                        $season = SeriesMoviesSeasons::find($episode->id);
                        $season->season_thumbnail = url('/') . '/'. $fileName;
                        $season->save();

                    }

                }
                
            }
            return redirect()->back()->with('success', 'saved successfully');
        }

        return redirect()->back()->with('failed', 'could not save');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SeriesMoviesSeasons  $seriesMoviesSeasons
     * @return \Illuminate\Http\Response
     */
    public function show(SeriesMoviesSeasons $seriesMoviesSeasons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SeriesMoviesSeasons  $seriesMoviesSeasons
     * @return \Illuminate\Http\Response
     */
    public function edit(SeriesMoviesSeasons $seriesMoviesSeasons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SeriesMoviesSeasons  $seriesMoviesSeasons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeriesMoviesSeasons $seriesMoviesSeasons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SeriesMoviesSeasons  $seriesMoviesSeasons
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeriesMoviesSeasons $seriesMoviesSeasons)
    {
        //
    }
}
