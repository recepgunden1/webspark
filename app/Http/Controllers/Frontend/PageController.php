<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Product;
use App\Models\Category;

class PageController extends Controller
{
    public function urunler(Request $request, $slug = null)
    {
        // Ana kategori ve alt kategorileri bulma
        $category = request()->segment(1);

        $sizes = !empty($request->size) ? explode(',', $request->size) : null;
        $colors = !empty($request->color) ? explode(',', $request->color) : null;
        $startprice = $request->min ?? null;
        $endprice = $request->max ?? null;
        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';

        $anakategori = null;
        $altkategori = null;

        // Breadcrumb yapısını oluştur
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Ürün Detay'
        ];

        // Ana kategori ve alt kategoriyi bul
        if (!empty($category)) {
            $anakategori = Category::where('slug', $category)->first();
        }

        if (!empty($slug)) {
            $altkategori = Category::where('slug', $slug)->first();
        }

        // Ana kategori kontrolü
        if (!$anakategori) {
            return redirect()->back()->withErrors(['message' => 'Ana kategori bulunamadı.']);
        }

        // Ürünleri listeleme sorgusu
        $products = Product::where('status', '1')
            ->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            ->where(function ($q) use ($sizes, $colors, $startprice, $endprice) {
                if (!empty($sizes)) {
                    $q->whereIn('size', $sizes);
                }

                if (!empty($colors)) {
                    $q->whereIn('color', $colors);
                }

                if (!empty($startprice) && $endprice) {
                    $q->where('price', '>=', $startprice);
                    $q->where('price', '<=', $endprice);
                }
                return $q;
            })
            ->whereHas('category', function ($q) use ($anakategori, $altkategori) {
                if ($altkategori) {
                    $q->where('id', $altkategori->id);
                } else {
                    $subcategoryIds = $anakategori->subcategory()->pluck('id')->toArray();
                    $allCategoryIds = array_merge([$anakategori->id], $subcategoryIds);
                    $q->whereIn('id', $allCategoryIds);
                }
                return $q;
            })
            ->orderBy($order, $sort)
            ->paginate(21);

        // AJAX isteği ise ürün listesini döndür
        if ($request->ajax()) {
            $view = view('frontend.ajax.productList', compact('products'))->render();
            return response([
                'data' => $view,
                'paginate' => (string) $products->withQueryString()->links('vendor.pagination.custom')
            ]);
        }

        // Filtreleme için gerekli veriler
        $sizelists = Product::where('status', '1')->groupBy('size')->pluck('size')->toArray();
        $colors = Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();
        $maxprice = Product::max('price');

        // View'ı döndür
        return view('frontend.pages.products', compact('breadcrumb', 'products', 'maxprice', 'sizelists', 'colors'));
    }

    public function urundetay($slug)
    {
        $product = Product::whereSlug($slug)->where('status', '1')->firstOrFail();
        $products = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->where('status', '1')
            ->limit(6)
            ->orderBy('id', 'desc')
            ->get();

        // Breadcrumb yapısını oluştur
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Ürün Detay'
        ];

        return view('frontend.pages.product', compact('product', 'products', 'breadcrumb'));
    }

    public function indirimdekiurunler()
    {
        // Ürünleri çek
        $products = Product::where('discounted', true)->paginate(10);

        // Breadcrumb yapısını oluştur
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'İndirimli Ürünler'
        ];

        // View'ı döndür
        return view('frontend.pages.products', compact('products', 'breadcrumb'));
    }

    public function hakkimizda()
    {
        $about = About::where('id', 1)->first();

        // Breadcrumb yapısı
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Hakkımızda'
        ];

        return view('frontend.pages.about', compact('about', 'breadcrumb'));
    }

    public function iletisim()
    {
        // Breadcrumb yapısı
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'İletişim'
        ];

        return view('frontend.pages.contact', compact('breadcrumb'));
    }
}
