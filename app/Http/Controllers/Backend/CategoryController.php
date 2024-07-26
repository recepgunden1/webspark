<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parentCategory:id,cat_ust,name')->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.pages.category.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $dosyadi = null;
        $resimurl = null;

        if ($request->hasFile('image')) {
            $resim = $request->file('image');
            $dosyadi = time() . '-' . Str::slug($request->name) . '.' . $resim->getClientOriginalExtension();
            $resim->move(public_path('img/kategori'), $dosyadi);


            $resimurl = asset('img/slider/' . $dosyadi);
        }


        Category::create([
            'name'=>$request->name,
            'cat_ust'=>$request->cat_ust,
            'status'=>$request->status,
            'content'=>$request->content,
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
        $category = Category::where('id', $id)->first();
        $categories = Category::get();
        return view('backend.pages.category.edit', compact('category', 'categories'));
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
            $resim->move(public_path('img/kategori'), $dosyadi);


            $resimurl = asset('img/kategori/' . $dosyadi);
        }

        Category::where('id', $id)->update([
            'name'=>$request->name,
            'cat_ust'=>$request->cat_ust,
            'status'=>$request->status,
            'content'=>$request->content,
            'image' => $resimurl ?? NULL,
        ]);

        return back()->withSuccess('Başarıyla güncellendi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id',$request->id)->firstOrFail();



        dosyasil($category->image);
        $category->delete();
        return response(['error'=>false,'message'=>'Basariyla silindi.']);
    }

    public function status(Request $request) {
        $update = $request->statu;
        $updatecheck = $update == "false" ?  '0' : '1';
        Category::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false,'status'=>$update]);
    }
}
