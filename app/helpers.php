<?php

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity ($product_id, $color_id = null, $size_id = null){ //Color_id and size_id are optional fields that's why "= null"
    $product = Product::find($product_id);

    if($size_id){ 
        $size = Size::find($size_id); //Find the size
        $quantity = $size->colors->find($color_id)->pivot->quantity; //Find color

    }elseif($color_id){
        $quantity = $product->colors->find($color_id)->pivot->quantity;

    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

//Determines the quantity of products in the cart
function qty_added($product_id, $color_id = null, $size_id = null){
    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.color_id', $color_id)
                ->where('options.size_id', $size_id)
                ->first(); //Indicates that it returns an object, not a collection

    if($item){
        return $item->qty;
    }else{
        return 0;
    }
}

function qty_available($product_id, $color_id = null, $size_id = null){
    
    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);
}