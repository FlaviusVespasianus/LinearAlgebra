//take a matrix and returns a transposed one

$a = [ [1, 2],
       [3, 4] ];
       
function transpose($matrix){
    //only for square ones for now
    if (count($matrix) == 1){
        for ($i = 0; $i < count($matrix[0]); $i++){
            $transposed[$i][] = $matrix[0][$i];
        }
        return $transposed;
    } elseif (count($matrix) == 2) {
        $row1 = transpose([$matrix[0]]);
        foreach ($matrix[1] as $position => $element){
            $row1[$position][] = $element;
        }
        $transposed = $row1;
        return $transposed;
    } else {
        $row1 = transpose([$matrix[0]]);
        for ($m = 1; $m < count($matrix); $m++){
            foreach ($matrix[$m] as $position => $element) {
                $row1[$position][] = $element;
            }
        }
        $transposed = $row1;
        return $transposed;
    }

}
