<?php
class TourModel extends DefaultModel {

	function getJoined () {
		return "
			SELECT * FROM (
				SELECT	t.*,
						f.origin, f.saved, f.uri
				FROM	{$this->table->tour} t LEFT
				JOIN 	{$this->table->file} f on f.idx = t.idx and f.tbl = '{$this->table->tour}'
			) t
		";
	}

	function tagInsert ($idx) {
		$tags = explode(" ", $_POST['tag']);
		$sql = "";
		foreach ($tags as $tag) {
			$sql .= "INSERT INTO {$this->table->tag} SET destination = '{$idx}', name = '{$tag}'; \n";
		}
		$this->sql = $sql;
		$this->query();
	}

	function action () {
		extract($_POST);
		$sql = $add_sql = $column = $msg = $url = '';
		$cancel = 'action/idx/pw_re/';
		switch ($action) {
			case 'insert' :
				$msg = "추가되었습니다.";
				$url = "{$this->param->get_page}/list";
				$callback = function ($model) {
					$tbl = $model->table->tour;
					$idx = $model->lastId;
					fileUpload($tbl, $idx, $_FILES['file'], $model);
					$model->tagInsert($idx);
				};
			break;
		}

		$column = $this->getColumn($_POST, $cancel);
		if ($this->query_action($action, $this->table->tour, $column)){
			if (isset($callback)) $callback($this);
			alert($msg);
			move($url);
		}
	}

}