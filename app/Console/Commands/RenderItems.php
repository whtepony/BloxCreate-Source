<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use App\Jobs\RenderItem;

class RenderItems extends Command
{
    protected $signature = 'render:items';
    protected $description = 'render items.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $items = Item::where('status', '=', 'accepted')->get();

        foreach ($items as $item) {
            echo "Rendering item \"{$item->name}\" ({$item->id}).\n";
            RenderItem::dispatch($item->id)->delay(now()->addSeconds(3));
        }
    }
}