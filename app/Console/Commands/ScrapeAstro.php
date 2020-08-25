<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScrapeService;

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
     * @var ScrapeService
     */
    private $scrapeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ScrapeService $scrapeService)
    {
        parent::__construct();
        $this->scrapeService = $scrapeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo $this->scrapeService->scrapeClick108() . "\n";

        echo "task done\n";
    }
}
