<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class FileUploadController extends Controller
{
    /** 
     * Generate Upload View 
     * 
     * @return void 
    */  
    public  function dropzoneUi()  
    {  
        return view('upload-view');  
    }  
    /** 
     * File Upload Method 
     * 
     * @return void 
     */  
    public  function dropzoneFileUpload(Request $request)  
    {  
        $albumID   = '';
        $destinationPath = public_path() . '/uploads/' . $albumID ;
        $filename = $file->getClientOriginalName();
        
        $image = $request->file('file');
        $imageName = time().'.'.$image->extension(); 
        $upload_success = $image->move(public_path('images'),$imageName); 
        
        if ($upload_success) {

            // resizing an uploaded file
            Images::make($destinationPath . $filename)->save($destinationPath . $filename);

            return response()->json(['success'=>$imageName]);
        } else {
            return response()->json('error', 400);
        }
        
        
    }
}