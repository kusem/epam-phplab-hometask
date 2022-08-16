<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    private $crawler;

    /**
     * Parses link to poster image from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getPoster($crawler): string
    {
        return $crawler->filterXPath('//*[@id="dle-content"]/div/article/div[1]/div[2]/div[1]/div[1]/a')->attr('href');
    }

    /**
     * Parses movie title from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getMovieName($crawler): string
    {
        return trim($crawler->filterXPath('//*[@id="fheader"]/h1')->text());
    }

    /**
     * Parses movie description from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getMovieDescription($crawler): string
    {
        return trim($crawler->filterXPath('//*[@id="fdesc"]')->text());
    }

    public function parseContent(string $siteContent)
    {
        $this->crawler = new Crawler($siteContent);
        $title = $this->getMovieName($this->crawler);
        $poster = $this->getPoster($this->crawler);
        $description = $this->getMovieDescription($this->crawler);

        return new Movie($title, $poster, $description);
    }
}
