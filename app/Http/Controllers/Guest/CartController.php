<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\CartInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart;
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $carts = $this->cart->getByUserId(auth()->user()->id);
        return view('guest.cart.index', compact('carts'));
    }

    public function add(Request $request)
    {
        try {
            $this->cart->add($request->all());
            return response()->json(['status' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->cart->delete($request->id);
            return response()->json(['status' => true, 'message' => 'Produk berhasil dihapus dari keranjang']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
