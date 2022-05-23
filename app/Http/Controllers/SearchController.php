<?php


namespace App\Http\Controllers;

use App\Models\DocType;
use App\Models\Employee;
use App\Models\Focal;
use App\Models\MeansOfReceiving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OriginOffice;
use App\Models\Status;
use App\Models\Document;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        $db =  Document::select('*');
        $db =  Status::select('*');

        $res    =   $db
        ->where("subject","LIKE","%{$request->term}%")
        ->get();
            // dd($res );

            // $res    =   Document::select('*')
            // ->where("subject","LIKE","%{$request->term}%")
            // ->get();

        return response()->json($res);
    }
}
