<?php
class MemberModel extends Model {

	function action () {
		extract($_POST);
		$sql = $add_sql = $column = $msg = $url = '';
		$cancel = 'action/idx/pw_re/';

		switch ($action) {
			case 'insert' :
				$required = strlen($id)+strlen($pw)+strlen($pw_re)+strlen($name)+strlen($email);
				access($required > 0, "누락된 항목이 있습니다");

				access($pw == $pw_re, "비밀번호와 비밀번호 확인이 일치하지 않습니다.");

				$this->sql = "SELECT * FROM {$this->table->member} where binary(id) = ? ";
				$this->execArr = [$id];
				access($this->rowCount() == 0, "이미 중복된 아이디가 있습니다");

				$_POST['pw'] = md5($pw.$id);

				$msg = "회원가입이 완료되었습니다.";
				$url = HOME_URL;
			break;
			case 'login' :
				$required = strlen($id)+strlen($pw);
				access($required > 0, "누락된 항목이 있습니다.");

				$pw = md5($pw.$id);
				$this->sql = "SELECT * FROM {$this->table->member} where id = ? and pw = ?";
				$this->execArr = [$id, $pw];
				access($this->rowCount() == 1, "아이디 또는 비밀번호가 일치하지 않습니다.");
				$_SESSION['member'] = $this->fetch();
				alert('로그인 되었습니다.');
				move(HOME_URL);
			break;
		}

		$column = $this->getColumn($_POST, $cancel);
		if ($this->query_action($action, $this->table->member, $column)){
			alert($msg);
			move($url);
		}
	}	
}