<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Request as GRequest;
use App\Object;
use App\User;
use App\Image;
use App\Setting;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = 'Продажа недвижимости в Улан-Удэ';

        $query = Object::select('objects.*', DB::raw("(SELECT CONCAT(i.id, '.', i.name) FROM images i WHERE i.object_id = objects.id ORDER BY sort, id LIMIT 1) AS image_name"))
            ->where('is_trash', 0)->orderBy('creation_date', 'desc');

        if ($request->path() == 'prodaja-kvartir-v-ulan-ude') {
            $category = 'Продажа квартир в Улан-Удэ';
            $query->where('category', 'квартира');
        }

        if ($request->path() == 'prodaja-domov-v-ulan-ude') {
            $category = 'Продажа домов в Улан-Удэ';
            $query->where('category', 'дом');
        }

        if ($request->path() == 'prodaja-komnat-v-ulan-ude') {
            $category = 'Продажа комнат в Улан-Удэ';
            $query->where('category', 'комната');
        }

        if ($request->path() == 'prodaja-uchastkov-v-ulan-ude') {
            $category = 'Продажа участков в Улан-Удэ';
            $query->where('category', 'участок');
        }

        if ($request->area == 1) {
            $query->where('sub_locality_name', 'Железнодорожный');
        }

        if ($request->area == 2) {
            $query->where('sub_locality_name', 'Советский');
        }

        if ($request->area == 3) {
            $query->where('sub_locality_name', 'Октябрьский');
        }

        if ($request->rooms == 1) {
            $query->where('rooms', 1);
        }

        if ($request->rooms == 2) {
            $query->where('rooms', 2);
        }

        if ($request->rooms == 3) {
            $query->where('rooms', 3);
        }

        if ($request->rooms == 4) {
            $query->where('rooms', '>', 3);
        }

        $objects = $query->paginate(8);

        return view('home.index', [
            'objects' => $objects,
            'category' => $category,
            'title' => $category,
            'area' => $request->area,
            'rooms' => $request->rooms,
        ]);
    }

    public function object($id) {
        $objectId = preg_replace('/^.+\-(\d+)/', '$1', $id);

        $object = Object::find($objectId);

        if (!$object) {
            abort(404);
        }

        if ('/' . GRequest::path() != $object->getUrl()) {
            return redirect($object->getUrl(), 301);
        }

        $category = 'Продажа недвижимости в Улан-Удэ';

        $title = '';

        if ($object->category == 'квартира') {
            $title = 'Продаю ' . $object->rooms . '-комнатную квартиру в Улан-Удэ';
        }

        if ($object->category == 'дом') {
            $title = 'Продаю дом в Улан-Удэ, район ' . $object->sub_locality_name;
        }

        if ($object->category == 'комната') {
            $title = 'Продаю комнату в Улан-Удэ, адрес ' . $object->address;
        }

        if ($object->category == 'участок') {
            $title = 'Продаю участок в Улан-Удэ, район ' . $object->sub_locality_name;
        }


        return view('home.object', [
            'object' => $object,
            'category' => $category,
            'title' => $title,
            'user' => User::find($object->user_id),
            'images' => Image::where('object_id', $object->id)->orderBy('sort')->orderBy('id')->get()
        ]);
    }
    
    public function about() {
        return view('home.page', [
            'title' => 'О нас',
            'body' => Setting::where('id', 1)->first()->about
        ]);
    }

    public function contact() {
        return view('home.page', [
            'title' => 'Контакты',
            'body' => Setting::where('id', 1)->first()->contact
        ]);
    }
}
