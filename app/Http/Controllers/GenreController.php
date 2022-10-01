<?php

namespace App\Http\Controllers;

use App\Model\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = new Genre();
        $genre->name = $request->input('genreName');
        $genre->icon = "";
        if($genre->save()){
            $icon = $request->file('genreIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $genre = Genre::find($genre->id);
                        $genre->icon = url('/') . '/' . $fileName;
                        $genre->save();

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
     * @param  \App\Model\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);
        return view('genre.edit', compact('genre'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $genre =  Genre::find($id);
        $genre->name = $request->input('genreName');
        $genre->icon = "";
        if($genre->save()){
            $icon = $request->file('genreIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $genre = Genre::find($genre->id);
                        $genre->icon = url('/') . '/' . $fileName;
                        $genre->save();

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
     * @param  \App\Model\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$genre = Genre::destroy($id);
        if(Genre::destroy($id)){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');
    }
}
