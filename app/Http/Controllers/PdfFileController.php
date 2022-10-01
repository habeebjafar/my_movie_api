<?php

namespace App\Http\Controllers;

use App\Model\PdfFile;
use Illuminate\Http\Request;

class PdfFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = PdfFile::all();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new PdfFile();
        $book->book_title = $request->input('bookTitle');

        $book->book_url = "";
        $book->book_thumbnail = "";

        if($book->save()){
            $book_url = $request->file('book');
            $book_thumbnail = $request->file('bookThumbnail');
            if($book_url != null && $book_thumbnail != null ){
                $ext = $book_url->getClientOriginalExtension();
                $thumbnailext = $book_thumbnail->getClientOriginalExtension();
                if($thumbnailext == 'jpg' || $ext == 'png' && $ext == 'pdf'){
                    $ramdonName = rand(10000, 5000);
                    $fileName = $ramdonName. '.' .$ext;
                    $thumbnailFileName = $ramdonName. '.' .$thumbnailext;

                    if($book_url->move(public_path(), $fileName) && $book_thumbnail->move(public_path(), $thumbnailFileName)){
                        $book = PdfFile::find($book->id);
                        $book->book_url = url('/') . '/' . $fileName;
                        $book->book_thumbnail = url('/') . '/' . $thumbnailFileName;
                        $book->save();

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
     * @param  \App\Model\PdfFile  $pdfFile
     * @return \Illuminate\Http\Response
     */
    public function show(PdfFile $pdfFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PdfFile  $pdfFile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = PdfFile::find($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PdfFile  $pdfFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = PdfFile::find($id);
        $book->book_title = $request->input('bookTitle');

        $book->book_url = "";
        $book->book_thumbnail = "";

        if($book->save()){
            $book_url = $request->file('book');
            $book_thumbnail = $request->file('bookThumbnail');
            if($book_url != null && $book_thumbnail != null ){
                $ext = $book_url->getClientOriginalExtension();
                $thumbnailext = $book_thumbnail->getClientOriginalExtension();
                if($thumbnailext == 'jpg' || $ext == 'png' && $ext == 'pdf'){
                    $ramdonName = rand(10000, 5000);
                    $fileName = $ramdonName. '.' .$ext;
                    $thumbnailFileName = $ramdonName. '.' .$thumbnailext;

                    if($book_url->move(public_path(), $fileName) && $book_thumbnail->move(public_path(), $thumbnailFileName)){
                        $book = PdfFile::find($book->id);
                        $book->book_url = url('/') . '/' . $fileName;
                        $book->book_thumbnail = url('/') . '/' . $thumbnailFileName;
                        $book->save();

                    }


                }
            }

            return redirect()->back()->with('success','update successfully');
        }
        return redirect()->back()->with('failed', 'Could not update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PdfFile  $pdfFile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = PdfFile::destroy($id);
        if($book){
            return redirect()->back()->with('deleted','Deleted successfully');

        }
        return redirect()->back()->with('delete-failed','Could not be deleted');  
    }
}
