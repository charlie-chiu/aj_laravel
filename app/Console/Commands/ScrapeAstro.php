<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Click108Scraper;

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
     * @var Click108Scraper
     */
    private $click108Scraper;

    /**
     * Create a new command instance.
     *
     * @param Click108Scraper $scraper
     * @return void
     */
    public function __construct(Click108Scraper $scraper)
    {
        parent::__construct();
        $this->click108Scraper = $scraper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->click108Scraper->scrapeAllAndStore();

        echo "task done\n";
    }
}
