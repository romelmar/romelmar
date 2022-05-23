<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
  
    public function fileStore(Request $request)
    {

        $input = $request->all();
        Log::info($input);
        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();
        $sourcePath = public_path('images/' . $request->file->getClientOriginalName());

        $sourcePath = $image->getPathname();
        $targetPath = public_path('images/') . $imageName;
        
        $pdf = new Pdf($sourcePath ,
                [
                    'command' => 'C:\Program Files (x86)\PDFtk\bin\pdftk.exe',
                    'useExec' => true,  // May help on Windows systems if execution fails
                ]);

        $password = '123456';
        $userPassword = '123456b';

        $result = $pdf
            ->allow('AllFeatures')      
            ->setPassword($password)
            ->setUserPassword($userPassword)
            ->passwordEncryption(128)
            ->saveAs($targetPath);
        

        $imageUpload = new Images;

        if($request->id) $imageUpload->document_id =  $request->id;
        else $imageUpload->document_id = $request->session()->get('document_id');
        
        $imageUpload->image_path = $imageName;
        
        
        if($imageUpload->save()){

            $request->session()->forget(['document_id']);
            $request->session()->forget(['last_input']);

            return response()->json(['success' => $imageName  ]);
        }
    }
    
    public function fileDestroy(Request $request)
    {
        // dd($request);
        $filename =  $request->get('filename');
        Images::where('image_path', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\images  $images
     * @return \Illuminate\Http\Response
     */
    public function show(images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit(images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\images  $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, images $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy(images $images)
    {
        //
    }
}
