<?php
session_start();
include 'files_lp/functions/listHelper.php';
$session_list = unserialize($_SESSION['FI7S']);
//dump($session_list);
$list = quick_sort_list($session_list);
$sorttest = quick_sort_list($session_list);
// $sorted = quicksort1($list);

// function quicksort1($list)
// {
// 	$left = $right = array();
// 	if(count($list) < 2)
// 	{
// 		return $list;
// 	}
// 	$pivot_key = key($list);
// 	$pivot = array_shift($list);
// 	foreach($list as $val)
// 	{
// 		if($val->getLastName() <= $pivot->getLastName())
// 		{
// 			$left[] = $val;
// 		}
// 		else 
// 		{
// 			$right[] = $val;
// 		}
// 	}
// 	return array_merge(quicksort1($left),array($pivot_key=>$pivot),quicksort1($right));
// }

function partition(&$array, $left, $right) {
	$pivotIndex = floor($left + ($right - $left) / 2);
	$pivotValue = $array[$pivotIndex];
	$i=$left;
	$j=$right;
	while ($i <= $j) {
			while (($array[$i]->getLastName() < $pivotValue->getLastName()) ) {
					$i++;
			}
			while (($array[$j]->getLastName() > $pivotValue->getLastName())) {
					$j--;
			}
			if ($i <= $j ) {
					$temp = $array[$i];
					$array[$i] = $array[$j];
					$array[$j] = $temp;
					$i++;
					$j--;
			}
	}
	return $i;
}

function quicksort(&$array, $left, $right) {
	if($left < $right) {
			$pivotIndex = partition($array, $left, $right);
			quicksort($array,$left,$pivotIndex -1 );
			quicksort($array,$pivotIndex, $right);
	}
}
quicksort($sorttest, 0, count($list)-1);
dump($list);
echo "<br>";
echo "<br>";
dump($sorttest);