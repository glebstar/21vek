<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Object;

class AdminHomeController extends Controller
{
    public function index() {
        return view('admin.index', [
        ]);
    }

    public function addObject() {
        return view('admin.addobject');
    }

    public function addObjectPost(Request $request) {
        if ($request->category == 'квартира') {
            $this->validate($request, [
                'sub-locality-name' => 'required|max:255',
                'address' => 'required|max:255',
                'area' => 'required|integer',
                'rooms' => 'required|integer',
                'floor' => 'required|integer',
                'floors-total' => 'required|integer',
                'price' => 'required|integer',
                'description' => 'required',
            ]);
        } elseif ($request->category == 'дом') {
            $this->validate($request, [
                'sub-locality-name' => 'required|max:255',
                'address' => 'required|max:255',
                'area' => 'required|integer',
                'lot-area' => 'required|integer',
                'rooms' => 'required|integer',
                'floors-total' => 'required|integer',
                'built-year' => 'required|integer|min:1900',
                'price' => 'required|integer',
                'description' => 'required',
            ]);
        } elseif ($request->category == 'комната') {
            $this->validate($request, [
                'sub-locality-name' => 'required|max:255',
                'address' => 'required|max:255',
                'area' => 'required|integer',
                'floor' => 'required|integer',
                'floors-total' => 'required|integer',
                'price' => 'required|integer',
                'description' => 'required',
            ]);
        } elseif ($request->category == 'участок') {
            $this->validate($request, [
                'sub-locality-name' => 'required|max:255',
                'address' => 'required|max:255',
                'lot-area' => 'required|integer',
                'price' => 'required|integer',
                'description' => 'required',
            ]);
        } else {
            abort(404);
        }

        $object = new Object();
        $object->category = $request->category;
        
        $subLocalityName = 'sub-locality-name';
        $object->sub_locality_name = $request->$subLocalityName;
        
        $object->address = $request->address;
        
        if ($request->category != 'участок') {
            $object->area = $request->area;

            $floorsTotal = 'floors-total';
            $object->floors_total = $request->$floorsTotal;

            $builtYear = 'built-year';
            $object->built_year = $request->$builtYear ? $request->$builtYear : 0;

            $object->renovation = $request->renovation;
        }

        if ($request->category == 'участок' || $request->category == 'дом') {
            $lotArea = 'lot-area';
            $object->lot_area = $request->$lotArea;
        }

        if ($request->category != 'участок' && $request->category != 'дом') {
            $object->floor = $request->floor;
        }

        if ($request->category != 'участок' && $request->category != 'комната') {
            $object->rooms = $request->rooms;
        }

        $dealStatus = 'deal-status';
        $object->deal_status = $request->$dealStatus;

        $object->description = $request->description;
        $object->price = $request->price;

        if ($request->name) {
            $object->name = $request->name;
        }

        if ($request->phone) {
            $object->phone = $request->phone;
        }

        $user = Auth::user();

        $object->user_id = $user->id;
        $object->creation_date = time();
        $object->last_update_date = time();

        $object->save();

        return redirect('admin/editobject/' . $object->id);
    }
}
