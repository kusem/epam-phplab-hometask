<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * @inheritDoc
     */
    public function repeatArrayValues(array $input): array
    {
        $new_array = [];
        if (count($input) != 0) {
            foreach ($input as $currentElement) {
                for ($i = $currentElement; $i > 0; $i--) {
                    $new_array[] = $currentElement;
                }
            }
        }

        return $new_array;
    }

    /**
     * @inheritDoc
     */
    public function getUniqueValue(array $input): int
    {
        $uniqueArray = array_unique($input, SORT_NUMERIC);   //getting single values
        $count_values = array_count_values($input);

        foreach ($uniqueArray as $value) {                        //converting single values array into unique values
            if ($count_values[$value] > 1) {
                $key = array_search($value, $uniqueArray);
                unset($uniqueArray[$key]);
            }
        }

        if (count($uniqueArray) == 0) {
            return 0;
        } else {
            return min($uniqueArray);
        }
    }


    /**
     * @inheritDoc
     */
    public function groupByTag(array $input): array
    {
        $resultArray = [];
        $tagsArray = [];

        foreach ($input as $currentElement) {
            foreach ($currentElement['tags'] as $currentElementTag) {
                $tagsArray[$currentElementTag][] = $currentElement['name'];
            }
        }

        foreach ($tagsArray as $currentTagName => $currentTagContent) {
            sort($currentTagContent);
            $resultArray[$currentTagName] = $currentTagContent;
        }

        return $resultArray;
    }
}
