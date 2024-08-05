<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str; // Str sınıfını eklemeyi unutmayın

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $products = Product::with('category:id,name')->orderBy('created_at', 'desc')->paginate(20);
        return view('backend.pages.product.index', compact('products'));
    }



    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        $categories = Category::all(); // 'Product::get()' yerine 'Category::all()' kullanımı daha doğru
        return view('backend.pages.product.edit', compact('categories'));
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(ProductRequest $request)
    {
        $resimurl = null;

        if ($request->hasFile('image')) {
            $resim = $request->file('image');
            $dosyadi = time() . '-' . Str::slug($request->name) . '.' . $resim->getClientOriginalExtension();
            $resim->move(public_path('img/urun'), $dosyadi);

            $resimurl = asset('img/urun/' . $dosyadi);
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'short_text' => $request->short_text,
            'price' => $request->price,
            'size' => $request->size,
            'color' => $request->color,
            'qty' => $request->qty,
            'image' => $resimurl ?? null,
            'status' => $request->status,
        ]);

        return back()->withSuccess('Başarıyla oluşturuldu');
    }

    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        // Burada gösterim için bir içerik eklemediniz, ihtiyaç duyulursa bu kısmı güncelleyebilirsiniz
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id); // 'where' yerine 'findOrFail' kullanımı daha iyi
        $categories = Category::all(); // 'Product::get()' yerine 'Category::all()' kullanımı daha doğru
        return view('backend.pages.product.edit', compact('product', 'categories'));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id); // 'where' yerine 'findOrFail' kullanımı daha iyi

        $resimurl = null;

        if ($request->hasFile('image')) {
            $resim = $request->file('image');
            $dosyadi = time() . '-' . Str::slug($request->name) . '.' . $resim->getClientOriginalExtension();
            $resim->move(public_path('img/urun'), $dosyadi);

            $resimurl = asset('img/urun/' . $dosyadi);
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'short_text' => $request->short_text,
            'price' => $request->price,
            'size' => $request->size,
            'color' => $request->color,
            'qty' => $request->qty,
            'image' => $resimurl ?? $product->image,
            'status' => $request->status,
        ]);

        return back()->withSuccess('Başarıyla güncellendi');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);

        // Resim dosyasını silme işlemi için mevcut fonksiyonu kullanın
        if ($product->image) {
            unlink(public_path('img/urun/' . basename($product->image)));
        }

        $product->delete();
        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }

    public function status(Request $request) {
        $update = $request->statu;
        $updatecheck = $update == "false" ?  '0' : '1';
        Product::where('id', $request->id)->update(['status' => $updatecheck]);
        return response(['error' => false, 'status' => $updatecheck]);
    }
}
