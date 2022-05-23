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
use Carbon\Carbon;

class AutoCompleteController extends Controller
{
    // public function index(){
    //     return view('autocomplete-search');
    // }

    public function autocomplete(Request $request){
        switch ($request->db) {
            case "OriginOffice":
                                $res    =   OriginOffice::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "mor":
                                $res    =   MeansOfReceiving::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "doctype":
                                $res    =   DocType::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "employee":
                                $res    =   Employee::select("id",DB::raw("CONCAT(firstname, ' ', lastname) as name"))
                                ->where("firstname","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "status":
                                $res    =   Status::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;

          }
      

        return response()->json($res);
    }

    public function livesearch(Request $request){

      $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        switch ($request->db) {
            case "OriginOffice":
                                $res    =   OriginOffice::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "mor":
                                $res    =   MeansOfReceiving::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "doctype":
                                $res    =   DocType::select('*')
                                ->where("name","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "employee":
                                $res    =   Employee::select("id",DB::raw("CONCAT(firstname, ' ', lastname) as name"))
                                ->where("firstname","LIKE","%{$request->term}%")
                                ->get();
              break;
            case "status":
                                if(strlen($request->term) > 0){
                                  $res    =   Document::select('*')
                                  ->where("subject","LIKE","%{$request->term}%")
                                  ->get();
                                  
                                }
                                else {
                                  $res    =   Document::select('*')
                                  // ->where("subject","LIKE","%%")
                                  ->get();
                                }

                               

              break;

          }
      
          
        return response()->json($res);
    }
}
