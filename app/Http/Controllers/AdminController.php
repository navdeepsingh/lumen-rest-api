<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function authenticate(Request $request)
    {
      $this->validate($request, [
        'email' => 'required',
        'password' => 'required'
      ]);
      $user = User::where('email', $request->input('email'))->first();

      if(Hash::check($request->input('password'), $user->password)){
         $apikey = base64_encode(str_random(40));
         User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;
         return response()->json(['status' => 'success','api_key' => $apikey]);
      } else {
         return response()->json(['status' => 'fail'],401);
      }
    }

    public function user(Request $request)
    {
      $key = $request->header('Authorization');
      $user = User::where('api_key', $key)->first();
      return response()->json($user, 200);
    }

    public function update($id, Request $request)
    {

      $user = User::findOrFail($id);
      $result = $user->update(['email' => $request->input('email'), 'password' => Hash::make($request->input('password'))]);

      return response()->json(['status' => $result]);
    }
}
