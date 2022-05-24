<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OriginOfficeController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DocRouteController;
use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MeansOfReceivingController;
use App\Http\Controllers\StatusController;

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ImagesController;
use App\Models\DocType;
use App\Models\images;
use App\Models\MeansOfReceiving;
use App\Http\Controllers\PDFController;
use App\Models\DocRoutes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'App\Http\Controllers\DocumentController@index')->name('home')->middleware('auth');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	
});


Route::get('/home', 'App\Http\Controllers\DocumentController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::resource('origin-offices', OriginOfficeController::class);
	Route::resource('divisions', DivisionController::class);
	Route::resource('documents', DocumentController::class);
	Route::resource('doctypes', DocTypeController::class);
	Route::resource('mor', MeansOfReceivingController::class);
	Route::resource('statuses', StatusController::class);
	Route::resource('employees', EmployeeController::class);
	// Route::resource('docroutes', DocRouteController::class);

	// ------------------------------ Documents ----------------------------------------
	Route::get('overdues', [DocumentController::class, 'overdues'])->name('overdues');
	Route::get('due-today', [DocumentController::class, 'dueToday'])->name('due-today');
	Route::put('doc/update-status/', [StatusController::class, 'update'])->name('status.update');
	Route::get('/doc_edit', [DocumentController::class, 'edit'])->name('edit.doc');
	Route::put('/doc_update', [DocumentController::class, 'update'])->name('update.doc');

	Route::post('store-file', [DocumentController::class, 'storeFile'])->name('document.store_file');
	
	Route::post('doc_routes', [DocRouteController::class, 'create'])->name('docroutes.create');


	// ----------------------------------- Doc Route -----------------------------------------------
	Route::get('/route_edit', [DocRouteController::class, 'edit'])->name('edit.doc_route');

	// --------------------------- SEARCH ------------------------------------------
	Route::get('search', [AutoCompleteController::class, 'index'])->name('search');
	Route::get('autocomplete', [AutoCompleteController::class, 'autocomplete'])->name('autocomplete');
	Route::get('live-search', [AutoCompleteController::class, 'livesearch'])->name('live-search');

	// Route::get('live-search', [SearchController::class, 'search'])->name('live-search');
	// ---------------------------// SEARCH ------------------------------------------
	// --------------------------- upload ------------------------------------------

	Route::get('image-upload', [ EmployeeController::class, 'imageUpload' ])->name('image.upload');
	Route::post('image-upload', [ EmployeeController::class, 'imageUploadPost' ])->name('image.upload.post');



// --------------------------------- PDF ---------------------------------------------------------
	Route::post('doc/store',[ImagesController::class, 'fileStore'])->name('doc.store');
	Route::post('doc/delete',[ImagesController::class, 'fileDestroy'])->name('doc.delete');


	Route::get('/show-pdf/{id}', function($id) {
		$file = images::find($id);
		// dd($file);
		return response()->file(storage_path('app/images/') . $file->image_path);
	})->name('show-pdf');

// ------------------------------- Download PDF -------------------------------------------------------
Route::get('download-pdf', [PDFController::class, 'downloadPDF']);

// --------------------------------- ajax ----------------------------------------------
// Route::post('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/fetchall', [DocumentController::class, 'fetchAll'])->name('fetchAll');
Route::get('/fetchallroute/{doc_id}', [DocumentController::class, 'fetchAllRoute'])->name('fetchAllRoute');
Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/update', [EmployeeController::class, 'update'])->name('update');
Route::post('/store_ajax', [DocumentController::class, 'store_ajax'])->name('storeAjax');
});


