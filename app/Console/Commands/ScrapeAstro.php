<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScrapeAstro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape astro.click108.com.tw';

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
     * @return mixed
     */
    public function handle()
    {
        echo "scrape http://astro.click108.com.tw/ \n";
    }
}
