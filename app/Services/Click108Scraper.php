<?php


namespace App\Services;


use Goutte;
use Symfony\Component\DomCrawler\Crawler;
use App\Struct\DailyHoroscope;
use App\DailyHoroscope as HoroscopeModel;

class Click108Scraper
{
    public function scrapeAllAndStore()
    {
        $horoscopes = [];
        for ($starSign = 0; $starSign < 12; $starSign++) {
            $horoscopes[] = $this->scrapeDailyHoroscope($starSign);
        }

        foreach ($horoscopes as $horoscope) {
            $this->save($horoscope);
        }

    }

    public function scrapeDailyHoroscope(int $starSignIndex): DailyHoroscope
    {
        $date = date("Y-m-d");
        $url = $this->makeDailyHoroscopeURL($date, $starSignIndex);

        /** @var Crawler $crawler */
        $crawler = Goutte::request('GET', $url);
        $starSign = "";
        $crawler->filter('.TODAY_CONTENT > h3')->each(function (Crawler $node) use (&$starSign) {
            $starSign = $node->text();
        });

        $content = array();
        $crawler->filter('.TODAY_CONTENT > p')->each(function (Crawler $node, $i) use (&$content) {
            $content[$i] = $node->text();
        });
        $starSign = $this->parseStarSign($starSign);

        $horoscope = new DailyHoroscope();
        $horoscope->date = $date;
        $horoscope->starSign = $starSign;
        $horoscope->overallScore = $this->parseScore($content[0]);
        $horoscope->overallContent = $content[1];
        $horoscope->relationshipScore = $this->parseScore($content[2]);
        $horoscope->relationshipContent = $content[3];
        $horoscope->careerScore = $this->parseScore($content[4]);
        $horoscope->careerContent = $content[5];
        $horoscope->financeScore = $this->parseScore($content[6]);
        $horoscope->financeContent = $content[7];

        return $horoscope;
    }

    public function save(DailyHoroscope $horoscope)
    {
        $model = new HoroscopeModel;
        $model->date = $horoscope->date;
        $model->star_sign = $horoscope->starSign;
        $model->overall_score = $horoscope->overallScore;
        $model->overall_content = $horoscope->overallContent;
        $model->relationship_score = $horoscope->relationshipScore;
        $model->relationship_content = $horoscope->relationshipContent;
        $model->career_score = $horoscope->careerScore;
        $model->career_content = $horoscope->careerContent;
        $model->finance_score = $horoscope->financeScore;
        $model->finance_content = $horoscope->financeContent;

        $model->save();
    }

    private function parseStarSign(string $text): string
    {
        return mb_substr($text, 2, 3);
    }

    private function parseScore(string $star): int
    {
        return substr_count($star, '★');
    }

    public function makeDailyHoroscopeURL(string $date, int $starSignIndex): string
    {
        $format = "https://astro.click108.com.tw/daily_%d.php?iAcDay=%s&iAstro=%d";

        return sprintf($format, $starSignIndex, $date, $starSignIndex);
    }
}
