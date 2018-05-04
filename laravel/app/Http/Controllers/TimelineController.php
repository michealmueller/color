<?php

namespace App\Http\Controllers;

use Auth;
use App\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public $timeline;
    public function __construct()
    {
        $this->timeline = new Timeline;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file()){
            //dd($request);
            $file = $request->file('fileInput');
            //$filename = $file->getClientOriginalName();
            //$path = '/uploads/images/'.Auth::id().'/'.date('Y').'/'.date('m').'/';
            //$fullPath = $path.$filename;
            if($file->getClientSize() / 1024 > 5000)
            {
                session()->put('error', 'The file you selected is too large to upload.');
                return back()->with(['tab'=>'general']);
            }

            $location = $file->store(Auth::id().'/images');
            //dd($location);
            //$file->storeAS($path, $filename);

            $this->timeline->create([
                'user_id'       => Auth::id(),
                'post_content'  => $request['post_content'],
                'image_url'     => '/storage/app/public/'.$location,
            ]);
        }else{
            //dd($request);
            $this->timeline->create([
                'user_id'       => Auth::id(),
                'post_content'  => $request['post_content'],
            ]);
        }

        return redirect('/profile');
    }


    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $timeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeline $timeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeline $timeline)
    {
        //
    }
}
