<?php


namespace App\Services;


use Goutte;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeService
{

    /*
     * url
     * https://astro.click108.com.tw/daily_2.php?iAcDay=2020-08-24&iAstro=2
     *
     * from 0 ~ 11
     */

    function scrapeClick108()
    {
        $url = 'https://astro.click108.com.tw/daily_0.php?iAstro=0#lucky';


        /** @var Crawler $crawler */
        $crawler = $this->getClick108($url);
        $starSign = "";
        $crawler->filter('.TODAY_CONTENT > h3')->each(function (Crawler $node) use (&$starSign) {
            $starSign = $node->text();
        });

        $content = array();
        $crawler->filter('.TODAY_CONTENT > p')->each(function (Crawler $node, $i) use (&$content) {
            $content[$i] = $node->text();
        });

        $starSign = $this->parseStarSign($starSign);
        $overallScore = $this->parseScore($content[0]);
        $overallContent = $content[1];
        $relationshipScore = $this->parseScore($content[2]);
        $relationshipContent = $content[3];
        $careerScore = $this->parseScore($content[4]);
        $careerContent = $content[5];
        $financeScore = $this->parseScore($content[6]);
        $financeContent = $content[7];

        dump([
            $starSign,
            $overallScore,
            $overallContent,
            $relationshipScore,
            $relationshipContent,
            $careerScore,
            $careerContent,
            $financeScore,
            $financeContent,
        ]);
    }

    function getClick108(string $url)
    {
        return Goutte::request('GET', $url);
    }

    function parseStarSign(string $text): string
    {
        return mb_substr($text, 2, 3);
    }

    function parseScore(string $star): int
    {
        return substr_count($star, '★');
    }
}
