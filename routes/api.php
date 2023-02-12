<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users/all', function (Request $request) {
   $users = User::all(['id','name','email']);
        return response()->json($users);
});

Route::post('/form', function (Request $request) {
$body = $request->getContent();
$decoded = json_decode($body);

if (strlen($decoded->name) >= 10) return response()->json(
    [
        'error' => [
            'name' => 'Name length is longer than 10 chars'
        ], 
        'status' => false
    ], 400);

 return response()->json(['status' => true]);
});