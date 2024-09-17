<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/calls', function () {
    // if (($handle = fopen(public_path() . '/300K.txt', 'r')) !== false) {
    //     while ($line = fgets($handle)) {
    //         $calls                 = new Row();
    //         $calls->time           = trim(substr($line, 0, 4));
    //         $calls->duration       = trim(substr($line, 5, 4));
    //         $calls->cond_code      = trim(substr($line, 10, 1));
    //         $calls->code_dial      = trim(substr($line, 15, 1));
    //         $calls->code_used      = trim(substr($line, 18, 3));
    //         $calls->dialed_num     = trim(substr($line, 24, 11));
    //         $calls->calling_num    = trim(substr($line, 39, 11));
    //         $calls->clg_num_in_tac = trim(substr($line, 53, 11));
    //         $calls->auth_code      = trim(substr($line, 64, 5));
    //         $calls->frl            = trim(substr($line, 70, 1));
    //         $calls->ixc_code       = trim(substr($line, 77, 3));
    //         $calls->in_crt_id      = trim(substr($line, 85, 3));
    //         // $calls->save();
    //     }
    //     fclose($handle);
    // }
    // return View::make('calls')
    //     ->with('calls', Calls::all());
});
