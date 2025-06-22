<?php 
echo "Welcome to PHP\n";
$name  = "Alice";
echo "Hello," . $name . "!\n";

$pzzas = 3;
$slicesPerPizza = 8;
$totalSlices = $pzzas * $slicesPerPizza;
echo "Total slices: $totalSlices\n";

$isHungry = false;
echo "Hungry";
echo $isHungry ? " - Yes" : " - No";
echo "\n";