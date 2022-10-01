<?php

namespace App\Http\Controllers;

use App\Model\Subject;
use App\Model\SubjectTopics;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
         return view('subject.index', \compact('subjects'));

        // Fetch departments
        // $subjects['data'] = Subject::orderby("subject","asc")
        // 			   ->select('id','subject')
        // 			   ->get();

        // // Load index view
    	// return view('subject.index')->with("subjects",$subjects);
    }


    // Fetch records
    // public function getTopics($subjectid=0){

    // 	// Fetch Employees by Departmentid
    //     $empData['data'] = SubjectTopics::orderby("topic","asc")
    //     			->select('id','topic')
    //     			->where('subject_id',$subjectid)
    //     			->get();
  
    //     return response()->json($empData);
     
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
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
        $subject->subject = $request->input('subjectName');
        $subject->icon = "";
        if($subject->save()){
            $icon = $request->file('subjectIcon');
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

            return redirect()->back()->with('success','Saved successfully');
        }
        return redirect()->back()->with('failed', 'Could not save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subject.edit', \compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject =  Subject::find($id);
        $subject->subject = $request->input('subjectName');
        $subject->icon = "";
        if($subject->save()){
            $icon = $request->file('subjectIcon');
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

            return redirect()->back()->with('success','updated successfully');
        }
        return redirect()->back()->with('failed', 'Could not update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::destroy($id);
        if($subject){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');
    
    }
}
