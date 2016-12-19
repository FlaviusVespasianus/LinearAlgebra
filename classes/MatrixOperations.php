<?php
/**
 * Created by PhpStorm.
 * User: mauri
 * Date: 17/12/2016
 * Time: 18:07
 */

//Matrix Operations class
class MatrixOperations
{
    public static function determine(Matrix $matrix): ?int
    {
        $rows = $matrix->getRows();
        $determinant = null;
        if (!$matrix->getSquare()) {
            return $determinant;
        } elseif ($rows == 1) {
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
                $minorMatrix = new Matrix($minorBody);
                $summand = $multiplier * $element * MatrixOperations::determine($minorMatrix);
                $determinant += $summand;
            }
        }
        return $determinant;
    }

    public static function transpose(Matrix $matrix): Matrix
    {
        if ($matrix->getRows() == 1){
            for ($i = 0; $i < count($matrix->getBody()[0]); $i++){
                $transposedBody[$i][] = $matrix->getBody()[0][$i];
            }
            $transposedMatrix = new Matrix($transposedBody);
        } else {
            $transposedMatrix = self::transpose(new Matrix([$matrix->getBody()[0]]));
            for ($m = 1; $m < $matrix->getRows(); $m++){
                foreach ($matrix->getBody()[$m] as $position => $element) {
                    $transposedMatrix->body[$position][] = $element;
                }
            }
            $transposedMatrix = new Matrix($transposedMatrix->body);
        }
        return $transposedMatrix;
    }
    
    public static function cofactor(Matrix $matrix): ?Matrix
    {
        if ($matrix->getSquare()) {
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
        } else {
            return null;
        }
    }
    
    
}
