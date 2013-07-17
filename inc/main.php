<?php
class Main extends F3instance {
	function home() {
		$this->set('title','Welcome to AskYourGovt.in');
		$this->set('sub_title','Repository of Public Interest RTIs');
		$this->set('sub','sub_home.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}
	function about() {
		$this->set('title','About');
		$this->set('sub_title','Know All About AskYourGovt.in');
		$this->set('sub','sub_about.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}
	function contact() {
		$this->set('title','Contact');
		$this->set('sub_title','How to contact AskYourGovt.in');
		$this->set('sub','sub_contact.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function license() {
		$this->set('title','License');
		$this->set('sub_title','Data and Code are Free');
		$this->set('sub','sub_license.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function rtiact() {
		$this->set('title','RTI Act');
		$this->set('sub_title','The Right To Information Act, 2005');
		$this->set('sub','sub_rtiact.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function rtifaq() {
		$this->set('title','RTI FAQ');
		//$this->set('sub_title','Frequently Asked Questions');
		$this->set('side_bar','faq');
		$this->set('sub','sub_rtifaq.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function rtijargon() {
		$this->set('title','RTI Jargon File');
		//$this->set('sub_title','Frequently Asked Questions');
		$this->set('sub','sub_rti_jargon.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}



	function credits() {
		$this->set('title','Credits');
		$this->set('sub_title','Thanks for making AskYourGovt.IN possible');
		$this->set('sub','sub_credits.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}



	function news() {
		$page_number = 1;
		if(array_key_exists('page_number',$_GET)){
        	$page_number = $_GET['page_number'];
    	}
        if($page_number){
            $page_number = intval($page_number);
            if(is_null($page_number)){
                $page_number = 1;
            }            
        }else{
        	$page_number = 1;
        }
        if($page_number < 1){
        	$page_number = 1;
        }
        
        $all_public_reactions = array();
    	//GET RESPONSES
    	$total_number = 0;
    	$RECORDS_PER_PAGE=5;  
        $sql_query = 'select *  from public_reaction,questions where public_reaction.question_id=questions.question_id order by public_reaction_date desc LIMIT '.$RECORDS_PER_PAGE;
        $OFFSET = ($RECORDS_PER_PAGE*($page_number-1));
        $sql_query=$sql_query." OFFSET ".$OFFSET;

        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query);
        
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $doc = array();
            $total_number = $total_number+1;
            $doc['public_reaction_id']= $row["public_reaction_id"];    
            $doc['public_reation_type_id']= $row["public_reation_type_id"];
            $doc['public_reaction_text']= $row["public_reaction_text"];
            $doc['public_reaction_title']= $row["public_reaction_title"];
            $doc['public_reaction_note']= Markdown($row["public_reaction_note"]);
            $doc['public_reaction_date']= $row["public_reaction_date"];

            $doc['question_id']= $row["question_id"];    
            $doc['question_title']= $row["question_title"];
            $doc['question_short_title']= $row["question_short_title"];
            $doc['question_text']= Markdown($row["question_text"]);    
            $doc['user_name']= $row["user_name"];
            $all_public_reactions[$doc['public_reaction_id']] =$doc;
        }


		$this->set('title','News Stream');
		$this->set('sub_title','Stream of public reactions');
		$this->set('all_public_reactions', $all_public_reactions);
        $this->set('page_number',$page_number);
        $query_string['page_number']= ($page_number+1);
        $older = str_replace('%5B0%5D','',http_build_query($query_string));
        $this->set('older',$older);
        
        $this->set('page_number',$page_number);
        $query_string['page_number']= ($page_number-1);
        $newer = str_replace('%5B0%5D','',http_build_query($query_string));
        $this->set('newer',$newer);

        $this->set('total_number',$total_number);
        $this->set('count_per_page',$RECORDS_PER_PAGE);

		$this->set('sub','sub_news.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}




	
}
?>