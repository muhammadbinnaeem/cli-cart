<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\InventoryImport;

class LoadInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load_inventory {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load Inventory from file';

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
        $filename = $this->argument('filename');
        Excel::import(new InventoryImport, $filename);
        $this->info('Inventory Loaded Successfully.');
    }
}
