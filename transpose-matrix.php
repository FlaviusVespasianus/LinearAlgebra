<?php
//take a matrix and returns a transposed one

function transpose($matrix)
{
    if (count($matrix) == 1){
        for ($i = 0; $i < count($matrix[0]); $i++){
            $transposed[$i][] = $matrix[0][$i];
        }
        return $transposed;
    } else {
        $transposed = transpose([$matrix[0]]);
        for ($m = 1; $m < count($matrix); $m++){
            foreach ($matrix[$m] as $position => $element) {
                $transposed[$position][] = $element;
            }
        }
        return $transposed;
    }
}
