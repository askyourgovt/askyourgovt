<?php

class Question extends F3instance {
    function ask() {
        $this->set('title', 'Ask Questions');
        $this->set('sub','sub_ask.html');
        $out=$this->render('basic/layout.html');
        $this->set('sub_out_put',$out);
        $this->set('LANGUAGE','en-US');     
        echo $this->render('basic/main.html');   
    }
    function questions() {
        $query = array();
        $query_string = "";
        if(array_key_exists('QUERY_STRING',$_SERVER)){
            $query  = explode('&', $_SERVER['QUERY_STRING']);                        
        }
        $params = array();
        $status[0] = 1;
        $page_number = 1;
        $sql_query = 'select * from questions , user, status, question_to_department qtd where qtd.question_id == questions.question_id and  questions.publish_status = 1 ';
        $sql_query = $sql_query . ' and questions.user_name = user.user_name';
        #$sql_query = $sql_query . ' and questions.department_id = departments.department_id';
        $sql_query = $sql_query . ' and questions.status_id = status.status_id';
        $sql_query_params = array();
        $array_all_question = array();


        foreach( $query as $param )
        {
            if($param){
                list($name, $value) = explode('=', $param);
                $params[urldecode($name)][] = urldecode($value);
            }
        }
        $query_string = $params;
        //print_r($query_string);
        if(array_key_exists('page_number',$params)){
            $page_number = intval($params["page_number"][0]);
            if(is_null($page_number)){
                $page_number = 1;
            }            
        }


       if(array_key_exists('status',$params)){
                $status_int = array();
                $status = $params["status"];

                if(is_null($status)){
                    //nothing
                }else{               

                    $sql_query = $sql_query." and questions.status_id in (";

                    foreach ($status as $ind){
                            $sql_query = $sql_query.$ind.',';
                    }
                    if(substr($sql_query, -1) == ','){
                        $sql_query = substr($sql_query, 0, -1); 
                    }
                    $sql_query = $sql_query." )";
                }
            }

       if(array_key_exists('dept',$params)){
            $depts = $params["dept"];

            if(is_null($depts)){
               //
            }else{              
                $sql_query = $sql_query." and qtd.department_id in (";
                foreach ($depts as $ind){
                        $sql_query = $sql_query.$ind.',';
                }
                if(substr($sql_query, -1) == ','){
                    $sql_query = substr($sql_query, 0, -1); 
                }
                $sql_query = $sql_query." )";    
            }
        }


       if(array_key_exists('user',$params)){
            $users = $params["user"];

            if(is_null($users)){
               //
            }else{              
                $sql_query = $sql_query." and questions.user_name in (";
                foreach ($users as $ind){
                        $sql_query = $sql_query."'".$ind."',";
                }
                if(substr($sql_query, -1) == ','){
                    $sql_query = substr($sql_query, 0, -1); 
                }
                $sql_query = $sql_query." )";    
            }
        }

        $RECORDS_PER_PAGE=10;   
        $total_number=0;
        $sql_query=$sql_query." order by questions.date_asked desc LIMIT ".$RECORDS_PER_PAGE;
        $OFFSET = ($RECORDS_PER_PAGE*($page_number-1));
        $sql_query=$sql_query." OFFSET ".$OFFSET;
        //print $sql_query;
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);


        $temp_array_all_question =  array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $single_question = array();
            $OFFSET = $OFFSET + 1;
            $total_number = $total_number+1;
            $single_question['question_seq_num']= $OFFSET;    
            $single_question['question_id']= $row["question_id"];    
            $single_question['question_title']= $row["question_title"];
            $single_question['question_short_title']= $row["question_short_title"];
            $single_question['question_text']=  ($row["question_text"]);    
            $single_question['user_name']= $row["user_name"];
            $single_question['user_full_name']= $row["user_full_name"];
            $single_question['date_asked']=   $row["date_asked"];
            $single_question['status_id']=   $row["status_id"];
            $single_question['status_name']=   $row["status_name"];
            $temp_array_all_question[$row["question_id"]]   = $single_question;
        }


        #GET DEPARTMENTS
        foreach ($temp_array_all_question as $single_question){
            $sql_query = 'select d.department_id, d.department_name from departments d, question_to_department qtd where d.department_id =qtd.department_id'; 
            $sql_query = $sql_query . ' and qtd.question_id= :question_id';
            $sql_query_params = array("question_id"=>$single_question['question_id']);
            $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
            $all_departments = array();
            foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
                $dept = array();                
                $dept['department_id']= $row["department_id"]; 
                $dept['department_name']= $row["department_name"];    
                $all_departments[$dept['department_id']]=$dept;
            }
            $single_question['all_departments']=   $all_departments;
            $array_all_question[$single_question["question_id"]]   = $single_question;
        }


        $this->set('array_all_question',$array_all_question);
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
        
        $this->set('title', 'Questions');
        $this->set('sub','sub_quesstions_list.html');
        $out=$this->render('basic/layout.html');
        $this->set('sub_out_put',$out);
        $this->set('LANGUAGE','en-US');     
        echo $this->render('basic/main.html');   
    }

