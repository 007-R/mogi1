<?php

use App\Http\Controllers\TimeStampController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\EmployeeManagementController;
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

Route::get('/', [AuthenticatedSessionController::class, 'index']);

Route::post('/startwork', [TimeStampController::class, 'start_work']);
Route::post('/finishwork', [TimeStampController::class, 'finish_work']);
Route::post('/startrest', [TimeStampController::class, 'start_rest']);
Route::post('/finishrest', [TimeStampController::class, 'finish_rest']);

Route::get('/date', [EmployeeManagementController::class, 'date_list']);
Route::get('/employeeList', [EmployeeManagementController::class, 'employee_list']);
Route::get('/employee/search', [EmployeeManagementController::class, 'employee_search']);

?>