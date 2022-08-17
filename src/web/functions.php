<?php

/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $allLetters = [];
    foreach ($airports as $airport) {
        $allLetters[] = $airport['name'][0];
    }
    $uniqueLetters = array_unique($allLetters);
    sort($uniqueLetters);

    return $uniqueLetters;
}

/**
 * Shows 5 airport if page is set.
 * @param array $airports
 * @return array
 */
function pagination(array $airports): array
{
    if (isset($_GET['page']) and $_GET['page'] > 1) {
        $curPage = $_GET['page'];
        $airports = array_slice($airports, ($curPage - 1) * 5, 5);
    } else {
        $airports = array_slice($airports, 0, 5);
    }

    return $airports;
}

/**
 * Returns available pages (5 items per page)
 * @param array $airports
 * @return int
 */
function countPages(array $airports): int
{
    return (int)ceil(count($airports) / 5);
}

/**
 * returns current page No which is stored in _GET array
 * @return int
 */
function getCurrentPage(): int
{
    if (isset($_GET['page'])) {
        return $_GET['page'];
    }

    return 1;
}

/**
 * Filters array by first letter of the name. Returns filtered array
 * @param array $rawArray
 * @return array
 */
function filterAirportsByFirstLetter(array $rawArray): array
{
    $filteredArray = [];
    if (isset($_GET['filter_by_first_letter'])) {
        foreach ($rawArray as $airport) {
            if ($airport['name'][0] == $_GET['filter_by_first_letter']) {
                $filteredArray[] = $airport;
            }
        }

        return $filteredArray;
    }

    return $rawArray;
}

/**
 * Filters array by "state". Returns filtered array
 * @param array $rawArray
 * @return array
 */
function filterAirportsByState(array $rawArray): array
{
    $filteredArray = [];
    if (isset($_GET['state'])) {
        foreach ($rawArray as $airport) {
            if ($airport['state'] == $_GET['state']) {
                $filteredArray[] = $airport;
            }
        }

        return $filteredArray;
    }

    return $rawArray;
}

/**
 * Sorts array. Returns sorted array (if sort is enabled)
 * @param array $rawArray
 * @return array
 */
function sortAirports(array $rawArray): array
{
    if (isset($_GET['sort'])) {
        uasort($rawArray, 'customMultiSort');
    }

    return $rawArray;
}

/**
 * Actually, sorting function for uasort
 */
function customMultiSort($x, $y)
{
    return strcasecmp($x[$_GET['sort']], $y[$_GET['sort']]);
}

function getFilteredAirportsList($airports): array
{
    $filteredArray = [];
    $filteredArray = filterAirportsByFirstLetter($airports);

    return $filteredArray;
}

/**
 * Generating new link. Replacing existing filter/sort or creating a new one.
 * Last parameter (optional) links to a 1st page.
 * @param string $action
 * @param string $newParam
 * @param bool $forceFirstPage
 * @return string
 */
function generateURL(string $action, string $newParam, bool $forceFirstPage = false): string
{
    $newURL = "?";
    foreach ($_GET as $paramName => $paramValue) {
        if ($paramName == 'page' & $forceFirstPage) {
            $paramValue = 1;
        }
        if ($paramName == $action) {
            if ($paramName == $action & $newParam == $paramValue) {
                $newURL .= $paramName . "=" . $paramValue;
            } else {
                $newURL .= $paramName . "=" . $newParam;
            }
        } else {
            $newURL .= $paramName . "=" . $paramValue;
        }

        if (count($_GET) > 0) {
            $newURL .= "&";
        }
    }
    if (!isset($_GET[$action])) {
        $newURL .= $action . "=" . $newParam;
    }
    if ($newURL[strlen($newURL) - 1] == "&") {
        $newURL = substr($newURL, 0, strlen($newURL) - 1);
    }

    return $newURL;
}
