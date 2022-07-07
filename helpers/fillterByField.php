<?php
function fillterByField(array $array, string $field, callable $callback){
    $result = [];

    foreach ($array as $value) {
        if($callback($value[$field])){
            array_push($result, $value);
        } else continue;
    };
    return $result;
};