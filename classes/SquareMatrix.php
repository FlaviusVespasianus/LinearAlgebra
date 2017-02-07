<?php

class SquareMatrix extends Matrix
{

    protected $determinant; //int
    protected $type = ['diagonal' => 0, 'scalar' => 0, 'ed' => 0]; //bool

    protected $trace;
    protected $kernel;
    
    //диагональ, единичная, жордано, и тп.
    public function getDeterminant()
    {
        return $this->determinant;
    }

    public function getType()
    {
        return $this->type;
    }


    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->determinant = MatrixOperations::determine($this);
        //$this->trace = MatrixOperations::calculateTrace($this);
    }

    //just for the visual representation of the matrix
    public function showMatrix(string $output = 'console', string $settings = 'all'): void
    {
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
