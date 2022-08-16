<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */

namespace src\oop\app\src;

class Scrapper
{
    private $getBody;
    private $parseBody;

    public function __construct($getBodyContent, $parseBodyContent)
    {
        $this->getBody = $getBodyContent;
        $this->parseBody = $parseBodyContent;
    }

    public function getMovie(string $url)
    {
        $getBodyHTML = $this->getBody->getContent($url);
        $parseBody = $this->parseBody->parseContent($getBodyHTML);

        return $parseBody;
    }
}
