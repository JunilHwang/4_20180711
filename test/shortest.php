<?php
	include_once("config.php");	
	$model = new Model();
	Shortest::init();

	$arr = [1,2,3,4];
	$res = [];
	foreach($arr as $idx=>$val) {
		$list = $arr;
		unset($list[$idx]);
		$list = implode(",",$arr);
		$model->sql = "
			SELECT 	*
			FROM 	{$model->table->cost}
			where 	type = 1
			and 	source = {$val}
			and 	destination in ($list)
			order by destination asc;
		";
		$res[] = $model->fetchAll();
	}

	Shortest::allShortPath($res);