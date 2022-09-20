<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index() {
        $data = File::allFiles("backups");
        $files = collect([]);
        foreach ($data as $file) {
            $files->push(pathinfo($file));
        }
        $files = $files->sortByDesc("filename");

        if (request()->has("download")) {
            $file = $files[request("download")]["basename"];
            return Storage::disk("public_path")->download("backups/$file");
        }

        return view("backup.index", [
            "title" => "Backup Data",
            "dataArr" => $files
        ]);
    }

    public function store() {
        if (!\Artisan::call("db:backup")) {
           return back()->with("success", "Success Backup Database");
        }
        return back()->with("error", "Error, Can't Backup Database");
    }

    public function download(Request $request) {

    }

    public function delete($i) {
        $data = File::allFiles("backups");
        $files = collect([]);
        foreach ($data as $file) {
            $files->push(pathinfo($file));
        }
        $file = $files->sortByDesc("filename")[$i]["basename"];
        if (File::delete("backups/$file")) {
            return back()->with("success", "Success Delete Database");
        }
        return back()->with("error", "Error When Deleting Database");
    }
}
