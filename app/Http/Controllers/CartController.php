<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Sepet'
        ];

        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart) {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        if(session()->get('coupon_code')) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->where('status','1')->first();
            $kuponprice = $kupon->price ?? 0;
            $kuponcode = $kupon->name ?? '';
            $newtotalPrice = $totalPrice - $kuponprice;
        } else{
            $newtotalPrice = $totalPrice;
        }
        session()->put('total_price',$newtotalPrice);
        return view('frontend.pages.cart',compact('cartItem','breadcrumb'));
    }

    public function sepetform() {
        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Sepet Formu'
        ];

        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart) {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        if(session()->get('coupon_code')) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->where('status','1')->first();
            $kuponprice = $kupon->price ?? 0;
            $kuponcode = $kupon->name ?? '';
            $newtotalPrice = $totalPrice - $kuponprice;
        } else{
            $newtotalPrice = $totalPrice;
        }
        session()->put('total_price',$newtotalPrice);
        return view('frontend.pages.cartform',compact('cartItem','breadcrumb'));
    }

    public function add(Request $request) {
        $productId = $request->product_id;
        $qty = $request->qty ?? 1;
        $size = $request->size;
        $urun = Product::find($productId);
        if(!$urun){
            return back()->withErrors('Ürün bulunamadı');
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

        return back()->withSuccess('Ürün eklendi');
    }

    public function newQty(Request $request) {
        $productID= $request->product_id;
        $qty= $request->qty ?? 1;
        $size= $request->size;
        $urun = Product::find($productID);
        if(!$urun) {
            return response()->json('Ürün Bulanamadı!');
        }
        $cartItem = session('cart', []);

        if(array_key_exists($productID, $cartItem)){
            $cartItem[$productID] ['qty'] = $qty;
            if($qty == 0 || $qty < 0) {
                unset($cartItem[$productID]);
            }
        }else{
            $cartItem[$productID]=[
                'image'=>$urun->image,
                'name'=>$urun->name,
                'price'=>$urun->price,
                'qty'=>$qty,
                'size'=>$size,
            ];
        }
        session(['cart'=>$cartItem]);

        if($request->ajax()) {
            return response()->json('Sepet Güncellendi');
        }
    }

    public function remove(Request $request) {
        $productId = $request->product_id;
        $cartItem = session('cart',[]);
        if(array_key_exists($productId,$cartItem)){
            unset($cartItem[$productId]);
        }
        session(['cart'=>$cartItem]);
        return back()->withSuccess('Ürün başarıyla kaldırıldı');
    }

    public function couponcheck(Request $request) {
        $request->all();

        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart) {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        $kupon = Coupon::where('name',$request->coupon_name)->where('status','1')->first();

        if(empty($kupon)){
            return back()->withError('Kupon Bulunamadı')->with('newtotalPrice');
        }

        $kuponprice = $kupon->price ?? 0;
        $kuponcode = $kupon->name ?? '';
        $newtotalPrice = $totalPrice - $kuponprice;

        session()->put('total_price',$newtotalPrice);
        session()->put('coupon_code',$kuponcode);
        session()->put('coupon_price',$kuponprice);

        return back()->withSuccess('Kupon Uygulandı')->with('newtotalPrice');
    }

    function generateOTP($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    function generateKod() {
        $siparisno = $this->generateOTP(7);
        if ($this->barcodeKodExists($siparisno)) {
            return $this->generateKod();
        }
        return $siparisno;
    }

    function barcodeKodExists($siparisno) {
        return Invoice::where('order_no', $siparisno)->exists();
    }

    public function cartSave(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'zip_code' => 'required|string',
            'note' => 'nullable|string',
        ],[
            'name.required' => __('İsim alanı zorunludur.'),
            'name.string' => __('İsim bir metin olmalıdır.'),
            'name.min' => __('İsim en az 3 karakterden oluşmalıdır.'),
            'email.required' => __('E-posta alanı zorunludur.'),
            'email.email' => __('Geçerli bir e-posta adresi girilmelidir.'),
            'phone.required' => __('Telefon alanı zorunludur.'),
            'phone.string' => __('Telefon bir metin olmalıdır.'),
            'company_name.string' => __('Şirket adı bir metin olmalıdır.'),
            'address.required' => __('Adres alanı zorunludur.'),
            'address.string' => __('Adres bir metin olmalıdır.'),
            'country.required' => __('Ülke alanı zorunludur.'),
            'country.string' => __('Ülke bir metin olmalıdır.'),
            'city.required' => __('Şehir alanı zorunludur.'),
            'city.string' => __('Şehir bir metin olmalıdır.'),
            'district.required' => __('İlçe alanı zorunludur.'),
            'district.string' => __('İlçe bir metin olmalıdır.'),
            'zip_code.required' => __('Posta kodu alanı zorunludur.'),
            'zip_code.string' => __('Posta kodu bir metin olmalıdır.'),
            'note.string' => __('Not bir metin olmalıdır.'),
        ]);

        $invoice = Invoice::create([
            "user_id" => auth()->user()->id ?? null,
            "order_no" => $this->generateKod(),
            "country" => $request->country,
            "name" => $request->name,
            "company_name" => $request->company_name ?? null,
            "address" => $request->address ?? null,
            "city" => $request->city ?? null,
            "district" => $request->district ?? null,
            "zip_code" => $request->zip_code ?? null,
            "email" => $request->email ?? null,
            "phone" => $request->phone ?? null,
            "note" => $request->note ?? null,
        ]);

        $carts = session()->get('cart') ?? [];
        foreach ($carts as $key => $item) {
            Order::create([
                'order_no'=>$invoice->order_no,
                'product_id'=>$key,
                'name'=>$item['name'],
                'price'=>$item['price'],
                'qty'=>$item['qty'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('anasayfa');
    }
}
