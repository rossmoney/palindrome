<?php declare(strict_types=1);

namespace App;

/**
 * Pangrams, anagrams and palindromes
 * 
 * Implement each of the functions of the Checker class. 
 * Aim to spend about 10 minutes on each function. 
 */
class Checker
{
    /**
     * A palindrome is a word, phrase, number, or other sequence of characters 
     * which reads the same backward or forward.
     *
     * @param string $word
     * @return bool
     */
    public function isPalindrome(string $word) : bool
    {
        //Check the word with the word reversed
        return $word == strrev($word);
    }
    
    /**
     * An anagram is the result of rearranging the letters of a word or phrase 
     * to produce a new word or phrase, using all the original letters 
     * exactly once.
     * 
     * @param string $word
     * @param string $comparison
     * @return bool
     */
    public function isAnagram(string $word, string $comparison) : bool
    {
        //Make both strings lowercase for comparison, remove any spaces and convert to array of characters
        $word = str_split(preg_replace("/\s+/", "", strtolower($word)));
        //Sort array into alphabetical order
        sort($word); 

        $comparison = str_split(preg_replace("/\s+/", "", strtolower($comparison)));
        sort($comparison); 

        //Turn both arrays back into strings and compare the strings to make sure they are equal (both words and phrases use the same characters)
        return implode("", $word) == implode("", $comparison);
    }

    /**
     * A Pangram for a given alphabet is a sentence using every letter of the 
     * alphabet at least once. 
     * 
     * @param string $phrase
     * @return bool
     */    
    public function isPangram(string $phrase) : bool
    {
        //Define array with all available letters, str_split converts to array
        $alphabet = str_split('abcdefghijklmnopqrstuvwxyz');

        //Initialize counter variables
        $uniqueLetters = 0;
        $seenLetters = [];

        foreach(str_split(strtolower($phrase)) as $letter) //Convert phrase to lower case and then split into characters
        {
            if (in_array($letter, $alphabet) && !in_array($letter, $seenLetters)) //If letter is in the alphabet and hasn't been seen already
            {
                $uniqueLetters++; //Increment count of letters that have been seen
                $seenLetters[] = $letter; //Add to list of letters seen already
            }
        }

        return ($uniqueLetters == 26); //Letters seen must equal exactly 26 (all letters of alphabet)
    }
}