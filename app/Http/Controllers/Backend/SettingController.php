<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index() {
        $settings = SiteSetting::get();
        return view('backend.pages.setting.index', compact('settings'));
    }

    public function create() {
        return view('backend.pages.setting.edit');
    }

    public function store(Request $request) {
        $key = $request->name;

            SiteSetting::firstOrCreate([
                'name'=>$key,
            ],[
                'name'=>$key,
                'data'=>$request->data,
                'set_type'=>$request->set_type,
            ]);
            return back()->withSuccess('Başarılı');
        }

    public function edit($id) {
        $setting = SiteSetting::where('id',$id)->first();
        return view('backend.pages.setting.edit',compact('setting'));
    }

    public function update($id) {
        $setting = SiteSetting::where('id',$id)->first();
    }
}
