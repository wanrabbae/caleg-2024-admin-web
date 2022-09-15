<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index() {
        $data = Storage::allFiles("backup");
        $files = collect([]);
        foreach ($data as $file) {
            $files->push(pathinfo($file));
        }

        return view("backup.index", [
            "title" => "Backup Data",
            "dataArr" => $files
        ]);
    }

    public function store() {
        if (!\Artisan::call("db:backup")) {
           return back()->with("success", \Artisan::output());
        }
        return back()->with("error", "Error, Can't Backup Database");
    }

    public function delete($id) {
        Storage::delete("backup");
    }
}
