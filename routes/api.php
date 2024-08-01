<?php

use App\Http\Controllers\API\ApprovalController;
use App\Http\Controllers\API\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    // Rute untuk mengelola pengeluaran
    Route::post('expense', [ExpenseController::class, 'store']);
    Route::get('expense/{id}', [ExpenseController::class, 'show']);
    
    // Rute untuk menyetujui pengeluaran
    Route::patch('expense/{id}/approve', [ApprovalController::class, 'approve']);
    
    // Rute untuk mengelola approver
    Route::post('approvers', [ApprovalController::class, 'storeApprover']);
    
    // Rute untuk mengelola tahap approval
    Route::post('approval-stages', [ApprovalController::class, 'storeApprovalStage']);
    Route::put('approval-stages/{id}', [ApprovalController::class, 'updateApprovalStage']);

