<?php

//square check need
//
class Matrix
{
    protected $rows;
    protected $columns;
    protected $body;
    protected $name;


    /*
     * this method creates a new instance of the Matrix class
     * therefore the magic methods are not allowed
     */
    public static function create(array $body): Matrix
    {
        $isMatrix = true; //could be done better, but for now it's ok
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
            if (count($body) == count($body[0])) {
                return new SquareMatrix($body);

            } elseif (count($body) == 1) {

                return new Vector($body);

            } else {

                return new Matrix($body);
            }


        } else {
            //there has to be throwing an Exception here,
            //
            // has to be redone!

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

    public function getBody()
    {
        return $this->body;
    }
    
    public function getName()
    {
        return $this->name;
    }


    public function __construct(array $body)
    {
        $this->rows = count($body);
        $this->columns = count($body[0]);
        $this->body = $body;
        $this->name = chr(rand(65,90));
    }



    public function showMatrix(string $output = 'c', string $desc = 'a'): void
    {
        $nLine = '';
        switch ($output) {
            case 'c':      //console
                $nLine = "\n";
                break;
            case 'b':      //browser
                $nLine = "<pre>";
                break;
        }
        ////////////////////////////////////////////
        //bad design here
        $type = 'matrix';
        $types = ['SquareMatrix', 'Vector'];
        foreach ($types as $t) {
            if (is_a($this, $t)) {
                $type = $t;
            }
        }
        ////////////////////////////
        
        
        $max = 0;
        foreach ($this->getBody() as $row) {
            foreach ($row as $element) {
                if (strlen($element) > $max) {
                    $max = strlen($element);
                }
            }
        }
        foreach ($this->getBody() as $row) {
            print $nLine;
            foreach ($row as $element) {
                $string = str_pad($element, $max + 1, ' ', STR_PAD_BOTH);
                print "$string";
            }
            print $nLine;
        }
        switch ($desc) {
            case 'n':
                break;
            case 's':
                print $type . ' ' . $this->getName() . ' ' . $this-getRows() . 'x' . $this->getColumns() . $nLine;
                break;
            case 'a':
                print $type . ' ' . $this->getName() . ' ' . $this-getRows() . 'x' . $this->getColumns() . $nLine;
                if ($this instanceof SquareMatrix) {
                    print "its determinant: " . $this->getDeterminant();
                }
        }
        
    }

}