//TODO: Need to optimize this according to the tab
//called. We need the counts for other tabs
function question_by_id() {
        $question_id = intval($this->get('PARAMS["question_id"]'));
        $tab = $this->get('PARAMS["tab"]');
        if($tab){
            if($tab == ''){
                $tab = 'question';
            }
            if($tab != 'response' && $tab != 'reaction' && $tab != 'question' ){
                $tab = 'question';
            }
        }else{
            $tab = 'question';
        }

        //All variables
        $question = array();
        $response_count = 0;
        $reaction_count = 0;
        $all_public_reactions = array();
        $all_responses_updated = array();

        $sql_query = 'select * from questions, user, status where questions.publish_status=1';
        $sql_query = $sql_query . ' and questions.user_name = user.user_name';
        //$sql_query = $sql_query . ' and questions.department_id = departments.department_id';
        $sql_query = $sql_query . ' and questions.status_id = status.status_id';
        //$sql_query = $sql_query . ' and questions.location_id = location.location_id';
        $sql_query = $sql_query . ' and questions.question_id = :question_id';
        $sql_query_params = array("question_id"=>$question_id);

        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);

        //GET QUESTION DETAILS
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $question['question_id']= $row["question_id"];    
            $question['question_title']= $row["question_title"];
            $question['question_short_title']= $row["question_short_title"];
            $question['question_text']= Markdown($row["question_text"]);    
            $question['user_name']= $row["user_name"];
            $question['user_full_name']= $row["user_full_name"];
            $question['date_asked']=   $row["date_asked"];
            //$question['department_id']=   $row["department_id"];
            //$question['department_name']=   $row["department_name"];
            $question['status_id']=   $row["status_id"];
            $question['status_name']=   $row["status_name"]; 
            //$question['location_name']=   $row["location_name"]; 
            //$question['location_id']=   $row["location_id"]; 
            
            $reaction_count = $row["meta_reaction_count"];   
            $response_count = $row["meta_response_count"];   
            break;
        }

        //GET DEPARTMENTS
        $sql_query = 'select d.department_id, d.department_name from departments d, question_to_department qtd where d.department_id =qtd.department_id'; 
        $sql_query = $sql_query . ' and qtd.question_id= :question_id';
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
        $all_departments = array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $dept = array();
            $dept['department_id']= $row["department_id"]; 
            $dept['department_name']= $row["department_name"];    
            $all_departments[$dept['department_id']]=$dept;
        }

        //GET LOCATIONS
        $sql_query = 'select d.location_id, d.location_name from location d, question_to_location qtd where d.location_id =qtd.location_id'; 
        $sql_query = $sql_query . ' and qtd.question_id= :question_id';
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
        $all_locations = array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            $loc = array();
            $loc['location_id']= $row["location_id"]; 
            $loc['location_name']= $row["location_name"];    
            $all_locations[$loc['location_id']]=$loc;
        }
        if($tab == 'response'){
            //GET RESPONSES
            $sql_query = 'select * from responses where responses.question_id= :question_id  order by date_of_response asc';
            $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
    
            $all_responses = array();
            foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
                $response = array();
                $response['response_id']= $row["response_id"];    
                $response['response_text']= Markdown($row["response_text"]);
                $response['date_of_response']= $row["date_of_response"];            
                $all_responses[$response['response_id']]=$response;
            }

            //GET DOCUMENTS FOR RESPONSES
            $all_responses_updated = array();
            foreach($all_responses as $resp){
                $response_id = $resp['response_id'];
                $sql_query = 'select * from documents where documents.response_id=:response_id  order by documents.document_id asc';
                $ASKYOURGOVT_DB->exec($sql_query, array("response_id"=>intval($response_id)));
                $all_documents_for_a_response = array();
                foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
                    $doc = array();
                    $doc['document_id']= $row["document_id"];    
                    $doc['document_path']= $row["document_path"];
                    $doc['document_title']= $row["document_title"];
                    $doc['document_file_name']= $row["document_file_name"];
                    $doc['document_file_type']= $row["document_file_type"];
                    $all_documents_for_a_response[$doc['document_id']] =$doc;
                }
                    $resp['documents']=$all_documents_for_a_response;
                    $all_responses_updated[$resp['response_id']] = $resp;
            }
        }//End of Response tab
        if($tab == 'reaction'){
            //GET REACTIONS
            $sql_query = 'select *  from public_reaction where question_id=:question_id order by public_reaction_date desc';
            $ASKYOURGOVT_DB->exec($sql_query, array("question_id"=>intval($question_id)));
            
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
        }//End of reaction tab

        if (sizeof($question) == 0){
            $this->set('title', 'Not found');
            $this->set('tab', $tab);
            $this->set('sub','sub_quesstion_detail.html');
            $out=$this->render('basic/layout.html');
            $this->set('sub_out_put',$out);
            $this->set('LANGUAGE','en-US');     
            echo $this->render('basic/main.html');   
        }else{
            $this->set('title', $question['question_title']);
            $this->set('question', $question);
            $this->set('all_responses', $all_responses_updated);
            $this->set('all_public_reactions', $all_public_reactions);
            $this->set('all_departments', $all_departments);
            $this->set('all_locations', $all_locations);

            $this->set('response_count', $response_count);
            $this->set('reaction_count', $reaction_count);
            $this->set('tab', $tab);

            $this->set('sub','sub_quesstion_detail.html');
            $out=$this->render('basic/layout.html');
            $this->set('sub_out_put',$out);
            $this->set('LANGUAGE','en-US');     
            echo $this->render('basic/main.html');             
        }
    }

}
?>