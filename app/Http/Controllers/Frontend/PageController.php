<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Product;
use App\Models\Category;

class PageController extends Controller
{
    public function urunler(Request $request,$slug=null)
    {
        $category = request()->segment(1) && null;

        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $startprice = $request->start_price ?? null;
        $endprice = $request->end_price ?? null;
        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';

        $products = Product::where('status','1')->select(['id','name','slug','size','color','price','category_id','image'])
        ->where(function($q) use($size,$color,$startprice,$endprice) {
            if(!empty($size))
            {
                $q->where('size',$size);
            }

            if(!empty($color))
            {
                $q->where('color',$color);
            }

            if(!empty($startprice) && $endprice)
            {
                $q->whereBetween('price',[$startprice,$endprice]);
            }
            return $q;
        })
        ->with('category:id,name,slug')
        ->whereHas('category',function($q) use($category,$slug) {
            if(!empty($slug)) {
                $q->where('slug',$slug);
            }
            return $q;
        });

        $minprice = $products->min('price');
        $maxprice = $products->max('price');

        $sizelists = Product::where('status','1')->groupBy('size')->pluck('size')->toArray();
        $colors = Product::where('status','1')->groupBy('color')->pluck('color')->toArray();

        $products = $products->orderBy($order,$sort)->paginate(21);

        return view('frontend.pages.products',compact('products','minprice','maxprice','sizelists','colors'));
    }

    public function urundetay($slug)
    {
        $product = Product::whereSlug($slug)->where('status','1')->firstOrFail();
        $products = Product::where('id','!=',$product->id)
        ->where('category_id',$product->category_id)
        ->where('status','1')
        ->limit(6)
        ->get();
        return view('frontend.pages.product',compact('product','products'));
    }

    public function indirimdekiurunler()
    {
        return view('frontend.pages.product');
    }

    public function hakkimizda()
    {
        $about = About::where('id',1)->first();
        return view('frontend.pages.about', compact('about'));
    }

    public function iletisim()
    {
        return view('frontend.pages.contact');
    }

}
