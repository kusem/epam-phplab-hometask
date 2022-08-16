<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
{
    /**
     * Parses link to poster image from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getPoster(string $rawHTML): string
    {
        $imgBegin = strpos($rawHTML, 'https://thumbs.filmix.ac/posters/');
        $imgEnd = strpos($rawHTML, '"', $imgBegin);
        $imageLink = substr($rawHTML, $imgBegin, $imgEnd - $imgBegin);

        return $imageLink;
    }

    /**
     * Parses movie title from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getMovieName(string $rawHTML): string
    {
        $titleTagBegin = strpos($rawHTML, '<h1 class="name" itemprop="name">');
        $titleTagEnd = strpos($rawHTML, '</h1>', $titleTagBegin);
        $movieTitle = substr(
            $rawHTML,
            $titleTagBegin + strlen('<h1 class="name" itemprop="name">'),
            $titleTagEnd - $titleTagBegin - strlen('<h1 class="name" itemprop="name">')
        );

        return $movieTitle;
    }

    /**
     * Parses movie description from original HTML page
     *
     * @param string $rawHTML
     * @return string
     */
    public function getMovieDescription(string $rawHTML): string
    {
        $descrTagBegin = strpos($rawHTML, '<div class="full-story">');
        $descrTagEnd = strpos($rawHTML, '</div>', $descrTagBegin);
        $movieDescr = substr(
            $rawHTML,
            $descrTagBegin + strlen('<div class="full-story">'),
            $descrTagEnd - $descrTagBegin - strlen('<div class="full-story">')
        );

        return $movieDescr;
    }

    /**
     * Takes site content string and returns Movie with title/post/description.
     *
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        $title = $this->getMovieName($siteContent);
        $poster = $this->getPoster($siteContent);
        $description = $this->getMovieDescription($siteContent);

        return new Movie($title, $poster, $description);
    }
}
