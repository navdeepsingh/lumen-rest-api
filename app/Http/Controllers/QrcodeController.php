<?php

namespace App\Http\Controllers;

use App\Qrcode;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Qrcode::all());
    }

    public function show($id)
    {
        return response()->json(Qrcode::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'api_key' => 'required'
        ]);
        $qrcode = Qrcode::create($request->all());

        return response()->json($qrcode, 201);
    }

    public function update($id, Request $request)
    {
        $qrcode = Qrcode::findOrFail($id);
        $qrcode->update($request->all());

        return response()->json($qrcode, 200);
    }

    public function delete($id)
    {
        Qrcode::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
