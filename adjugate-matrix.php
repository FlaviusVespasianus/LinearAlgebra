<?php
// this programme computes an adjugate matrix for any matrix given
//cofactor...

//needs to be remade
function adjugate($matrix)
{
    $size = count($matrix);

    if ($size != count($matrix[0])){
        return null;
    } elseif ($size == 1){
        $adjoint = $matrix;
        return $adjoint;
//    } elseif ($size == 2){
//        list($a, $b) = $matrix[0];
//        list($c, $d) = $matrix[1];
//        $adjoint = [ [$d, -$b], [-$c, $a] ];
//        return $adjoint;
    } elseif ($size > 1){
//        foreach ($matrix as $index => $row){
//            foreach ($row as $element){
//
//            }
//        }
        computeCofactor($matrix);
    }
    $adjoint = transpose($matrix);
    return $matrix;
}
      
//needs to be remade... cofactor isn't working
function computeCofactor($matrix)
{
    $size = count($matrix);
    if ($size != count($matrix[0])) {
        return null;
    } elseif ($size == 1) {
        $cofactor = $matrix[0][0];
        return $cofactor;
    } elseif ($size > 1) {
        $cofactor = 0;
        foreach ($matrix[0] as $position => $element) {
            $minorMatrix = [];
            $multiplier = 1;
            if ($position & 1) {
                $multiplier *= -1;
            }
            for ($row = 1; $row < $size; $row++) {
                $slicedRow = $matrix[$row];
                array_splice($slicedRow, $position, 1);
                $minorMatrix[] = $slicedRow;
            }
            $cofactor[] = $multiplier * computeCofactor($minorMatrix);
        }
        $cofactor = $matrix;
        return $matrix;

    }
}

