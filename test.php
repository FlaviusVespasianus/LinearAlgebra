<?php


spl_autoload_register(function ($class_name) {
    include 'classes/'. $class_name . '.php';
});


$m = new Matrix([[3,5],[1,40]]);
$c = MatrixOperations::transpose($m);

$m->showMatrix();
print_r($m);

$c->showMatrix();
print_r($c);
