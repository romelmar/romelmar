<?php

namespace App\Http\Controllers;

use App\Models\DocRoutes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class DocRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        try {
            $DocRoutes = new DocRoutes;
            $DocRoutes->date_received = $request->date_received;
            $DocRoutes->doc_id = $request->doc_id;
            $DocRoutes->action = $request->action;
            $DocRoutes->employee_id = $request->employee_id;
            $DocRoutes->division_id = $request->division_id;

            $DocRoutes->push(); // This will update both user and phone record in DB            
        } catch (\Exception $e) {
            return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
        }

        return response()->json(['status' => "success"]);
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
     * @param  \App\Models\DocRoute  $docRoute
     * @return \Illuminate\Http\Response
     */
    public function show(DocRoute $docRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocRoute  $docRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(DocRoute $docRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocRoute  $docRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocRoute $docRoute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocRoute  $docRoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocRoute $docRoute)
    {
        //
    }
}
