<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;

class Checkout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checkout';

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
        // create new cart
        $cart = new Cart;
        $cart->save();
        $this->info("Empty Cart.");
    }
}
