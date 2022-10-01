<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SubjectResource;
use App\Model\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubjectResource::collection(Subject::all());
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
        $subject = new Subject();
        $subject->subject = $request->input('subject');
        $subject->icon = "";
        if($subject->save()){
            $icon = $request->file('image');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $subject = Subject::find($subject->id);
                        $subject->icon = url('/') . '/' . $fileName;
                        $subject->save();

                    }


                }
            }

           // return redirect()->back()->with('success','Saved successfully');
           return "uploaded";
        }
        //return redirect()->back()->with('failed', 'Could not save');
        return "failed";

        //      return response()->json([
        //     asset("public/$name"),
        //     201,
        //     'message' => asset("public/$name") ? 'Image saved' : 'Image failed to save'
        // ]);
    

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

    // public function uploadFile(Request $request) {
    //     if($request->hasFile('image')) {
    //         $name = time()."_".$request->file('image')->getClientOriginalName();
    //         $request->file('image')->move(public_path('images'), $name);
    //     }
    //     return response()->json([
    //         asset("images/$name"),
    //         201,
    //         'message' => asset("images/$name") ? 'Image saved' : 'Image failed to save'
    //     ]);
    // }


    public function uploadFile(Request $request) {
        $subject = new Subject();
        
        if($request->hasFile('image')) {

            
            

            
        }
        return "failed";

        // return response()->json([
        //     asset("images/$name"),
        //     201,
        //     'message' => asset("images/$name") ? 'Image saved' : 'Image failed to save'
        // ]);
    }

}
