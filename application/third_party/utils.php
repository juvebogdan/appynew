<?php


function strposOffset($search, $string, $offset)
{
    $arr = explode($search, $string);
    /*** check the search is not out of bounds ***/
    switch( $offset )
    {
        case $offset == 0:
        return false;
        break;
    
        case $offset > max(array_keys($arr)):
        return false;
        break;

        default:

        return strlen(implode($search, array_slice($arr, 0, $offset)));
    }
}



?>