<?php

namespace LinearAlgebra;

class Matrix
{
    protected $rows;
    protected $columns;
    public $body = [];

    public function __construct(int $rows = 0, int $columns = 0)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->insertValues();
    }

    public function insertValues(array $values = [ 0 ])
    {
        $next = 0;
        for ($r = 0; $r < $this->rows; $r++){
            for ($c = 0; $c < $this->columns; $c++){
                $this->body[$r][$c] = $values[$next] ?? 0;
                $next++;
            }
        }
    }

    public function showMatrix()
    {
        $max = 0;
        foreach ($this->body as $row){
            foreach ($row as $element){
                if (strlen($element) > $max){
                    $max = strlen($element);
                }
    }
    }
    foreach ($this->body as $row){
        print "<pre>";
        foreach ($row as $element){
            $string = str_pad($element, $max + 1, ' ', STR_PAD_BOTH);
            print "$string";
        }
        print "</pre>";
    }
}

}

$m = new Matrix(3,4);
var_dump($m);
$m->showMatrix();