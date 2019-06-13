<?php
namespace App\Helpers;

class Text
{
    public static function excerpt(string $content, int $limit = 100):string
    {

        //$text = strip_tags($content);
        $text = preg_replace("(<[^<]*>)", '', $content);
        if (mb_strlen($content) <= $limit) {
            return $text;
        }
        /*
        $lastSpace = mb_strpos($text, ' ', $limit -1);
        if (empty($lastSpace)) {
            return mb_substr($text, 0, $limit) . "...";
        }
        */
        $lastSpace = mb_strpos($text, ' ', $limit -1)?: $limit;
        return mb_substr($text, 0, $lastSpace) ."...";
        //return substr($text, 0, (strpos($text, ' ', $limit -1)?: $limit)) ."...";
    }
}
