<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudyMaterialController;

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


// Route::middleware(['auth:sanctum', 'adminMiddleware'])->prefix('admin/api')->as('admin.')->group(function () {
//     Route::get('/study_materials', [StudyMaterialController::class, 'getAllStudyMaterials'])->name('study_materials.all');
// });