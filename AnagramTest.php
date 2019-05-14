<?php

require "anagram.php";

class AnagramTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider anagramsProvider
     */
    public function testFindAnagrams($word, $expected, $assertEqual)
    {
        $dictionary = file('english_58000_lowercase.txt', FILE_IGNORE_NEW_LINES);
        if ($assertEqual) {
            $this->assertEquals($expected,
                findAnagrams($dictionary, $word)
            );
        } else {
            $this->assertNotEquals($expected,
                findAnagrams($dictionary, $word)
            );
        }
    }

    public function anagramsProvider()
    {
        return [
            ['documenting', [
                'ceding' => 'mount',
                'coding' => 'unmet',
                'coming' => 'tuned',
                'coned' => 'muting',
                'document' => 'gin',
                'ducting' => 'omen',
                'gnome' => 'induct',
                'gnomic' => 'tuned',
            ], true],
            ['docum', [
                'ceding' => 'mount',
                'coding' => 'unmet',
                'coming' => 'tuned',
                'coned' => 'muting',
                'document' => 'gin',
                'ducting' => 'omen',
                'gnome' => 'induct',
                'gnomic' => 'tuned',
            ], false],
        ];
    }
}
