<?php

namespace App\Http\Controllers;

use App\Model\Movies;
use App\Model\Genre;
use App\Model\Country;
use App\Model\ActorsDirectors;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $movies = Movies::all();
        $genres = Genre::all();
        $countries = Country::all();
        $stars = ActorsDirectors::all();
        return view('movies.index', compact('genres','countries','stars','movies'));
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
        return view('movies.create', compact('genres','countries','stars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movies = new Movies();
        $movies->title = $request->input('title');
        $movies->movie_url = $request->input('movie_url');
        $movies->movie_thumbnail = "";
        $movies->movie_poster = "";
        $movies->description = $request->input('description');
        $movies->movie_quality_id = $request->input('quality');
        $movies->download_url = $request->input('download_url');
        $actors = $request->input('actors');
        $movies->actors = implode(',', $actors);
        $directors = $request->input('directors');
        $movies->directors = implode(',', $directors);
        $writers = $request->input('writers');
        $movies->writers = implode(',', $writers);
        $movies->rating = $request->input('rating');
        $movies->release_date = $request->input('date');
        $countries = $request->input('countries');
        $movies->countries = implode(',', $countries);
        $movies->runtime = $request->input('runtime');
        $movies->is_published = true;
        $movies->is_downloadable = false;

        $genres = $request->input('genres');
        $movies->genres = implode(',', $genres);

        $movies->crew = implode(',', $actors). ','.implode(',', $directors). ',' .implode(',', $writers);
        
        if($movies->save()){
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
                        $movies = Movies::find($movies->id);
                        $movies->movie_thumbnail = url('/') . '/' . $fileName;
                        $movies->movie_poster = url('/') . '/' . $fileName2;
                        $movies->save();
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
     * @param  \App\Model\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Movies $movies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movies::find($id);
        $genres = Genre::all();
        $countries = Country::all();
        $stars = ActorsDirectors::all();
        return view('movies.edit', compact('genres','countries','stars','movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movies = Movies::find($id);
        $movies->title = $request->input('title');
        $movies->movie_url = $request->input('movie_url');
        $movies->movie_thumbnail = "";
        $movies->movie_poster = "";
        $movies->description = $request->input('description');
        $movies->movie_quality_id = $request->input('quality');
        $movies->download_url = $request->input('download_url');
        $actors = $request->input('actors');
        $movies->actors = implode(',', $actors);
        $directors = $request->input('directors');
        $movies->directors = implode(',', $directors);
        $writers = $request->input('writers');
        $movies->writers = implode(',', $writers);
        $movies->rating = $request->input('rating');
        $movies->release_date = $request->input('date');
        $countries = $request->input('countries');
        $movies->countries = implode(',', $countries);
        $movies->runtime = $request->input('runtime');
        $movies->is_published = true;
        $movies->is_downloadable = false;

        $genres = $request->input('genres');
        $movies->genres = implode(',', $genres);

        $movies->crew = implode(',', $actors). ','.implode(',', $directors). ',' .implode(',', $writers);

        
        if($movies->save()){
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
                        $movies = Movies::find($movies->id);
                        $movies->movie_thumbnail = url('/') . '/' . $fileName;
                        $movies->movie_poster = url('/') . '/' . $fileName2;
                        $movies->save();
                    }


                }
            }

            return redirect()->back()->with('success','Updated successfully');
        }
        return redirect()->back()->with('failed', 'Could not update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movies::destroy($id);
        if($movie){
            return redirect()->back()->with('deleted', 'Deletely successfully');
        }
        return redirect()->back()->with('delete-failed', 'Could not delete');
    }
}
