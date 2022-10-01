<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SeriesMoviesEpisodesResource;
use App\Model\SeriesMoviesEpisodes;

class SeriesMoviesEpisodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getSeasonsBySeriesId($seriesId){
        $seasonsBySeriesId =  SeriesMoviesEpisodes::where('series_title',$seriesId)->get();
        return SeriesMoviesEpisodesResource::collection($seasonsBySeriesId);
    }


    public function getEpisodeBySeasonId($seriesId,$seasonId){
        $episodesBySeasonId =  SeriesMoviesEpisodes::where([
            ['series_title',$seriesId],
            ['season_number',$seasonId]
            ])->get();
        return SeriesMoviesEpisodesResource::collection($episodesBySeasonId);
    }

}
