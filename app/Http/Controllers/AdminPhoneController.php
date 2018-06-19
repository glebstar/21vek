<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Object;

class AdminPhoneController extends Controller
{
    public function index()
    {
        return view('admin.phone.index', [
            'tab' => 'phone'
        ]);
    }

    public function change(Request $request)
    {
        if (!$request->old) {
            return response()->json([
                'result' => 'error',
                'message' => 'Старый телефон не заполнен'
            ]);
        }

        if (!$request->name) {
            return response()->json([
                'result' => 'error',
                'message' => 'Новое имя не заполнено'
            ]);
        }

        if (!$request->phone) {
            return response()->json([
                'result' => 'error',
                'message' => 'Новый телефон не заполнен'
            ]);
        }

        Object::where('phone', $request->old)
            ->update([
                'phone' => $request->phone,
                'name' => $request->name,
            ]);

        return response()->json([
            'result' => 'ok',
        ]);
    }
}