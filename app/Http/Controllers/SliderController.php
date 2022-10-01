<?php

namespace App\Http\Controllers;

use App\Model\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->input('sliderTitle');
        $slider->slider_url = $request->input('sliderURL');
        $slider->message = $request->input('sliderMessage');
        $slider->image_url = "";
        if($slider->save()){
            $photo = $request->file('sliderImage');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $fileName)){
                        $slider = Slider::find($slider->id);
                        $slider->image_url = url('/') . '/' . $fileName;
                        $slider->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Slider information inserted successfully!');
        }
        return redirect()->back()->with('failed', 'Slider information could not insert!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider =  Slider::find($id);
        $slider->title = $request->input('sliderTitle');
        $slider->slider_url = $request->input('sliderURL');
        $slider->message = $request->input('sliderMessage');
        $slider->image_url = "";
        if($slider->save()){
            $photo = $request->file('sliderImage');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $fileName)){
                        $slider = Slider::find($slider->id);
                        $slider->image_url = url('/') . '/' . $fileName;
                        $slider->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Slider information updated successfully!');
        }
        return redirect()->back()->with('failed', 'Slider information could not updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider =  Slider::destroy($id);

        if($slider){
            return redirect()->back()->with('deleted', 'deleted successfully!');

        }

        return redirect()->back()->with('delete-failed', 'Could not be deleted!');
    }
}
