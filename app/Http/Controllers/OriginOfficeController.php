<?php

namespace App\Http\Controllers;

use App\Models\OriginOffice;
use App\Models\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OriginOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');

        return view('origin_offices.home',[
            'origin_offices'  =>  OriginOffice::orderBy('id','desc')->paginate(10),
            'overdues'  =>  Document::all()->where("deadline","<",$today)->count(),
            'dueToday'  =>  Document::all()->where("deadline","==",$today)->count(),
            'recent'  =>  Document::all()->where("deadline",">",$today)->count(),
        ]);

        // $data['companies'] = OriginOffice::orderBy('id','desc')->paginate(5);
        // return view('origin_offices.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        return view("origin_offices.create",[
            'overdues'  =>  Document::all()->where("deadline","<",$today)->count(),
            'dueToday'  =>  Document::all()->where("deadline","==",$today)->count(),
            'recent'  =>  Document::all()->where("deadline",">",$today)->count(),   
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:origin_offices',
        ]);

        OriginOffice::create($request->all());
        return redirect()->route('origin-offices.index', compact("validated"))
            ->with('success', 'Product updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(OriginOffice $OriginOffice)
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $overdues  =  Document::all()->where("deadline", "<", $today)->count();
        $dueToday  =  Document::all()->where("deadline", "==", $today)->count();
        $recent  =  Document::all()->where("deadline", ">", $today)->count();
        
        return view('OriginOffice.show',compact(
            'OriginOffice',
            'overdues',
            'dueToday',
            'recent'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(OriginOffice $origin_office)
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $overdues  =  Document::all()->where("deadline", "<", $today)->count();
        $dueToday  =  Document::all()->where("deadline", "==", $today)->count();
        $recent  =  Document::all()->where("deadline", ">", $today)->count();

        return view('origin_offices.edit',compact(
            'origin_office',
            'overdues',
            'dueToday',
            'recent'        
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


            $validated = $request->validate([
                'name' => 'required|unique:origin_offices',
            ]);

            $OriginOffice = OriginOffice::find($id);
            $input = $request->all();
            $OriginOffice->fill($input)->save();
            return redirect()->route('origin-offices.index')
            ->with('success','Origin Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(OriginOffice $document)
    {
        //
    }
}
