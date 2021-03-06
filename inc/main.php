<?php
class Main extends F3instance {
	function home() {
		$this->set('title','Welcome to AskYourGovt.in');
		$this->set('sub_title','Community around asking public interest questions.');

        $all_public_reactions = array();
        $sql_query = 'select *  from public_reaction order by public_reaction_date desc LIMIT  5 ';
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query);
        
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $doc = array();          
            $doc['public_reaction_id']= $row["public_reaction_id"];    
            $doc['public_reation_type_id']= $row["public_reation_type_id"];
            $doc['public_reaction_text']= $row["public_reaction_text"];
            $doc['public_reaction_title']= $row["public_reaction_title"];
            $doc['public_reaction_note']= Markdown($row["public_reaction_note"]);
            $doc['public_reaction_date']= $row["public_reaction_date"];
            $all_public_reactions[$doc['public_reaction_id']] =$doc;
        }
		$this->set('all_public_reactions', $all_public_reactions);





        $sql_query="select * from questions order by questions.date_asked desc LIMIT 5";
        $ASKYOURGOVT_DB->exec($sql_query);
        $temp_array_all_question =  array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $single_question = array();
            $single_question['question_id']= $row["question_id"];    
            $single_question['question_title']= $row["question_title"];
            $single_question['question_short_title']= $row["question_short_title"];
            $single_question['question_text']=  ($row["question_text"]);    
            $single_question['date_asked']=   $row["date_asked"];
            $single_question['status_id']=   $row["status_id"];
            $temp_array_all_question[$row["question_id"]]   = $single_question;
        }


        $this->set('top_questions',$temp_array_all_question);


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
		$this->set('side_bar','rti-act');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function rtifaq() {
		$this->set('title','RTI FAQ');
		//$this->set('sub_title','Frequently Asked Questions');
		$this->set('side_bar','rti_faq');
		$this->set('sub','sub_rtifaq.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function rtidictionary() {
		$this->set('title','RTI Dictionary');
		$this->set('sub_title','A reference list of words, terms, codes, keys, etc., and their meanings, used by RTI Activist.');
		$this->set('side_bar','rti_dictionary');
		$this->set('sub','sub_rti_dictionary.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}

	function constitution() {
		$this->set('title','The Constitution of India');
		$this->set('sub_title','The Constitution of the Republic of India');
		$this->set('side_bar','constitution');
		$page_no = intval($this->get('PARAMS["page_no"]'));
		if($page_no < 1 || $page_no > 479 ){
			$page_no = 1;
		}
		
		$url="http://content.wdl.org/2672_1_".$page_no.".png";
		$this->set('url', $url);
		$this->set('page_no', $page_no);
		$this->set('sub','sub_constitution.html');
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


	function links() {
		$this->set('title','Links');
		$this->set('sub_title','All the useful links that you need');
		$this->set('sub','sub_links.html');
		$out=$this->render('basic/layout.html');		
		$this->set('sub_out_put',$out);
		$this->set('LANGUAGE','en-US');		
		echo $this->render('basic/main.html');
	}
	
	function faq() {
		$this->set('title','FAQ');
		//$this->set('sub_title','Frequently Asked Questions');
		$this->set('side_bar','faq');
		$this->set('sub','sub_faq.html');
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
        $sql_query = 'select *  from public_reaction LEFT JOIN questions on public_reaction.question_id=questions.question_id order by public_reaction_date desc LIMIT  '.$RECORDS_PER_PAGE;
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