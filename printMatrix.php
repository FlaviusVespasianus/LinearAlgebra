<?php

//prints matrix on the screen

function showMatrix($matrix){
    $max = 0;
    foreach ($matrix as $row){
        foreach ($row as $element){
            if (strlen($element) > $max){
                $max = strlen($element);
            }
        }
    }
    foreach ($matrix as $row){
        print "<pre>";
        foreach ($row as $element){
            $string = str_pad($element, $max + 1, ' ', STR_PAD_BOTH);
             print "$string";
        }
        print "</pre>";
    }
}
