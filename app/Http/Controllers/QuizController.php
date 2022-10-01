<?php

namespace App\Http\Controllers;

use App\Model\Quiz;
use App\Model\Subject;
use App\Model\SubjectTopics;


use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Quiz::all();
        return view('questions.index', \compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $subjects = Subject::all();

        // return view('questions.create', \compact('subjects'));

        $subjects['data'] = Subject::orderby("subject","asc")
        			   ->select('id','subject')
        			   ->get();

        // Load index view
    	return view('questions.create')->with("subjects",$subjects);

    }

    public function getTopics($subjectid=0){

    	// Fetch Employees by Departmentid
        $topicData['data'] = SubjectTopics::orderby("topic","asc")
        			->select('id','topic')
        			->where('subject_id',$subjectid)
        			->get();
  
        return response()->json($topicData);
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = new Quiz();
        $quiz->subject_id = $request->input('subjectName');
        $quiz->topic_id = $request->input('topicName');
        $quiz->question = $request->input('question');
        $quiz->image = "";
        $quiz->option_a = $request->input('optionA');
        $quiz->option_b = $request->input('optionB');
        $quiz->option_c = $request->input('optionC');
        $quiz->option_d = $request->input('optionD');
        $quiz->answer = $request->input('answer');
        $quiz->explanation = $request->input('explanation');
        $quiz->year = $request->input('year');

        if($quiz->save()){
            $image = $request->file('questionImage');
            if($image != null){
                $ext = $image->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($image->move(public_path(), $fileName)){
                        $quiz = Quiz::find($quiz->id);
                        $quiz->image = url('/') . '/' . $fileName;
                        $quiz->save();

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
     * @param  \App\Model\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Quiz::find($id);
        //$subjects = Subject::all();
        $subjects['data'] = Subject::orderby("subject","asc")
        			   ->select('id','subject')
        			   ->get();
        $subjectTopics = SubjectTopics::all();
        return view('questions.edit', \compact('question','subjectTopics'))->with("subjects",$subjects);

        //return view('questions.edit', \compact('question','subjects','subjectTopics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Quiz::destroy($id);
        if($question){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');  
    }
}
