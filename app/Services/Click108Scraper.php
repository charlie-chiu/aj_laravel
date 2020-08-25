<?php


namespace App\Services;


use Goutte;
use Symfony\Component\DomCrawler\Crawler;
use App\DailyHoroscope;

class Click108Scraper
{


    /*
     * url
     * https://astro.click108.com.tw/daily_2.php?iAcDay=2020-08-24&iAstro=2
     *
     * from 0 ~ 11
     */


    public function scrapeDailyHoroscope(): DailyHoroscope
    {
        $url = 'https://astro.click108.com.tw/daily_0.php?iAstro=0#lucky';

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

//        $overallScore = $this->parseScore($content[0]);
//        $overallContent = $content[1];
//        $relationshipScore = $this->parseScore($content[2]);
//        $relationshipContent = $content[3];
//        $careerScore = $this->parseScore($content[4]);
//        $careerContent = $content[5];
//        $financeScore = $this->parseScore($content[6]);
//        $financeContent = $content[7];
//
//        dump([
//            $starSign,
//            $overallScore,
//            $overallContent,
//            $relationshipScore,
//            $relationshipContent,
//            $careerScore,
//            $careerContent,
//            $financeScore,
//            $financeContent,
//        ]);

        $horoscope = New DailyHoroscope();
        $horoscope->starSign = $starSign;
        $horoscope->overallScore = $this->parseScore($content[0]);
        $horoscope->overallContent = $content[1];
        $horoscope->relationshipScore = $this->parseScore($content[2]);
        $horoscope->relationshipContent = $content[3];
        $horoscope->careerScore = $this->parseScore($content[4]);
        $horoscope->careerContent = $content[5];
        $horoscope->financeScore = $this->parseScore($content[6]);
        $horoscope->financeContent = $content[7];

        dump($horoscope);

        return $horoscope;
    }

    public function save(DailyHoroscope $horoscope)
    {
        throw (new \Exception("save failed"));
        //
    }

    private function parseStarSign(string $text): string
    {
        return mb_substr($text, 2, 3);
    }

    private function parseScore(string $star): int
    {
        return substr_count($star, '★');
    }
}
