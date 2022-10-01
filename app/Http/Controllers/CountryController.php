<?php

namespace App\Http\Controllers;

use App\Model\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return  view('country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country();
        $country->name = $request->input('countryName');
        $country->icon = "";
        if($country->save()){
            $icon = $request->file('countryIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $country = Country::find($country->id);
                        $country->icon = url('/') . '/' . $fileName;
                        $country->save();

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
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country =  Country::find($id);
        $country->name = $request->input('countryName');
        $country->icon = "";
        if($country->save()){
            $icon = $request->file('countryIcon');
            if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 5000). '.' .$ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($icon->move(public_path(), $fileName)){
                        $country = Country::find($country->id);
                        $country->icon = url('/') . '/' . $fileName;
                        $country->save();

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
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::destroy($id);

        if($country){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');
    }
}
