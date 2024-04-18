<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UseAddress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Product $product)
    {
        //dd('ddd');
        $user = $request->user();
        if ($user){
            $cartItems = CartItem::where('user_id', $user->id)->get();
            $userAddress = UseAddress::where('user_id', $user->id)->where('isMain',1)->first();
            if ($cartItems->count() > 0){
                return  Inertia::render('User/CartList', [
                    'cartItems' => $cartItems,
                    'userAddress' => $userAddress,
                ]); //User/Cart/Index
            }
        }
        /**Guest**/
        else{

            $cartItems = Cart::getCookiesCartItems();
            if (count($cartItems) > 0 ){
                $cartItems = new CartResource(Cart::getProductsAndCartItems());

                return  Inertia::render('User/CartList', [
                    'cartItems' => $cartItems,
                ]);
            }else{
                /**no items **/

                return redirect()->back();
            }
        }



    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $quantity = $request->post('quantity', 1);
        $user    = $request->user();

        if ($user){
            $cartItem = CartItem::where(['user_id' => $user->id, 'product_id' => $product->id])->first();
            if ($cartItem){
                //$cartItem->quantity = $cartItem->quantity + $quantity;
                $cartItem->increment('quantity');

            }else{
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => 1,

                ]);
            }
        }else{
            $cartItems = Cart::getCookiesCartItems();
            $isProductExists = false;
            foreach ($cartItems as $item){
                if ($item['product_id'] === $product->id)
                {
                    $item['quantity'] += $quantity;
                    $isProductExists = true;
                    break;
                }
            }

            if (!$isProductExists){
                $cartItems[] =[
                    'user_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price

                ];
            }

            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $quantity = $request->integer('quantity');
        $user    = $request->user();
        if ($user){
            CartItem::where(['user_id' => $user->id, 'product_id' => $product->id])->update(['quantity' => $quantity]);
        }else{
            //guest
             $cartItems = Cart::getCookiesCartItems();
             foreach ($cartItems as &$item){
                 if ($item['product_id'] === $product->id){
                     /**Increase the quantity*/
                     $item['quantity'] = $quantity;
                        break;
                 }
             }
             Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user){
            //CartItem::query()->where(['user_id', $user->id, 'product_id' =>$product->id])->first()?->delete();
            CartItem::query()->where(['user_id' => $user->id, 'product_id' => $product->id])->first()?->delete();
            if (CartItem::count() < 0){
                return redirect()->route('home')->with('info', 'Your cart is empty!');
            }else{
                return redirect()->back()->with('success', 'Item removed from cart successfully!');
            }

        }else{
            /*Delete the Guest*/
            $cartItems = Cart::getCookiesCartItems();
            foreach ($cartItems as $i => &$item){
                if ($item['product_id'] === $product->id){
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            Cart::setCookieCartItems($cartItems);
            if (count($cartItems) < 0){
                return redirect()->route('home')->with('info', 'Your cart is empty!');
            }else{
                return redirect()->back()->with('success', 'Item removed from cart successfully!');
            }

        }
    }
}
