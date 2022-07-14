<?php
function addToArrJSON(string $JSON, mixed $value): string
{
  $arr = json_decode($JSON);
  array_push($arr, $value);

  return json_encode($arr);
}
