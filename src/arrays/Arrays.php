<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * @inheritDoc
     */
    public function repeatArrayValues(array $input): array
    {
        return array_merge(
            ...array_map(
                   fn(int $values): array => array_fill(
                       0,
                       $values,
                       $values
                   ),
                   $input
               )
        );
    }

    /**
     * @inheritDoc
     */
    public function getUniqueValue(array $input): int
    {
        $uniqueArray = array_unique($input, SORT_NUMERIC);
        sort($uniqueArray);
        $countValues = array_count_values($input);

        foreach ($uniqueArray as $value) {
            if ($countValues[$value] === 1) {
                return $value;
            }
        }

        return 0;
    }


    /**
     * @inheritDoc
     */
    public function groupByTag(array $input): array
    {
        $resultArray = [];
        sort($input);

        foreach ($input as $currentElement) {
            foreach ($currentElement['tags'] as $currentElementTag) {
                $resultArray[$currentElementTag][] = $currentElement['name'];
            }
        }

        return $resultArray;
    }
}
