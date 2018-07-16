<?php
class CourseModel extends DefaultModel {
	
	function getJoined () {
		$table = $this->table;
		return "
			SELECT * FROM (
				SELECT	c.*,
						f.origin, f.saved, f.uri,
						m.name as writer_name
				FROM	{$table->course} c LEFT
				JOIN 	{$table->file} f on f.idx = c.idx and f.tbl = '{$table->course}'
				JOIN 	{$table->member} m on m.idx = c.writer
			) tt
		";
	}

	function action () {
		extract($_POST);
		$sql = $add_sql = $column = $msg = $url = '';
		$param = $this->param;
		$cancel = 'action/idx/pw_re/beforeFile';
		switch ($action) {
			case 'insert' :
				$add_sql .= ", date = now()";
				$msg = "추가되었습니다.";
				$url = "{$param->get_page}/list";
				$callback = function ($model) {
					$tbl = $model->table->board;
					$idx = $model->lastId;
					fileUpload($tbl, $idx, $_FILES['file'], $model);
				};
			break;
			case 'update' :
				$add_sql .= " where idx = '{$param->idx}'";
				$msg = "수정 되었습니다.";
				$url = "{$param->get_page}/list";
				$callback = function ($model) {
					$tbl = $model->table->board;
					$idx = $model->param->idx;
					fileUpload($tbl, $idx, $_FILES['file'], $model, true);
				};
			break;
		}

		$column = $this->getColumn($_POST, $cancel);
		if ($this->query_action($action, $this->table->board, $column.$add_sql)){
			if (isset($callback)) $callback($this);
			alert($msg);
			move($url);
		}
	}

}