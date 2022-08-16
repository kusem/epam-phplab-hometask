<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{
    /**
     * @inheritDoc
     */
    public function getContent(string $url): string
    {
        $ch = curl_init($url);
        $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $result = curl_exec($ch);

        if (mb_detect_encoding($result, ['UTF-8', 'windows-1251']) != "UTF-8") {
            $result = iconv(mb_detect_encoding($result, ['windows-1251']), "UTF-8", $result);
        }

        return $result;
    }
}
