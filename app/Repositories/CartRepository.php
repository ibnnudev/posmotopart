<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\Product;

class CartRepository implements CartInterface
{
    private $cart;
    private $product;

    public function __construct(Cart $cart, Product $product)
    {
        $this->cart    = $cart;
        $this->product = $product;
    }

    public function getByUserId($userId)
    {
        return $this->cart->where('user_id', $userId)->with('product')->get();
    }

    public function add($data)
    {
        $product                 = $this->product->where('id', $data['product_id'])->first();
        $data['user_id']         = auth()->user()->id;
        $data['store_id']        = $product->store_id;
        $data['product_merk_id'] = $product->product_merk_id;
        $data['discount']        = $product->discount ?? 0;
        $data['price']           = $product->price;
        $data['total_price']     = $product->discount ? $product->price - ($product->price * $product->discount / 100) * $data['qty'] : $product->price * $data['qty'];

        // check if user already add the product to cart
        $cart = $this->cart->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->first();
        if ($cart) {
            throw new \Exception('Produk sudah ada di keranjang');
        }

        return $this->cart->create($data);
    }

    public function update($data)
    {
        $data['total_price'] = $data['price'] * $data['qty'];
        return $this->cart->where('id', $data['id'])->update($data);
    }

    public function delete($id)
    {
        return $this->cart->where('id', $id)->delete();
    }

    public function checkout($data)
    {
        return $this->cart->where('user_id', $data['user_id'])->delete();
    }
}
