<?php
  $numbers = [
    'num1' => 14,
    'num2' => 27,
    'num3' => 24,
  ];

  usort($numbers, function($a, $b){
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
  });

  var_dump($numbers);
?>
