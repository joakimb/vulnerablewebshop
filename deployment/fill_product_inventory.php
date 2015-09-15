#!/usr/bin/php
<?php

$inventory_file = "./products/inventory.txt";
$inventory = fopen($inventory_file, "r") or die("Unable to open file!");
//echo fread($inventory,filesize($inventory_file));

while (!feof($inventory)){
   $line = fgets($inventory);
   if(!strcmp($line, "PRODUCT")) break;
   $name = fgets($inventory);
   $price= fgets($inventory);
   $description = fgets($inventory);
   $imgPath = fgets($inventory);
}

fclose($inventory);

?> 