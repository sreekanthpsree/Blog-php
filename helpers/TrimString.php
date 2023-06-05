<?php


class Helpers
{
    function trimString($content, $number)
    {
        $last_dot = strrpos($content, ".");
        return $trimmed_string = substr($content, 0, $number);
    }
}
?>