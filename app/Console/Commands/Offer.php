<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Offer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer {offer} {item}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add offer to Shopping Cart';

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
        $offer = $this->argument('offer');

        // Check cart
        $cart = Cart::latest()->first();
        if(!$cart){
            $this->error("Cart not found.");
            return;
        }
        // Check cart item
        $cart_item = CartItem::where('name',$item)->where('cart_id',$cart->id)->first();
        if(!$cart_item){
            $this->error("Cart Item not found.");
            return;
        }
        // Check cart item offer
        if($cart_item->discount != null){
            $this->error("Offer already applied to this item.");
            return;
        }
        $cart_item->discount = $offer;
        $cart_item->save();
        
        $this->info("Offer added.");
    }
}
