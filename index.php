<?php
include_once('App/Cart.php');


$testCart1 = new Cart();
$testCart1->addProduct('9780201835953', 10);
$testCart1->addProduct('9325336028278', 1);
$testCart1->total();

echo "<p></p>";

$testCart2 = new Cart();
$testCart2->addProduct('9781430219484', 3);
$testCart2->addProduct('9780132071482', 1);
$testCart2->total();

echo "<p></p>";

$testCart3 = new Cart();
$testCart3->addProduct('9325336130810', 1);
$testCart3->addProduct('9325336028278', 1);
$testCart3->addProduct('9780201835953', 1);
$testCart3->total();
