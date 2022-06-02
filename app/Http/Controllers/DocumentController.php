<?php

namespace App\Http\Controllers;

use App\Models\DocRoutes;
use App\Models\DocStatus;
use App\Models\DocType;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Focal;
use App\Models\MeansOfReceiving;
use App\Models\OriginOffice;
use App\Models\Status;
use App\Models\DocStatuses;
use App\Models\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Log;
// use Redirect,Response;
use Illuminate\Http\Response;
use Carbon\Carbon;



use Illuminate\Support\Facades\Storage;
use mikehaertl\pdftk\Pdf as Pdf2;
use Spatie\PdfToText\Pdf;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function masterlist(){
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $thisweek =  Carbon::now('Asia/Manila')->addDays(6)->format('Y-m-d');
        return view('masterlist',[
            'overdues'  =>  Document::all()->where("deadline", "<", $today)->count(),
            'dueToday'  =>  Document::all()->where("deadline", "==", $today)->count(),
            'recent'  =>  Document::all()->where("deadline", ">", $today)->count(),
            'tabAll'    =>  "active",
            'tabOverdue'    =>  "",
            'tabToday'  =>  "",
        ]);
    } 

    public function index()
    {

        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $thisweek =  Carbon::now('Asia/Manila')->addDays(6)->format('Y-m-d');
        // if( $this->deadline >= $today){
        //     if($this->deadline < $thisweek && $this->deadline != $today) return "success";
        //      else if( $this->deadline == $today) return "warning";
        // }
        // else return "danger";

        $division = "ROD";
        $control_id = now()->year . "-" . $division;
        return view('documents.home', [
            // 'docs'  =>  Document::orderBy('created_at', 'desc')->paginate(10),
            'overdues'  =>  Document::all()->where("deadline", "<", $today)->count(),
            'dueToday'  =>  Document::all()->where("deadline", "==", $today)->count(),
            'recent'  =>  Document::all()->where("deadline", ">", $today)->count(),
            'tabAll'    =>  "active",
            'tabOverdue'    =>  "",
            'tabToday'  =>  "",
            'control_id'  => $control_id
        ]);
    }

    public function fetchAll()
    {
        $docs = Document::all();
        // dd($docs);
        $fields = [
            '#',
            'Recieved',
            'Subject',
            'Content',
            'Deadline',
            'Status',
            'Updated At',
            'Action',
        ];

        $output = '';
        if ($docs->count() > 0) {
            $output .= '<table id="myTable" class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>';

            foreach ($fields as $field) $output .= '<th>' . $field . '</th>';

            $output .= '
              </tr>
            </thead>
            <tbody>';
            foreach ($docs as $doc) {
                $output .= '<tr>
                <td>' . $doc->id . '</td>
                <td><p class="title">' . $doc->docType->name . '</p><small>'.$doc->date_received .'</small> </td>
                <td>' . $doc->subject . '  </td>
                <td>' . $doc->images[0]->content . '  </td>
                <td>' . $doc->deadline . '</td>
                <td>' . $doc->get_status() . '</td>
                <td>' . $doc->updated_at . '</td>
                <td>
                        <button type="button" id="' . $doc->id . '"  class="btn text-success mx-1 editIcon editDoc"  data-toggle="modal" data-target="#editDocumentModal">
                        <i class="bi-pencil-square h4"></i>
                        </button>
                        
                        
                        <a href="' . route('documents.show',  $doc->id) . '" id="' . $doc->id . '" class="text-success "><i class="bi-eye h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function fetchAllRoute($doc_id)
    {
        // $docRoutes = DocRoutes::all();
        $docRoutes = DocRoutes::where('doc_id',$doc_id)->get();

        $fields = [
            'Division',
            'Action taken',
            'Action'
        ];

        $output = '';
        if ($docRoutes->count() > 0) {
            $output .= '<table id="myTable" class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>';

            foreach ($fields as $field) $output .= '<th>' . $field . '</th>';

            $output .= '
              </tr>
            </thead>
            <tbody>';
            foreach ($docRoutes as $docRoute) {

                $output .= '<tr>
                <td><p class="title">' . $docRoute->division->name . '</p><small>'.$docRoute->employee->fullname().'</small></td>
                <td><small>'. $docRoute->date_received.'</small><p class="title">' .$docRoute->action. '</p></td>

                <td>
                        <button type="button" id="' . $docRoute->id . '"  class="btn text-success mx-1 editIcon editDoc"  data-toggle="modal" data-target="#editRouteModal">
                        <i class="bi-pencil-square h4"></i>
                        </button>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function overdues()
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $thisweek =  Carbon::now('Asia/Manila')->addDays(6)->format('Y-m-d');
        $overdues = Document::orderBy('updated_at', 'desc')->where("deadline", "<", $today);

        return view('documents.home', [
            'docs'  =>  $overdues->paginate(10),
            'overdues'  =>   $overdues->count(),
            'dueToday'  =>  Document::all()->where("deadline", "==", $today)->count(),
            'recent'  =>  Document::all()->where("deadline", ">", $today)->count(),
            'tabAll'    =>  "",
            'tabOverdue'    =>  "active",
            'tabToday'  =>  ""
        ]);
    }

    public function dueToday()
    {
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $thisweek =  Carbon::now('Asia/Manila')->addDays(6)->format('Y-m-d');
        $overdues = Document::orderBy('updated_at', 'desc')->where("deadline", "<", $today);
        $dueToday = Document::orderBy('updated_at', 'desc')->where("deadline", "=", $today);

        return view('documents.home', [
            'docs'  =>  $dueToday->paginate(10),
            'overdues'  =>   $overdues->count(),
            'dueToday'  =>  $dueToday->count(),
            'recent'  =>  Document::all()->where("deadline", ">", $today)->count(),
            'tabAll'    =>  "",
            'tabOverdue'    =>  "",
            'tabToday'  =>  "active"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $origin_office = OriginOffice::all();
        $employee = Employee::all();

        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $overdues  =  Document::all()->where("deadline", "<", $today)->count();
        $dueToday  =  Document::all()->where("deadline", "==", $today)->count();
        $recent  =  Document::all()->where("deadline", ">", $today)->count();


        return view('documents.create', compact(
            'origin_office',
            'employee',
            'overdues',
            'dueToday',
            'recent'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store_ajax(Request $request)
    {

        try {


            $request->validate([
                'action_taken' => 'nullable',
                'required_action' => 'nullable',
            ]);

            // $input = $request->all();
            // Log::info($input);

            $employee_id = $request->employee_id;
            $origin_id = $request->origin_id;
            $mor_id = $request->mor_id;
            $doctype_id = $request->doctype_id;

            if ($request->origin_id === null) {
                $origin = OriginOffice::create(
                    [
                        'name' => $request->origin,
                    ]
                );
                $origin_id  = $origin->id;
            }

            if ($request->mor_id === null) {
                $mor = MeansOfReceiving::create(
                    [
                        'name' => $request->mor,
                    ]
                );
                $mor_id  = $mor->id;
            }

            if ($request->doctype_id === null) {
                $doctype = DocType::create(
                    [
                        'name' => $request->doctype,
                    ]
                );
                $doctype_id  = $doctype->id;
            }

            if ($request->employee_id === null) {

                $firstname = "";

                $name = explode(" ", $request->focal);
                $last_id = array_key_last($name);

                for ($i = 0; $i < ($last_id); $i++) $firstname .= " " . $name[$i];

                $lastname = $name[$last_id];

                $employee = Employee::create(
                    [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                    ]
                );

                $employee_id  = $employee->id;
            }

            $document = new Document;
            $document->origin_id = $origin_id;
            $document->mor_id = $mor_id;
            $document->doctype_id  = $doctype_id;
            $document->employee_id  = $employee_id;
            $document->date_received = $request->date_received;
            $document->control_number = $request->control_number;
            $document->subject = $request->subject;
            $document->deadline = $request->deadline;

            $document->push(); // This will update both user and phone record in DB
        } catch (\Exception $e) {
            return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
        }

        return response()->json(['status' => "success", 'document_id' => $document->id]);
        //   ----------------------------------------------------------------------------------------
    }

    public function storeFile(Request $request)
    {
        
        if ($request->file('file')) {
            $imageUpload = new Images;
            $imageUpload->document_id =  $request->document_id;
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();

            $targetPath = $request->file('file')->storeAs('images', $imageName);
            $targetPath = storage_path('app/images/') . $imageName;

            $path = 'C:\Program Files\Git\mingw64\bin\pdftotext';
            $data = Pdf::getText($targetPath,$path);

            $pdf = new Pdf2(
                $targetPath,
                [
                    'command' => 'C:\Program Files (x86)\PDFtk\bin\pdftk.exe',
                    'useExec' => true,  // May help on Windows systems if execution fails
                ]
            );

            $password = '123456';
            $userPassword = '123456b';

            $result = $pdf
                ->allow('AllFeatures')
                ->setPassword($password)
                ->setUserPassword($userPassword)
                ->passwordEncryption(128)
                ->saveAs($targetPath);

            $imageUpload->image_path = $imageName;
            $imageUpload->content = $data;
            $imageUpload->save();
            return response()->json(
                [
                    'status' => "success",
                    'path' => $targetPath

                ]
            );
        }
    }

    public function store(Request $request)
    {
        $status_id = $request->status_id;
        $request->offsetUnset('status_id');
        $employee_id = $request->origin_id;
        $origin_id = $request->origin_id;
        $mor_id = $request->mor_id;
        $doctype_id = $request->doctype_id;

        $request->validate([
            'action_taken' => 'nullable',
            'required_action' => 'nullable',
        ]);

        if ($request->origin_id === null) {
            $origin = OriginOffice::create(
                [
                    'name' => $request->origin,
                ]
            );
            $origin_id  = $origin->id;
        }

        if ($request->mor_id === null) {
            $mor = MeansOfReceiving::create(
                [
                    'name' => $request->mor,
                ]
            );
            $mor_id  = $mor->id;
        }

        if ($request->doctype_id === null) {
            $doctype = DocType::create(
                [
                    'name' => $request->doctype,
                ]
            );
            $doctype_id  = $doctype->id;
        }

        if ($request->employee_id === null) {

            $firstname = "";

            $name = explode(" ", $request->focal);
            $last_id = array_key_last($name);

            for ($i = 0; $i < ($last_id); $i++) $firstname .= " " . $name[$i];

            $lastname = $name[$last_id];

            $employee = Employee::create(
                [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                ]
            );

            $employee_id  = $employee->id;
        }

        $request->session()->put('last_input', $request->all());

        $merged = array_merge(
            $request->all(),
            [
                'origin_id' => $origin_id,
                'employee_id' => $employee_id,
                'mor_id' => $mor_id,
                'doctype_id' => $doctype_id
            ]
        );

        $document = new Document;
        $document->origin_id = $origin_id;
        $document->mor_id = $mor_id;
        $document->doctype_id  = $doctype_id;
        $document->employee_id  = $employee_id;
        $document->date_received = $request->date_received;
        $document->control_number = $request->control_number;
        $document->subject = $request->subject;
        $document->deadline = $request->deadline;
        $document->required_action = $request->required_action;


        $document->push(); // This will update both user and phone record in DB
        $doc_id = $document->id;

        $request->session()->put('document_id', $doc_id);
        return redirect()->route('documents.create')
            ->with('success', 'Document added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $images = Document::find($document->id)->images;

        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $overdues  =  Document::all()->where("deadline", "<", $today)->count();
        $dueToday  =  Document::all()->where("deadline", "==", $today)->count();
        $recent  =  Document::all()->where("deadline", ">", $today)->count();
        // $latestStatus_obj  =  DocStatus::select('status_id')->where('document_id',$document->id)->latest()->first();
        // $status_id  =      $latestStatus_obj->status_id;
        // $latestStatus = Status::find($status_id, ['name']);

        return view('documents.view', compact(
            'document',
            'images',
            'overdues',
            'dueToday',
            'recent',
            // 'status_id'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $input = $request->all();
        $where = array('id' => $request->id);
        $document  = Document::where($where)->first();
        $origin = Document::find($request->id)->origin_office->name;
        $focal = Document::find($request->id)->employee->fullname();
        $mor = Document::find($request->id)->meansOfReceiving->name;
        $doctype = Document::find($request->id)->docType->name;


        $collection = collect($document[0]);

        $merged = $collection->merge($origin);

        return response()->json([
            'status' => 200,
            $document,
            'origin' =>  $origin,
            'employee' =>  $focal,
            'mor' =>  $mor,
            'doctype' =>  $doctype,
        ]);
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        
        $inserted = Document::where('id', $request->id)
            ->update($input);

        return response()->json([
            'status' => 200,
        ]);
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
