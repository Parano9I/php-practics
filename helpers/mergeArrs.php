<?php
function mergeArrs(array $firstArr, array $secondArr): array
{
    $result = [...$firstArr];
    foreach ($secondArr as $item) {
        $idxItem = array_search($item['id'], array_column($result, 'id'));
        if ($idxItem !== false) {
            $result[$idxItem] = $item;
        } else array_push($result, $item);
    }
    return $result;
}
