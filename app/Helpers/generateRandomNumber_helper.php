<?php

use CodeIgniter\CodeIgniter;

function generateRandomNumber($length = 16)
{
  $min = pow(10, $length - 1);
  $max = pow(10, $length) - 1;
  return random_int($min, $max);
}
