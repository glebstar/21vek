<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Offer;

class KupluController extends Controller
{
    public function index(Request $request)
    {
        $success = false;

        if ($request->phone) {
            $phone = $request->phone;
            if (mb_strlen($phone) > 255) {
                $phone = mb_substr($phone, 0, 254);
            }

            Offer::create([
                'phone' => $phone,
                'is_completed' => 0
            ]);
            $success = true;
        }

        return view('kuplu', [
            'success' => $success
        ]);
    }
}
