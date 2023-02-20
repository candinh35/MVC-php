<?php
require_once "App/core/Route.php";

Route::get('student', ['studentController', 'index']);
Route::get('student-create', ['studentController', 'create']);
Route::post('student-store',['studentController', 'store'] );

Route::get('student-delete', ['studentController', 'delete']);

Route::get('student-edit', ['studentController', 'edit']);
Route::get('student-update', ['studentController', 'update']);