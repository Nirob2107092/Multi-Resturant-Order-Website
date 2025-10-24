<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Carbon\Carbon;

class FilterController extends Controller
{
    public function ListRestaurant()
    {
        // Initial products for the first render
        $products = Product::latest()->get();

        // Active coupons per client (status=1 and not expired)
        $couponsByClient = Coupon::where('status', '1')
            ->where('validity', '>=', now()->format('Y-m-d'))
            ->get()
            ->keyBy('client_id');

        return view('frontend.list_restaurant', compact('products', 'couponsByClient'));
    }

    public function FilterProducts(Request $request)
    {
        $categoryIds = (array) $request->input('categorys', []);
        $menuIds     = (array) $request->input('menus', []);
        $cityIds     = (array) $request->input('citys', []);

        $productsQ = Product::query();

        if ($categoryIds) $productsQ->whereIn('category_id', $categoryIds);
        if ($menuIds)     $productsQ->whereIn('menu_id', $menuIds);
        if ($cityIds) {
            $productsQ->whereHas('client', function ($q) use ($cityIds) {
                $q->whereIn('city_id', $cityIds);
            });
        }

        $filterProducts = $productsQ->latest()->get();

        // Reuse coupons map for the partial
        $couponsByClient = Coupon::where('status', '1')
            ->where('validity', '>=', now()->format('Y-m-d'))
            ->get()
            ->keyBy('client_id');

        return view('frontend.product_list', compact('filterProducts', 'couponsByClient'))->render();
    }
}
