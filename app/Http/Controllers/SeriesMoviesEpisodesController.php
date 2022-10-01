<?php

namespace App\Http\Controllers;

use App\Model\SeriesMoviesEpisodes;
use App\Model\SeriesMovies;
use App\Model\SeriesMoviesSeasons;


use Illuminate\Http\Request;

class SeriesMoviesEpisodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = SeriesMoviesEpisodes::all();

        return view('episode.index', compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $series = SeriesMovies::all();
        return view('episode.create', compact('series'));
        
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

        $seriesTitle = $request->input('seriesTitle');
        $seasonNumber = $request->input('seasonNumber');

        $season->series_id = $seriesTitle;
        $season->season_number = $seasonNumber;
        $season->season_thumbnail = "";


        if($season->save()){

            $episode = new SeriesMoviesEpisodes();

            $episode->series_title = $seriesTitle;
            $episode->season_number = $seasonNumber;

            $episode->episode_number = $request->input('episodeNumber');
            $episode->episode_thumbnail = "";
            $episode->episode_url = $request->input('episode_url');
            $episode->episode_download_url = $request->input('episode_download_url');

            if($episode->save()){
                $episodeThumbnail = $request->file('episodeThumbnail');
    
                if($episodeThumbnail != null){
    
                    $ext = $episodeThumbnail->getClientOriginalExtension();
                    $fileName = rand(10000, 5000). '.'. $ext;
                    if($ext == 'jpg' || $ext == 'png'){
    
                        if($episodeThumbnail->move(public_path(), $fileName)){
    
                            $episode = SeriesMoviesEpisodes::find($episode->id);
                            $episode->episode_thumbnail = url('/') . '/'. $fileName;
                            $episode->save();
    
                        }
    
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
     * @param  \App\Model\SeriesMoviesEpisodes  $seriesMoviesEpisodes
     * @return \Illuminate\Http\Response
     */
    public function show(SeriesMoviesEpisodes $seriesMoviesEpisodes)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SeriesMoviesEpisodes  $seriesMoviesEpisodes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $episode = SeriesMoviesEpisodes::find($id);
        $series = SeriesMovies::all();
        return view('episode.edit', compact('episode','series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SeriesMoviesEpisodes  $seriesMoviesEpisodes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $episode =  SeriesMoviesEpisodes::find($id);
        $episode->series_title = $request->input('seriesTitle');
        $episode->season_number = $request->input('seasonNumber');
        $episode->episode_number = $request->input('episodeNumber');
        $episode->episode_thumbnail = "";
        $episode->episode_url = $request->input('episode_url');
        $episode->episode_download_url = $request->input('episode_download_url');

        if($episode->save()){
            $episodeThumbnail = $request->file('episodeThumbnail');

            if($episodeThumbnail != null){

                $ext = $episodeThumbnail->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.'. $ext;
                if($ext == 'jpg' || $ext == 'png'){

                    if($episodeThumbnail->move(public_path(), $fileName)){

                        $episode = SeriesMoviesEpisodes::find($episode->id);
                        $episode->episode_thumbnail = url('/') . '/'. $fileName;
                        $episode->save();

                    }

                }
                
            }
            return redirect()->back()->with('success', 'updated successfully');
        }

        return redirect()->back()->with('failed', 'could not update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SeriesMoviesEpisodes  $seriesMoviesEpisodes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = SeriesMoviesEpisodes::destroy($id);
        if($episode){
            return redirect()->back()->with('deleted', 'Deletely successfully');
        }
        return redirect()->back()->with('delete-failed', 'Could not delete');
    
    }
}
