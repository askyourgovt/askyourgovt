<?php
class Admin extends F3instance {
	function addNews() {

		$this->set('title','Welcome to AskYourGovt.in');
		$this->set('sub_title','Community around asking public interest questions.');



		$this->set('sub','sub_home.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	
}
?>