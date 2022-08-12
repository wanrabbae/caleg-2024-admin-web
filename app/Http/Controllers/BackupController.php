<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index() {
        if (!\Artisan::call("db:backup")) {
            return back()->with("success", \Artisan::output());
        }
        return back()->with("error", "Error, Can't Backup Database");
    }
}
