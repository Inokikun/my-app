<?php

namespace App\Http\Controllers;

//use App\Actions\User\CreateUser;
//use App\Http\Requests\StoreUserRequest;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

// file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/15.docx
class ImageController  extends Controller
{
    public function showUploadForm()
    {
        \Log::info('ImageController.phpのshowUploadFormメソッド発火');
        return view('home.aaa');
    }

    public function store(Request $request)
    {
        \Log::info('ImageController.phpのstoreメソッド発火');
    }
}
