<?php

//square check need
//
class Matrix
{
    protected $rows;
    protected $columns;
    protected $determinant; //int
    protected $square; //bool
    
    protected $trace;
    protected $kernel;
    protected $scalar;
    //диагональ, единичная, жордано, и тп.

    public $body;

    /**
     * @param array $body
     */
    public function setBody(array $body)
    {
        $this->body = $body;
    }  //array

    public function getRows()
    {
        return $this->rows;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getDeterminant()
    {
        return $this->determinant;
    }

    public function getSquare()
    {
        return $this->square;
    }

    public function getBody()
    {
        return $this->body;
    }

//    public function __construct(int $rows = 1, int $columns = 1)
//    {
//        $this->rows = $rows;
//        $this->columns = $columns;
//        $this->square = ($rows == $columns);
//        $this->insertValues();
//        $this->determinant = MatrixOperations::determine($this);
//    }

    public function __construct(array $body)
    {
        if (count($body)) {
            $body = (is_array($body[0])) ? $body : [$body];
            $this->rows = count($body);
            $this->columns = count($body[0]);
            $this->square = ($this->rows ==  $this->columns);
            $this->body = $body;
            $this->determinant = MatrixOperations::determine($this);
        }

    }

//    public function insertValues(array $values = [ 0 ])
//    {
//        $next = 0;
//        for ($r = 0; $r < $this->rows; $r++){
//            for ($c = 0; $c < $this->columns; $c++){
//                $this->body[$r][$c] = $values[$next] ?? 0;
//                $next++;
//            }
//        }
//    }

    public function showMatrix(string $output = 'console')
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
