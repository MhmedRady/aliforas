<?php

namespace App\Console\Commands;

use App\Models\Translations\ProductTranslation;
use Illuminate\Console\Command;

class FixOldSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slug:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix old slug urls';

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
        ProductTranslation::all()->whereNotNull('slug')->each(function (ProductTranslation $productTranslation) {
            $productTranslation->update([
                'name' => trim(trim(str_replace([
                    '/', '\\', '"', '\''
                ], ' ', $productTranslation->name), '-'), ' '),
                'slug' => trim(trim(str_replace([
                    '/', '\\', '"', '\''
                ], '-', $productTranslation->slug), '-'), ' '),
            ]);
        });
        return Command::SUCCESS;
    }
}
