<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class MailController extends Controller
{
    public function index(Request $request) {
      $result = Mail::to($request->input('email'))->send(new ResetPassword($newpassword = 'test'));

      $status = ($result) ? true : false;
      return response()->json(['status' => $status]);
    }
}
