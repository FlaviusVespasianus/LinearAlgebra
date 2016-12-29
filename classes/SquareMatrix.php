<?php

/**
 * Created by PhpStorm.
 * User: mauri
 * Date: 22/12/2016
 * Time: 21:33
 */
class SquareMatrix extends Matrix
{

    public $determinant; //int
    protected $square; //bool

    protected $trace;
    protected $kernel;
    protected $scalar;
    //диагональ, единичная, жордано, и тп.



    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->determinant = MatrixOperations::determine($this);
//        $this->trace = MatrixOperations::calculateTrace($this);
    }

//    public function showMatrix(string $output = 'console') {
//
//    }

}