<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\SiteSetting;
use App\Models\Category;

class SiteSettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $settings = SiteSetting::pluck('data', 'name')->toArray();

        $categories = Category::where('status','1')->with('subcategory')->withCount('items')->get();

        $countQty = 0;
        $cartItem = session('cart',[]);
        foreach ($cartItem as $cart) {
            $countQty += $cart['qty'];
        }

        view()->share(['settings' => $settings, 'categories'=>$categories, 'countQty'=>$countQty]);

        $response = $next($request);

        // JsonResponse veya RedirectResponse türlerini kontrol et
        if ($response instanceof JsonResponse) {
            return new Response($response->content(), $response->status(), $response->headers->all());
        } elseif ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

        return $response;
    }
}
