<?php


//Matrix Operations class
class MatrixOperations
{
    //all matrix operations
    //-----------------------------------------------------

    //транспонирование
    public static function transpose(Matrix $matrix): Matrix
    {
        if ($matrix->getRows() == 1){
            for ($i = 0; $i < count($matrix->getBody()[0]); $i++){
                $transposedBody[$i][] = $matrix->getBody()[0][$i];
            }
            $transposedMatrix = Matrix::create($transposedBody); //ought to be
        } else {
            $transposedMatrix = self::transpose(Matrix::create([$matrix->getBody()[0]]));
            for ($m = 1; $m < $matrix->getRows(); $m++){
                foreach ($matrix->getBody()[$m] as $position => $element) {
                    $transposedMatrix->getBody()[$position][] = $element;
                }
            }

            $transposedMatrix = Matrix::create($transposedMatrix->getBody());
        }
        var_dump($transposedMatrix);
        return $transposedMatrix;
    }

    //makes a new matrix, need to fix to fixing the old one FLOAT??
    //умножение матрицы на число
    public static function multiplyByNumber(Matrix $matrix, float $number): Matrix
    {
        $body = $matrix->getBody();
        foreach ($body as & $row) {
            foreach ($row as & $element) {
                $element *= $number;
            }
        }
        return new Matrix($body);
    }
    
    //умножение двух матриц MxK *  KxN = MxN
    public static function multMbyM(Matrix $matrix1, Matrix $matrix2): ?Matrix
    {
        if ($matrix1->getColumns() != $matrix2->getRows()) {
            return null;
        } else {
            $mk = $matrix1->getBody();
            $kn = $matrix2->getBody();
            $mn = [];
            $sum = 0;
            for ($i = 0; $i < $matrix1->getRows(); $i++) {
                for ($j = 0; $j < $matrix2->getColumns(); $j++) {
                    for ($k = 0; $k < $matrix1->getColumns(); $k++) {
                        $sum += $mk[$i][$k] * $kn[$k][$j];
                    }
                    $mn[$i][$j] = $sum;
                    $sum = 0;
                }
            }
            return Matrix::create($mn);
        }
    }


    //sqare matrix operations
    //---------------------------------------------------------------------------------

    //определитель матрицы
    public static function determine(SquareMatrix $matrix)
    {
        $rows = $matrix->getRows();
        $determinant = null;
        if ($rows == 1) {
            $determinant = $matrix->getBody()[0][0];
        } elseif ($rows > 1) {
            foreach ($matrix->getBody()[0] as $position => $element){
                $minorBody = [];
                $multiplier = ($position & 1) ? -1 : +1;
                for ($row = 1; $row < $rows; $row++){
                    $slicedRow = $matrix->getBody()[$row];
                    array_splice($slicedRow, $position, 1);
                    $minorBody[] = $slicedRow;
                }
                $minorMatrix = new SquareMatrix($minorBody);
                $summand = $multiplier * $element * MatrixOperations::determine($minorMatrix);
                $determinant += $summand;
            }
        }
        return $determinant;
    }


    //нахождение
    public static function cofactor(Matrix $matrix): Matrix
    {      
        $coMatrixBody = [];
        foreach ($matrix->getBody() as $rowPosition => $row) {
            foreach ($row as $position => $element) {
                $multiplier = ($position & 1) ? -1 : +1;
                $mPart = $matrix->getBody();
                array_splice($mPart, $rowPosition, 1);
                foreach ($mPart as & $slicedRow) {
                    array_splice($slicedRow, $position, 1);
                }
                $minorMatrix = new Matrix($mPart);
                $coMatrixBody[$rowPosition][$position] = $multiplier * $minorMatrix->getDeterminant();
            }
        }
        $coMatrixBody = new Matrix($coMatrixBody);
        return $coMatrixBody;
    }
    
    public static function adjugate(Matrix $matrix): ?Matrix
    {
        if ($matrix->getSquare()) {          
            $adjointMatrix = self::transpose(self::cofactor($matrix));
            return $adjointMatrix;
        } else {
            return null;
        }                       
    }
    

    
    public static function invert(Matrix $matrix): ?Matrix
    {
        if ($matrix->getSquare()) {
            $inverseMatrix = self::multiplyByNumber(self::adjugate($matrix), 1/($matrix->getDeterminant()));
            return $inverseMatrix;
        } else {
            return null;
        } 
    }

    /*
   public static function calculateTrace(SquareMatrix $matrix): float
   {
       $trace = 0;
       while ($i < $matrix->getColumns()) {
           foreach ($matrix->getBody() as $row) {        
                    $trace += $row[$i];
                    $i++;
           }
       }
       return $trace;    
       
        
   }
    */
   
    //проверить подобие двух матриц
//     public function 
    
    
    
    //check if any amount of vectors form a basis in their dimention
    //takes any number of vectors
    //returns bool
    //-----------------------------------------------------------------needs hevy testing
    /*
    public static function areBasis(...$vectors): boolean
    {
        if ((count($vectors) != count($vectors[0]) or (empty($vectors[0]) {
            return false;
        }
        
        $m = [];
        
        foreach ($vectors as $vector) {
            if (!(($vector instanceof Vector) and (count($vector) == count($vectors[0])))) {
                return false;
            }
            $m[] = $vector->getBody();
        }
        $matrix = Matrix::create($m);
        return ($matrix->getDeterminant() != 0) true : false;
                
    }
    */
    
            
}
