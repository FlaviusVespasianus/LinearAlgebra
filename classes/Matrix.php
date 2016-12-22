<?php

//square check need
//
class Matrix
{
    protected $rows;
    protected $columns;
    protected $body;



    public static function create(array $body)
    {
        $isMatrix = true; //could be better
        foreach ($body as $row) {
            if (is_array($row)) {
                if (count($body[0]) != count($row)) {
                    $isMatrix = false;
                }
            } else {
                $isMatrix = false;
            }



        }

        if ($isMatrix) {

            if (count($body) == count($body)[0]) {

                return new SquareMatrix($body);

            } elseif (count($body) == 1) {

                return new Vector($body);

            } else {

                return new Matrix($body);
            }


        } else {

            return null;

        }

    }

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


    public function __construct(array $body)
    {
        $this->rows = count($body);
        $this->columns = count($body[0]);
        $this->body = $body;

    }



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
