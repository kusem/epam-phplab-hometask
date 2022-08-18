<?php

namespace strings;

class Strings implements StringsInterface
{
    /**
     * @inheritDoc
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        $words = explode('_', $input);
        $response = $words[0];
        array_shift($words);

        foreach ($words as $word) {
            $response .= mb_strtoupper(mb_substr($word, 0, 1)) . mb_substr($word, 1);
        }

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function mirrorMultibyteString(string $input): string
    {
        $words = explode(' ', $input);
        $response = [];

        foreach ($words as $word) {
            $new_word = "";
            for ($i = strlen($word); $i > 0; $i--) {
                $new_word .= mb_substr($word, $i - 1, 1);
            }
            $response [] = $new_word;
        }

        return implode(" ", $response);
    }

    /**
     * @inheritDoc
     */
    public function getBrandName(string $noun): string
    {
        if ($noun[0] === $noun[strlen($noun) - 1]) {
            return strtoupper($noun[0]) . substr($noun, 1, strlen($noun) - 1) . substr($noun, 1, strlen($noun) - 1);
        } else {
            return "The " . strtoupper($noun[0]) . substr($noun, 1, strlen($noun) - 1);
        }
    }
}
