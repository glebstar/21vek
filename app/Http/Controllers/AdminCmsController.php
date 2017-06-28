<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;

class AdminCmsController extends Controller
{
    public function about() {
        return view('admin.cms.page', [
            'tab' => 'cms',
            'page_title' => 'О нас',
            'url' => '/admin/cms/about',
            'body' => Setting::where('id', 1)->first()->about
        ]);
    }

    public function aboutPost(Request $request) {
        $settings = Setting::where('id', 1)->first();
        $settings->about = base64_encode($request->body);
        $settings->save();

        return redirect('admin/cms/about');
    }

    public function contact() {
        return view('admin.cms.page', [
            'tab' => 'cms',
            'page_title' => 'Контакты',
            'url' => '/admin/cms/contact',
            'body' => Setting::where('id', 1)->first()->contact
        ]);
    }

    public function contactPost(Request $request) {
        $settings = Setting::where('id', 1)->first();
        $settings->contact = base64_encode($request->body);
        $settings->save();

        return redirect('admin/cms/contact');
    }
}
