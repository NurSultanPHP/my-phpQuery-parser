<?php

function str_to_array($description, string $start, string $end, array $separators)
{
    preg_match("~$start(.*?)$end~", $description, $output);
    trim($output[1]);
    $separator = implode("|", $separators);
    $parameters = preg_split("*[$separator]*", $output[1]);

    return array_diff($parameters, array(''));
}