<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;
use App\Models\Slider;
use Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $dosyadi = null;
        $resimurl = null;

        if ($request->hasFile('image')) {
            $resim = $request->file('image');
            $dosyadi = time() . '-' . Str::slug($request->name) . '.' . $resim->getClientOriginalExtension();
            $resim->move(public_path('img/slider'), $dosyadi);


            $resimurl = asset('img/slider/' . $dosyadi);
        }


        Slider::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'content'=>$request->content,
            'status'=>$request->status,
            'image' => $resimurl ?? NULL,
        ]);

        return back()->withSuccess('Basariyla olusturuldu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::where('id',$id)->first();
        return view('backend.pages.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosyadi = null;
        $resimurl = null;

        if ($request->hasFile('image')) {
            $resim = $request->file('image');
            $dosyadi = time() . '-' . Str::slug($request->name) . '.' . $resim->getClientOriginalExtension();
            $resim->move(public_path('img/slider'), $dosyadi);


            $resimurl = asset('img/slider/' . $dosyadi);
        }

        Slider::where('id', $id)->update([
            'name' => $request->name,
            'link' => $request->link,
            'content' => $request->content,
            'status' => $request->status,
            'image' => $resimurl ?? $slider->image,
        ]);

        return back()->withSuccess('Başarıyla güncellendi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider = Slider::where('id',$request->id)->firstOrFail();



        dosyasil($slider->image);
        $slider->delete();
        return response(['error'=>false,'message'=>'Basariyla silindi.']);
    }

    public function status(Request $request) {
        $update = $request->statu;
        $updatecheck = $update == "false" ?  '0' : '1';
        Slider::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false,'status'=>$update]);
    }
}
