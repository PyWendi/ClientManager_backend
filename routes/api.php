<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("clients", ClientController::class);

Route::get("/minmax", [ClientController::class, "minMax"]);

// For setting fake data inside database
Route::get("fakeClient", function () {
    $user = Client::factory()->count(6)->create();
    return response()->json(["resultat" => "Donné créer avec succes",
                             "data" => $user]);
});