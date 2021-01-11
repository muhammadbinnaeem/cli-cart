<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Bill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Bill';

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
        // Check cart not found
        $cart = Cart::latest()->first();
        if(!$cart){
            $this->error("Cart not found.");
            return;
        }
        
        $this->info("Subtotal: ".$cart->sub_total.", discount: ".$cart->discount.", total: ".$cart->total);
    }
}
