<?php
/*
    for debugging use only
*/

function dd($arg) //dump and die for debugging
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
    die();
}

function d($arg) // dump for debugging
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
}