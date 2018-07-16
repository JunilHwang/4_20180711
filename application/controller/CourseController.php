<?php
class CourseController extends Controller {

	function view () {
		$this->setAjax();
	}

	function list () {
		$this->site_title = "{$this->param->site_title} &gt; 추천 코스 여행";
		$param = $this->param;
		$model = $this->model;
		$this->total = $total = $model->getListCount($this->model->table->course);
		$line = 10;
		$this->list = $model->getList(($param->page_num - 1) * $line, $line);
		$url = "{$param->get_page}/list/{{num}}";
		$this->paginate = pagination($url, $param->page_num, $line, $total);
	}

	function write () {
		$this->setAjax();
		$this->destination = $this->model->getAllDestination();
	}

	function update () {
		$this->setAjax();
	}
}