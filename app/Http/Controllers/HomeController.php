<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DynamicFormMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = \File::get('sample.json');
        $alldata = json_decode($json);
        // dd($alldata);
        return view('home', compact('alldata'));
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
        // dd($request->all());
        $filedata = null;
        $data = [];

        foreach ($request->all() as $key => $val){
            if ($request->hasFile($key)) {
                $productImg = $request->file($key);
                $folder = "user_aadhar";
                $filename = $request->first_name . '-' . uniqid(rand(), true) . '.' . $productImg->getClientOriginalExtension();
                $pan_image = $productImg->storeAs($folder, $filename, 'public');
                $pan_image =  '/storage/' . $pan_image;
                $filedata[] = [
                    $key => $pan_image
                ];
            }else{
                $data[] = [
                    $key => $val
                ];
            }
        }
        // foreach ($request->all() as $key => $val){
        //     $data[] = [
        //         $key => $val
        //     ];
        // };
        $mainData = [
            "file_data" => $filedata,
            "data" => $data
        ];
        Mail::to('sanatannk@gmail.com')->send(new DynamicFormMail($mainData));
        return redirect('/home');
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
}
