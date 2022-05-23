<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\images;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // dd($request);

        $imageName = time() . '.' . $request->image->extension();
        // dd(public_path('images') . $imageName);
        $request->image->storeAs('images/' . $request->dir, $imageName);
        // $request->image->move(public_path('images'), $imageName);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }

    public function fileStore(Request $request, $id)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $imageUpload = new Images;
        $imageUpload->document_id = $id;
        $imageUpload->file_path = $imageName;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }
    
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        Images::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
