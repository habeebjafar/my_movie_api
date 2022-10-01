<?php

namespace App\Http\Controllers;

use App\Model\SeriesMovies;
use Illuminate\Http\Request;
use App\Model\Genre;
use App\Model\Country;
use App\Model\ActorsDirectors;

class SeriesMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = SeriesMovies::all();
        $genres = Genre::all();
        $countries = Country::all();
        $stars = ActorsDirectors::all();
        return view('series_movies.index', compact('genres','countries','stars','series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        $countries = Country::all();
        $stars = ActorsDirectors::all();
        return view('series_movies.create', compact('genres','countries','stars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $series = new SeriesMovies();
        $series->title = $request->input('title');
        //$series->series_url = $request->input('movie_url');
        $series->series_thumbnail = "";
        $series->series_poster = "";
        $series->description = $request->input('description');
        $series->series_quality = $request->input('quality');
        //$series->download_url = $request->input('download_url');
        $actors = $request->input('actors');
        $series->actors = implode(',', $actors);
        $directors = $request->input('directors');
        $series->directors = implode(',', $directors);
        $writers = $request->input('writers');
        $series->writers = implode(',', $writers);
        $series->rating = $request->input('rating');
        $series->release_date = $request->input('date');
        $countries = $request->input('countries');
        $series->countries = implode(',', $countries);
        $series->runtime = $request->input('runtime');
        $series->is_published = true;
        $series->is_downloadable = false;

        $genres = $request->input('genres');
        $series->genres = implode(',', $genres);

        $series->crew = implode(',', $actors). ','.implode(',', $directors). ',' .implode(',', $writers);

        
        if($series->save()){
            $thumbnail = $request->file('thumbnail');
            $poster = $request->file('poster');
            if($thumbnail != null){
                $ext = $thumbnail->getClientOriginalExtension();
                $ext2 = $thumbnail->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                $fileName2 = rand(10000, 5000). '.' .$ext2;
                if($ext == 'jpg' || $ext == 'png'){
                    if($thumbnail->move(public_path(), $fileName)){
                        $poster->move(public_path(), $fileName2);
                        $series = SeriesMovies::find($series->id);
                        $series->series_thumbnail = url('/') . '/' . $fileName;
                        $series->series_poster = url('/') . '/' . $fileName2;
                        $series->save();
                    }


                }
            }

            return redirect()->back()->with('success','Saved successfully');
        }
        return redirect()->back()->with('failed', 'Could not save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SeriesMovies  $seriesMovies
     * @return \Illuminate\Http\Response
     */
    public function show(SeriesMovies $seriesMovies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SeriesMovies  $seriesMovies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seriesMovie = SeriesMovies::find($id);
        $genres = Genre::all();
        $countries = Country::all();
        $stars = ActorsDirectors::all();
        return view('series_movies.edit', compact('genres','countries','stars','seriesMovie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SeriesMovies  $seriesMovies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $series = SeriesMovies::find($id);
        $series->title = $request->input('title');
        //$series->series_url = $request->input('movie_url');
        $series->series_thumbnail = "";
        $series->series_poster = "";
        $series->description = $request->input('description');
        $series->series_quality = $request->input('quality');
        //$series->download_url = $request->input('download_url');
        $actors = $request->input('actors');
        $series->actors = implode(',', $actors);
        $directors = $request->input('directors');
        $series->directors = implode(',', $directors);
        $writers = $request->input('writers');
        $series->writers = implode(',', $writers);
        $series->rating = $request->input('rating');
        $series->release_date = $request->input('date');
        $countries = $request->input('countries');
        $series->countries = implode(',', $countries);
        $series->runtime = $request->input('runtime');
        $series->is_published = true;
        $series->is_downloadable = false;

        $genres = $request->input('genres');
        $series->genres = implode(',', $genres);

        $series->crew = implode(',', $actors). ','.implode(',', $directors). ',' .implode(',', $writers);
        
        if($series->save()){
            $thumbnail = $request->file('thumbnail');
            $poster = $request->file('poster');
            if($thumbnail != null){
                $ext = $thumbnail->getClientOriginalExtension();
                $ext2 = $thumbnail->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                $fileName2 = rand(10000, 5000). '.' .$ext2;
                if($ext == 'jpg' || $ext == 'png'){
                    if($thumbnail->move(public_path(), $fileName)){
                        $poster->move(public_path(), $fileName2);
                        $series = SeriesMovies::find($series->id);
                        $series->series_thumbnail = url('/') . '/' . $fileName;
                        $series->series_poster = url('/') . '/' . $fileName2;
                        $series->save();
                    }


                }
            }

            return redirect()->back()->with('success','Updated successfully');
        }
        return redirect()->back()->with('failed', 'Could not up');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SeriesMovies  $seriesMovies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $series = SeriesMovies::destroy($id);

        if($series){

            return redirect()->back()->with('deleted', 'Deleted successfully');

        }

        return redirect()->back()->with('delete-failed', 'Could  not be deleted');
    }

    public function getSeasonForm(SeriesMovies $seriesMovies)
    {
        $series = SeriesMovies::all();
     return view('series_movies.season', compact('series'));
    }
}
