<?php
//takes any matrix in a format: [ [0] ] 
//and returns its determinant (a number)

function determine($matrix){
    $size = count($matrix);
    if ($size != count($matrix[0])) {
        return null;
    } elseif ($size == 1) {
        $determinant = $matrix[0][0];
        return $determinant;
    } elseif ($size > 1){
        $determinant = 0;
        foreach ($matrix[0] as $position => $element){
            $minorMatrix = [];
            $multiplier = 1;
            if ($position & 1){
                $multiplier *= -1;
            }
            for ($row = 1; $row < $size; $row++){
                $slicedRow = $matrix[$row];
                array_splice($slicedRow, $position, 1);
                $minorMatrix[] = $slicedRow;
            }
            $summand = $multiplier * $element * determine($minorMatrix);
            $determinant += $summand;
        }
        return $determinant;
    }
}
