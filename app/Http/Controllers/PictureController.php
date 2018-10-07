<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Picture;
use DB;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $pictures = Picture::OrderBy('name', 'created_at')->paginate(1000);
        $title = 'Pildid';

        $elements = array(
            'title' => $title,
            'pictures' => $pictures 
        );
        return view('images.index')->with($elements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elements = array(
            'title' => 'Add Pictures'
        );
        return view('images.create')->with($elements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $file){

                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $file->move(public_path('storage/pildid'), $fileNameToStore);
            
                $pildid = new Picture;
                $pildid->name = $fileNameToStore;
                $pildid->user_id = auth()->user()->id;
                $pildid->Save();

            } 

        }
        
       return redirect('/images')->with('success', 'Picture has been added');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $title = 'Change Image';
        $picture = Picture::find($id);

        if(auth()->user()->id !== $picture->user_id) {
            return redirect('/images')->with('error', 'Unauthorized Page');
        }

        $elements = array(
            'title' => $title,
            'picture' => $picture
        );
        return view('images.edit')->with($elements);     
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
        $this->validate($request, [
            'image' => 'required'
        ]);
        
        if($request->hasfile('image')){

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move(public_path('storage/pildid'), $fileNameToStore);

            $pildid = Picture::find($id);
            $pildid->name = $fileNameToStore;
            $pildid->Save();
        }

        return redirect('/home')->with('success', 'Image Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::find($id);

        if(auth()->user()->id !== $picture->user_id) {
            return redirect('/images')->with('error', 'Unauthorized Page');
        }
    
            
        Storage::delete('public/pildid/'.$picture->name);
            
    
        $picture->delete();
        return redirect('/home')->with('success', 'Image Removed');
    
    }
}
