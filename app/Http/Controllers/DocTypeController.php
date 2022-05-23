<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use App\Models\Document;
use Illuminate\Http\Request;

use Carbon\Carbon;

class DocTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        return view('doctypes.home',[
            'origin_offices'  =>  DocType::orderBy('id','desc')->paginate(10),
            'overdues'  =>  Document::all()->where("deadline","<",$today)->count(),
            'dueToday'  =>  Document::all()->where("deadline","==",$today)->count(),
            'recent'  =>  Document::all()->where("deadline",">",$today)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        return view("doctypes.create",[
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
            'name' => 'required|unique:doc_types',
        ]);


        DocType::create($request->all());
        return redirect()->route('doctypes.index')
            ->with('success', 'Document type added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(DocType $doctype)
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $overdues  =  Document::all()->where("deadline", "<", $today)->count();
        $dueToday  =  Document::all()->where("deadline", "==", $today)->count();
        $recent  =  Document::all()->where("deadline", ">", $today)->count();

        return view('doctypes.edit',compact(
            'doctype',
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

        $doctype = DocType::find($id);
        $input = $request->all();
        $doctype->fill($input)->save();

        return redirect()->route('doctypes.index')
        ->with('success','Document Type Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
