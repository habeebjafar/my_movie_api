<?php

namespace App\Http\Controllers;

use App\Model\ActorsDirectors;
use Illuminate\Http\Request;

class ActorsDirectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stars = ActorsDirectors::all();
        return view('actors_directors.index', compact('stars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actors_directors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $star = new ActorsDirectors();
            $star->name = $request->input('starName');
            $star->star_role = $request->input('starRole');
            $star->photo = "";
            $star->star_bio = $request->input('starBio');

            if($star->save()){
                $photo = $request->file('starPhoto');
                if($photo != null){
                    $ext = $photo->getClientOriginalExtension();
                    $fileName = rand(50000, 10000) . '.' . $ext;
                    if($ext == 'jpg' || $ext == 'png'){

                        if($photo->move(public_path(), $fileName)){
                            $star = ActorsDirectors::find($star->id);
                            $star->photo = url('/') . '/' . $fileName;
                            $star->save();

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
     * @param  \App\Model\ActorsDirectors  $actorsDirectors
     * @return \Illuminate\Http\Response
     */
    public function show(ActorsDirectors $actorsDirectors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ActorsDirectors  $actorsDirectors
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $star = ActorsDirectors::find($id);
        return view('actors_directors.edit', compact('star'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ActorsDirectors  $actorsDirectors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $star = ActorsDirectors::find($id);
            $star->name = $request->input('starName');
            $star->star_role = $request->input('starRole');
            $star->photo = "";
            $star->star_bio = $request->input('starBio');

            if($star->save()){
                $photo = $request->file('starPhoto');
                if($photo != null){
                    $ext = $photo->getClientOriginalExtension();
                    $fileName = rand(50000, 10000) . '.' . $ext;
                    if($ext == 'jpg' || $ext == 'png'){

                        if($photo->move(public_path(), $fileName)){
                            $star = ActorsDirectors::find($star->id);
                            $star->photo = url('/') . '/' . $fileName;
                            $star->save();

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
     * @param  \App\Model\ActorsDirectors  $actorsDirectors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $star = ActorsDirectors::destroy($id);

        if($star){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');
    
    }
}
