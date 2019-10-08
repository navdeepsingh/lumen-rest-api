<?php

namespace App\Http\Controllers;

use App\Qrcode;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Qrcode::orderBy('created_at', 'DESC')->get());
    }

    public function show($id)
    {
        return response()->json(Qrcode::find($id));
    }

    public function create(Request $request)
    {
        $qrcode = Qrcode::create($request->all());

        return response()->json(Qrcode::orderBy('created_at', 'DESC')->get());
    }

    public function update($id, Request $request)
    {
        $qrcode = Qrcode::findOrFail($id);
        $qrcode->update($request->all());

        return response()->json(Qrcode::orderBy('created_at', 'DESC')->get());
    }

    public function delete($id)
    {
        Qrcode::findOrFail($id)->delete();
        return response()->json(['status' => 'deleted'], 200);
    }

    public function redirect($code, Request $request)
    {
        $qrcode = Qrcode::where('source_link', $request->fullUrl())->first();
        dd($request->fullUrl());
        return redirect($qrcode->destination_link);
    }
}
