<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Offer;

class AdminOfferController extends Controller
{
    public function index()
    {
        return view('admin/offer', [
            'offers' => Offer::orderBy('id', 'desc')->get(),
            'tab' => 'main',
        ]);
    }

    public function compl(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        $offer->is_completed = $request->is_completed;
        $offer->save();

        return response()->json([
            'result' => 'ok'
        ]);
    }
}
