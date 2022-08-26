<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    private Crawler $crawler;
    private Movie $movie;

    public function __construct(Crawler $crawler, Movie $movie)
    {
        $this->crawler = $crawler;
        $this->movie = $movie;
    }

    /**
     * Parses link to poster image from original HTML page
     *
     * @return string
     */
    public function getPoster(): string
    {
        return $this->crawler
            ->filterXPath('//*[@id="dle-content"]/div/article/div[1]/div[2]/div[1]/div[1]/a')->attr('href');
    }

    /**
     * Parses movie title from original HTML page
     *
     * @return string
     */
    public function getMovieName(): string
    {
        return trim($this->crawler->filterXPath('//*[@id="fheader"]/h1')->text());
    }

    /**
     * Parses movie description from original HTML page
     *
     * @param $crawler
     * @return string
     */
    public function getMovieDescription(): string
    {
        return trim($this->crawler->filterXPath('//*[@id="fdesc"]')->text());
    }

    public function parseContent(string $siteContent): Movie
    {
        $this->crawler->addContent($siteContent);

        $this->movie->setTitle($this->getMovieName($siteContent));
        $this->movie->setPoster($this->getPoster($siteContent));
        $this->movie->setDescription($this->getMovieDescription($siteContent));

        return $this->movie;
    }
}
