<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function index(Request $req)
    {
        $total = 0;
        $productsInCart = [];

        $productInSession = $req->session()->get('products');
        if ($productInSession) {
            $productsInCart = Product::findMany(array_keys($productInSession));
            $total = Product::sumPriceByQuantities($productsInCart, $productInSession);
        }

        $viewData = [];
        $viewData['title'] = 'Cart - Online Store';
        $viewData['subtitle'] = 'Shopping Cart';
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.index', compact('viewData'));
    }

    public function add(Request $req, $id)
    {
        // Redirect ke login kalo blm ada session -> user
        if (!Auth::user()) {
            return redirect('/login');
        }

        $products = $req->session()->get('products');
        $products[$id] = $req->input('quantity');
        $req->session()->put('products', $products);

        return redirect('/cart');
    }

    public function delete(Request $req)
    {
        $req->session()->forget('products');
        return back();
    }

    public function purchase(Request $req)
    {
        $productInSession = $req->session()->get('products');
        if (!$productInSession) {
            return redirect('/cart');
        }

        $userId = Auth::user()->getId();
        $order = new Order();
        $order->setUserId($userId);
        $order->setTotal(0);
        $order->save();

        $total = 0;
        $productsInCart = Product::findMany(array_keys($productInSession));
        foreach ($productsInCart as $product) {
            $quantity = $productInSession[$product->getId()];
            $item = new Item();
            $item->setQuantity($quantity);
            $item->setPrice($product->getPrice());
            $item->setProductId($product->getId());
            $item->setOrderId($order->getId());
            $item->save();
            $total = $total + ($product->getPrice() * $quantity);
        }

        $order->setTotal($total);
        $order->save();

        $newBalance = Auth::user()->getBalance() - $total;
        Auth::user()->setBalance($newBalance);
        Auth::user()->save();

        $req->session()->forget('products');

        $viewData = [];
        $viewData['title'] = 'Purchase - Online Store';
        $viewData['subtitle'] = 'Purchase Status';
        $viewData['order'] = $order;
        return view('cart.purchase', compact('viewData'));
    }
}
