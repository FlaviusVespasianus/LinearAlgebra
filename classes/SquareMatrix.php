<?php

/**
 * Created by PhpStorm.
 * User: mauri
 * Date: 22/12/2016
 * Time: 21:33
 */
class SquareMatrix extends Matrix
{

    protected $determinant; //int
    protected $type = ['diagonal' => 0, 'scalar' => 0, 'ed' => 0]; //bool

    protected $trace;
    protected $kernel;
    
    //диагональ, единичная, жордано, и тп.



    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->determinant = MatrixOperations::determine($this);
        $this->trace = MatrixOperations::calculateTrace($this);
    }

    public function showMatrix(string $output = 'console', string $settings = 'all') {
        $print = '';
        switch ($output){
            case('console'):
                $print = "\n";
                break;
            case('browser'):
                $print = "<pre>";
                break;
        }
        $max = 0;
        foreach ($this->body as $row){
            foreach ($row as $element){
                if (strlen($element) > $max){
                    $max = strlen($element);
                }
            }
        }
        foreach ($this->body as $row){
            print $print;
            foreach ($row as $element){
                $string = str_pad($element, $max + 1, ' ', STR_PAD_BOTH);
                print "$string";
            }
            print $print;
        }
    }
    
        
    }

}
