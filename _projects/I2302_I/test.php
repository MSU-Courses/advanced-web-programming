<?php

function increment(int &$num): void {
    $num++;
}

$value = 5;
increment($value);
echo $value; // 6
