<?php

namespace App\Http\Controllers;

use App\Model\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $voucherInput = $request->input('voucher_number');

        if($voucherInput == null){
            return redirect()->back()->with('failed', 'please input the number of vouchers you want to generate');
        }

    $voucher = null;
         for ($i=0; $i < $voucherInput; $i++) { 

            $voucher = new Voucher();

            $generatedPin = "";
    
                $string = rand(1000000000, 9999999999);
                $pin = Voucher::where('voucher_number', '=', $string)->first();
                if($pin){
                    return;
                }else{
                    $generatedPin = $string;
                }
            
    
        
                $voucher->voucher_number = $generatedPin;
                $voucher->activated_voucher = '';
                $voucher->status = 'available';
                $voucher->save();
                 
        }

        if($voucher != null){
            return redirect()->back()->with('success', $voucherInput. ' Vouchers successfully generated');
        }


        
        
    }

    public function sellVoucher($id){
        $voucher = Voucher::find($id);
        $voucher->status = 'sold';
        if($voucher->save()){

            return redirect()->back()->with('success','sold successfully');
        }
        return redirect()->back()->with('failed', 'Something went wrong');
        
    }


    public function testVoucherForm(){
        return view('voucher.test');
    }

   public function testVoucher(Request $request) {

    $string = $request->input('voucher_number');


    $pin = Voucher::where('voucher_number', '=', $string)->first();

                if($pin){
                    $voucher = Voucher::find($pin->id);
                    if($voucher->status == 'sold'){
                        if($voucher->activated_voucher != null){
                            return redirect()->back()->with('failed',"This voucher has already been used on ".$pin->updated_at);
                        }else{return redirect()->back()->with('failed', "This voucher was sold on ".$pin->updated_at. " but not yet used");}

                    }else{return redirect()->back()->with('success', "This voucher has not been sold");}

                        
                }else{
                    
                    return redirect()->back()->with('failed',"Invalid Voucher(This does not exist in our database)");
                }
  
    }





    public function printVoucherForm(){

        return view('voucher.print');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
