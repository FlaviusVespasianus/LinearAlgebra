<?php
//takes: any matrix of [ [0] ] format  --array
//returns: its determinant  --integer

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
            $multiplier = ($position & 1) ? 1 : -1;
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
