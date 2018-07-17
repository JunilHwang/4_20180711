<?php
class TourModel extends DefaultModel {

	function getJoined () {
		$uri = UP_URL."/";
		return "
			SELECT * FROM (
				SELECT	t.*,
						f.origin, f.saved,
						concat('{$uri}', f.saved) as uri
				FROM	{$this->table->tour} t LEFT
				JOIN 	{$this->table->file} f on f.idx = t.idx and f.tbl = '{$this->table->tour}'
			) t
		";
	}

	function appendSearch () {
		$key = $this->param->search_key;
		$cond = strpos(strtolower($this->sql), "where") !== false ? ' and ' : ' where ';
		$this->sql .= "{$cond} (subject like '%{$key}%' or content like '%{$key}%')";
	}

	function appendTag () {
		$this->sql .= " where (idx in (SELECT destination FROM {$this->table->tag} where name='{$this->param->tag}'))";
	}

	function getTagList () {
		$this->sql = "
			SELECT 	count(*) as cnt,
					name
			FROM 	{$this->table->tag}
			group by name
			order by cnt desc, name asc
		";
		return $this->fetchAll();
	}

	function keywordRegister ($key) {
		$tbl = $this->table;
		$member = $this->param->member;

		if($key == "") return;

		if (isset($_SESSION['key_list'])) {
			$_SESSION['key_list'][] = $key;
			$sql = "
				UPDATE {$tbl->searched} SET
				key_list = ?
				WHERE member = ?
				and   cnt 	 = ?
			";
		} else {
			$_SESSION['key_list'] = [$key];
			$sql = "INSERT INTO {$tbl->searched} SET key_list = ?, member = ?, cnt = ?";
		}

		$key_list = json_encode($_SESSION['key_list']);

		$this->execArr = [$key_list, $member->idx, $member->cnt];
		$this->sql = $sql;
		$this->query();
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