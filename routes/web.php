<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['user' => \Domains\Users\Models\User::query()->firstOrFail()]);
});
