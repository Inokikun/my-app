<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*class EmailCheckController extends Controller
{
    public function check(Request $request)
    {
        \Log::info('check関数発火');
        $request->validate([
            'email' => 'required|email',
        ]);

        $exists = DB::table('users')->where('email', $request->input('email'))->exists();

        return response()->json(['exists' => $exists]);
    }
}*/

class UserController extends Controller
{

    public function checkDuplicate(Request $request)
    {
      \Log::info('checkDuplicate関数発火');

      $request->validate([
        'email' => 'nullable|email|max:255',
        'name'  => 'nullable|string|max:255',
      ]);

      /*$emailExists = User::where('email', $request->email)->exists();
      $emailExists = DB::table('users')->where('email', $request->input('email'))->exists();
      $usernameExists = User::where('name', $request->username)->exists();
      $usernameExists = DB::table('users')->where('name', $request->input('name'))->exists();*/

      $emailExists = false;
      $usernameExists = false;

      if ($request->filled('email')) {
        \Log::info('email重複チェック発火');
        //$emailExists = User::where('email', $request->email)->exists();
        $emailExists = DB::table('users')->where('email', $request->input('email'))->exists();
      }

      if ($request->filled('name')) {
        \Log::info('name重複チェック発火');
        //$usernameExists = User::where('name', $request->username)->exists();
        $usernameExists = DB::table('users')->where('name', $request->input('name'))->exists();
      }

      return response()->json([
        'emailExists' => $emailExists,
        'usernameExists' => $usernameExists,
      ]);
    }
}
