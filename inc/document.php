<?php

class Document extends F3instance {
    function document_view_by_id() {
        $document_id = intval($this->get('PARAMS["document_id"]'));
        $sql_query ="select * from documents where document_id=:document_id";
        $sql_query_params = array("document_id"=>$document_id);
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
        $doc = array();

        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
                $doc['document_id']= $row["document_id"];    
                $doc['document_path']= $row["document_path"];
                $doc['document_title']= $row["document_title"];
                $doc['document_file_name']= $row["document_file_name"];
                $doc['document_file_type']= $row["document_file_type"];
                $doc['question_id']= $row["question_id"];
                $doc['response_id']= $row["response_id"];
            break;
        }

        $sql_query ="select * from questions where question_id=:question_id";
        $sql_query_params = array("question_id"=>$doc['question_id']);
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
                $doc['question_title']= $row["question_title"];    
                break;
        }


        if (sizeof($doc) == 0){
            $this->set('title', 'Not found');
            $this->set('sub','sub_view_document.html');
            $out=$this->render('basic/layout.html');
            $this->set('sub_out_put',$out);
            $this->set('LANGUAGE','en-US');     
            echo $this->render('basic/main.html');   
        }else{
            $this->set('title', $doc['document_title']);
            $this->set('document', $doc);
            $this->set('sub','sub_view_document.html');
            $out=$this->render('basic/layout.html');
            $this->set('sub_out_put',$out);
            $this->set('LANGUAGE','en-US');     
            echo $this->render('basic/main.html');             
        }


    }





}