<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $files = Storage::disk('s3')->allFiles('public');
        return view('upload.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);
        $image = $request->file('image');
        Storage::put('public',$image);
        return redirect()->back();
    }
}
