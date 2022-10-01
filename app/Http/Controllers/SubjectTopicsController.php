<?php

namespace App\Http\Controllers;

use App\Model\SubjectTopics;
use Illuminate\Http\Request;
use App\Model\Subject;



class SubjectTopicsController extends Controller
{


    // public function topicIndex()
    // {
    //     //  $subjects = Subject::all();
    //     //  return view('topic.subjectTopic', \compact('subjects'));

    //     //Fetch departments
    //     $subjects['data'] = Subject::orderby("subject","asc")
    //     			   ->select('id','subject')
    //     			   ->get();

    //     // Load index view
    // 	return view('topic.subjectTopic')->with("subjects",$subjects);
    // }


    // // Fetch records
    // public function getTopics($subjectid=0){

    // 	// Fetch Employees by Departmentid
    //     $empData['data'] = SubjectTopics::orderby("topic","asc")
    //     			->select('id','topic')
    //     			->where('subject_id',$subjectid)
    //     			->get();
  
    //     return response()->json($empData);
     
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectTopics = SubjectTopics::all();
        return view('topic.index', \compact('subjectTopics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('topic.create', \compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $subjectTopic = new SubjectTopics();
        $subjectTopic->subject_id = $request->input('subjectName');
        $subjectTopic->topic = $request->input('topicName');
        $subjectTopic->icon = "";
        
        if($subjectTopic->save()){
            $icon = $request->file('topicIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $subjectTopic = SubjectTopics::find($subjectTopic->id);
                        $subjectTopic->icon = url('/') . '/' . $fileName;
                        $subjectTopic->save();

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
     * @param  \App\Model\SubjectTopics  $subjectTopics
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectTopics $subjectTopics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SubjectTopics  $subjectTopics
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = Subject::all();
        $subjectTopic = SubjectTopics::find($id);

        return view('topic.edit', \compact('subjects', 'subjectTopic'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubjectTopics  $subjectTopics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subjectTopic = SubjectTopics::find($id);
        $subjectTopic->subject_id = $request->input('subjectName');
        $subjectTopic->topic = $request->input('topicName');
        $subjectTopic->icon = "";
        
        if($subjectTopic->save()){
            $icon = $request->file('topicIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $subjectTopic = SubjectTopics::find($subjectTopic->id);
                        $subjectTopic->icon = url('/') . '/' . $fileName;
                        $subjectTopic->save();

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
     * @param  \App\Model\SubjectTopics  $subjectTopics
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = SubjectTopics::destroy($id);
        if($topic){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');   
    }
}
