<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index() {

        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart) {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        return view('frontend.pages.cart',compact('cartItem','totalPrice'));
    }

    public function add(Request $request) {
        $productId = $request->product_id;
        $qty = $request->qty ?? 1;
        $size = $request->size;
        $urun = Product::find($productId);
        if(!$urun){
            return back()->withErrors('Urun bulunamadi');
        }
        $cartItem = session('cart',[]);

        if(array_key_exists($productId,$cartItem)){
            $cartItem[$productId]['qty'] += $qty;
        }else{
            $cartItem[$productId]=[
                'image'=>$urun->image,
                'name'=>$urun->name,
                'price'=>$urun->price,
                'qty'=>$qty,
                'size'=>$size,
            ];
        }
        session(['cart'=>$cartItem]);

        return back()->withSuccess('Urun eklendi');
    }

    public function remove(Request $request) {
        $productId = $request->product_id;
        $cartItem = session('cart',[]);
        if(array_key_exists($productId,$cartItem)){
            unset($cartItem[$productId]);
        }
        session(['cart'=>$cartItem]);
        return back()->withSuccess('Urun basariyla kaldirildi');
    }
}
