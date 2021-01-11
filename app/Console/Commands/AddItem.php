<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class AddItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add {item} {quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add item to shopping cart';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $item = $this->argument('item');
        $quantity = $this->argument('quantity');

        // Check product
        $product = Product::where('name',$item)->first();
        if(!$product){
            $this->error("Product not found.");
            return;
        }
        // Check product availability
        if($quantity > $product->quantity){
            $this->error("Required quantity is not available.");
            return;
        }

        // Get latest cart or create if not exist
        $cart = Cart::latest()->first();
        if(!$cart){
            $cart = new Cart;
            $cart->save();
        }

        // Check if cart item is already exist
        $cart_item = CartItem::where('name',$item)->where('cart_id',$cart->id)->first();
        if($cart_item){
            $this->error("Cart Item already exist.");
            return;
        }

        // Add item into cart
        $cart_item = new CartItem;
        $cart_item->cart_id = $cart->id;
        $cart_item->name = $product->name;
        $cart_item->quantity = $quantity;
        $cart_item->save();
        
        $this->info("Item added successfully.");
    }
}
