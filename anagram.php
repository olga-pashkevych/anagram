<?php

//multiplies each corresponding prime number for each letter in the word
function multiplication(string $word): string
{
    //a prime number is a natural number greater than 1 that cannot be formed by multiplying two smaller natural numbers.
    $prime = [
        'a'=>2,
        'b'=>3,
        'c'=>5,
        'd'=>7,
        'e'=>11,
        'f'=>13,
        'g'=>17,
        'h'=>19,
        'i'=>23,
        'j'=>29,
        'k'=>31,
        'l'=>37,
        'm'=>41,
        'n'=>43,
        'o'=>47,
        'p'=>53,
        'q'=>59,
        'r'=>61,
        's'=>67,
        't'=>71,
        'u'=>73,
        'v'=>79,
        'w'=>83,
        'x'=>89,
        'y'=>97,
        'z'=>101
    ];

    $total = 1;

    //convert a string to an array of letters
    $letters = str_split($word);

    //multiplies each prime number
    foreach ($letters as $letter) {
        if (isset($prime[$letter])) {
            //multiply two arbitrary precision numbers
            //used BC Math because need to work with large numbers
            $total = bcmul($prime[$letter], $total);
        }
    }

    return $total;
}

//main function which find anagrams
function findAnagrams(array $dictionary, string $searchWord): array
{
    $searchWordTotal = multiplication($searchWord);

    //find all parts of anagram from our dictionary
    $anagrams = [];
    foreach ($dictionary as $k => $word) {
        $dictionaryWordTotal = multiplication($word);

        if (bcmod($searchWordTotal, $dictionaryWordTotal) == 0) {
            $anagrams[$word] = $dictionaryWordTotal;
        }
    }

    //find only those parts of the anagram that will be made up of the search word
    $matches = [];
    if ($anagrams) {
        foreach ($anagrams as $word => $total) {

            $secondWordTotal = bcdiv($searchWordTotal, $total);

            $secondWord = array_search($secondWordTotal, $anagrams);

            //delete duplicates
            if (!empty($secondWord) && empty(array_search($word, $matches))) {
                $matches[$word] = $secondWord;
            }
        }
    }

    return $matches;
}

$searchWord = "documenting";
$dictionary = file('english_58000_lowercase.txt', FILE_IGNORE_NEW_LINES);
//print_r(findAnagrams($dictionary, $searchWord));
