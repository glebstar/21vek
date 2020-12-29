<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use App\Object;
use App\Image;
use App\Document;
use Artisan;

class AdminHomeController extends Controller
{
    public function index(Request $request) {
        $objectQ = Object::select('objects.*', DB::raw("(SELECT CONCAT(i.id, '.', i.name) FROM images i WHERE i.object_id = objects.id ORDER BY id LIMIT 1) AS image_name"))->
        where('is_trash', 0)->orderBy('creation_date', 'desc');
        if ($request->_q) {
            $objectQ->where('address', 'like', '%' . $request->_q . '%');
        }

        return view('admin.index', [
            'objects' => $objectQ->paginate(10),
            'tab' => 'main',
            '_q' => $request->_q,
            'is_archive' => false,
        ]);
    }

    public function archive(Request $request) {
        $objectQ = Object::select('objects.*', DB::raw("(SELECT CONCAT(i.id, '.', i.name) FROM images i WHERE i.object_id = objects.id ORDER BY id LIMIT 1) AS image_name"))->
        where('is_trash', 1)->orderBy('creation_date', 'desc');
        if ($request->_q) {
            $objectQ->where('address', 'like', '%' . $request->_q . '%');
        }

        return view('admin.index', [
            'objects' => $objectQ->paginate(10),
            'tab' => 'main',
            '_q' => $request->_q,
            'is_archive' => true,
        ]);
    }

    public function addObject() {
        return view('admin.addobject', [
            'tab' => 'main'
        ]);
    }

    public function addObjectPost(Request $request) {
        $this->validateObject($request);

        $object = new Object();

        $object = $this->fillObject($object, $request);

        $user = Auth::user();

        $object->user_id = $user->id;
        $object->creation_date = time();
        $object->last_update_date = time();
        $object->save();

        return redirect('admin/editobject/' . $object->id);
    }
    
    public function editObject($id) {
        $object = Object::find($id);

        if (! $object) {
            abort(404);
        }

        return view('admin.editobject', [
            'object' => $object,
            'images' => Image::where('object_id', $object->id)->orderBy('id')->get(),
            'documents' => Document::where('object_id', $object->id)->orderBy('id')->get(),
            'tab' => 'main'
        ]);
    }

    public function editObjectPost(Request $request) {
        $object = Object::find($request->id);

        if (! $object) {
            abort(404);
        }

        $this->validateObject($request);

        $object = $this->fillObject($object, $request);

        $object->last_update_date = time();
        $object->save();

        return redirect('admin/editobject/' . $object->id);
    }

    private function validateObject(Request $request) {
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
    }

    private function fillObject($object, Request $request) {
        $object->category = $request->category;

        $subLocalityName = 'sub-locality-name';
        $object->sub_locality_name = $request->$subLocalityName;

        $object->is_new_building = $request->is_new_building ? 1 : 0;

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

        $object->cadastral_number = $request->cadastral_number ? $request->cadastral_number : '';

        $object->parent_phone = $request->parent_phone ? $request->parent_phone : '';

        return $object;
    }

    public function addImage(Request $request) {
        $object = Object::find($request->id);

        if (! $object) {
            abort(404);
        }

        $file = $request->file('image');

        $object->addImage($file);
        $object->last_update_date = time();
        $object->save();

        return redirect('admin/editobject/' . $object->id);
    }

    public function addDocument(Request $request)
    {
        $object = Object::find($request->id);

        if (! $object) {
            abort(404);
        }

        $documentName = $request->documentname;
        if (!$documentName) {
            return redirect()->back()->withErrors([
                'name' => 'Имя документа обязательно'
            ]);
        }

        $file = $request->file('document');

        $object->addDocument($file, $documentName);

        return redirect('admin/editobject/' . $object->id . '#documents');
    }

    public function addPostImage(Request $request)
    {
        $object = Object::find($request->id);

        if (! $object) {
            abort(404);
        }

        $files = [];
        foreach ($request->photos as $file) {
            $files[] = $object->addImage($file);
        }

        $object->last_update_date = time();
        $object->save();

        return response()->json([
            'files' => $files
        ]);
    }

    public function delImage(Request $request) {
        $object = Object::find($request->id);

        if (! $object) {
            return response()->json([
                'result' => 'ok'
            ]);
        }

        $object->delImage($request->image_id);
        $object->last_update_date = time();
        $object->save();

        return response()->json([
            'result' => 'ok'
        ]);
    }

    public function delDocument(Request $request)
    {
        $object = Object::find($request->id);

        if (! $object) {
            return response()->json([
                'result' => 'ok'
            ]);
        }

        $object->delDocument($request->document_id);
        $object->last_update_date = time();
        $object->save();

        return response()->json([
            'result' => 'ok'
        ]);
    }

    public function toArchiveObject(Request $request) {
        $object = Object::find($request->id);

        if (! $object) {
            return response()->json([
                'result' => 'ok'
            ]);
        }

        $object->is_trash = 1;
        $object->save();

        return response()->json([
            'result' => 'ok'
        ]);
    }

    public function fromArchiveObject(Request $request) {
        $object = Object::find($request->id);

        if (! $object) {
            return response()->json([
                'result' => 'ok'
            ]);
        }

        $object->is_trash = 0;
        $object->save();

        return response()->json([
            'result' => 'ok'
        ]);
    }

    public function feed() {
        return view('admin.feed', [
            'tab' => 'feed'
        ]);
    }

    public function feedGen() {
        Artisan::call('genfeed');

        return redirect('admin/feed');
    }
}
