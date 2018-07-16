<?php
class DefaultModel extends Model {
	
	function getAllDestination () {
		$this->sql = "SELECT * FROM {$this->table->tour} order by idx desc; ";
		return $this->fetchAll();
	}

	function getData () {
		$sql = $this->getJoined();
		$this->sql = "
			{$sql}
			WHERE idx = '{$this->param->idx}';
		";
		return $this->fetch();
	}

	function getListCount ($table) {
		$this->sql = "SELECT count(idx) as cnt FROM {$table}";
		return $this->fetch()->cnt;
	}

	function getList ($start, $line) {
		$sql = $this->getJoined();
		$this->sql = "
			{$sql}
			order by idx desc
			limit {$start}, {$line}
		";
		return $this->fetchAll();
	}

}