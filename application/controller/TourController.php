<?php
class TourController extends Controller {

	function view () {
		$this->setAjax();
		$this->data = $this->model->getData();
		$this->tags = explode(" ", $this->data->tag);
	}

	function list () {
		$param = $this->param;
		$model = $this->model;

		if (isset($_POST['key'])) {
			$model->keywordRegister($_POST['key']);
			move("{$param->get_page}/list/{$param->page_num}/".urlencode($_POST['key']));
		}
		
		if (isset($param->search_key)) {
			$this->relatedList = RelatedSearch::getRelatedList($param->search_key);
		}

		$this->total = $total = $model->getListCount($this->model->table->tour);
		$line = 8;
		$this->list = $model->getList(($param->page_num - 1) * $line, $line);
		$this->site_title = "{$param->site_title} &gt; 관광지 정보";
		$url = "{$param->get_page}/list/{{num}}";
		$this->paginate = pagination($url, $param->page_num, $line, $total);
	}

	function write () {
		$this->setAjax();
	}
}