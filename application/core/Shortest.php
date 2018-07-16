<?php
class Shortest {

	static public $path = [];

	static function init () {

	}

	// 분기와 한정 : 전체 경로 탐색
	static function shortPathTree ($start, $arr, $step, $len, $p) {
		unset($arr[$start]);
		if ($step === $len) {
			self::$path[] = $p;
			return;
		}
		foreach ($arr as $key=>$val) {
			$p[] = $key;
			self::shortPathTree($key, $arr, $step+1, $p);
		}
	}

	// 최단 경로 구하기
	static function allShortPath ($arr) {
		$list = [];
		$len  = count($arr);
		$min  = [-1, 10000];
		for ($i = 0; $i < $len; $i++)
			self::shortPathTree($i, $arr, 1, $len, [$i]);

		$list = self::$path;
		print_pre($list);
		for ($i = 0, $pathLen = count($list); $i < $pathLen; $i++) {
			$costSum = 0;
			$costList = [];
			for ($j = 0; $j < $len - 1; $j++) {
				//$cost = $arr[$list[$i][$j]][$list[$i][$j+1]];
				//$costSum += $cost;
				//$costList[] = $cost;
			}
			//if($min[1] > $costSum) $min = [$i, $costSum, $costList];
		}
		print_pre($min);
		return [$list[$min[0]], $min[1], $min[2]];
	}
}