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

use src\oop\app\src\Parsers\ParserInterface;
use src\oop\app\src\Transporters\TransportInterface;

class Scrapper
{
    private TransportInterface $getBody;
    private ParserInterface $parseBody;

    /**
     * @param TransportInterface $transport
     * @param ParserInterface $parseMethod
     */
    public function __construct(TransportInterface $transport, ParserInterface $parseMethod)
    {
        $this->getBody = $transport;
        $this->parseBody = $parseMethod;
    }

    public function getMovie(string $url)
    {
        $getBodyHTML = $this->getBody->getContent($url);
        $parseBody = $this->parseBody->parseContent($getBodyHTML);

        return $parseBody;
    }
}
