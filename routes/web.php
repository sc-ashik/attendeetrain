<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/gallery/{courseCode}/{section}','AttendanceController@gallery');
Route::post('addimage','AttendeeController@addImage');
Route::post('createsection','SectionController@createSection');
Route::post('addstudents','SectionController@addStudents');
Route::post('identify','SectionController@recognize');
Route::get('attendance/{courseCode}/{section}','AttendanceController@getQRcode');
Route::post('verifyqrcode','AttendanceController@verifyQR');
Route::post('getcount','AttendanceController@getCount');
Route::post('record','RecordController@record');
// Route::get('getattendance','RecordController@getAttendance');
Route::get('deletegroups','SectionController@deleteGroups');


Route::get('store/attendee/{matricno}/{filename}', function ($matricno, $filename)
{
    // im not 100% sure about the $path thingy, you need to fiddle with this one around.
    $path = storage_path(). '/app/attendee/'.$matricno.'/'. $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('store/test/{group}/{date}/{filename}', function ($group,$date, $filename)
{
    // im not 100% sure about the $path thingy, you need to fiddle with this one around.
    $path = storage_path(). '/app/test/'.$group.'/'.$date.'/'.$filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});