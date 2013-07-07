<?php
class Batch extends F3instance {
    function question_meta_update() {
        $sql_query = "select * from questions";
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query);
        $question_ids = array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            array_push($question_ids,$row["question_id"]); 
        }

        foreach ($question_ids as $qid){
            //update the meta_reaction_count
            $sql_query = "update questions set meta_reaction_count = ( select  count(*)";
            $sql_query = $sql_query." from public_reaction where question_id=:question_id ) where question_id=:question_id";
            $sql_query_params = array("question_id"=>intval($qid));
            $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);

            //update the meta_response_count
            $sql_query = "update questions set meta_response_count = ( select  count(*)";
            $sql_query = $sql_query." from responses where question_id=:question_id ) where question_id=:question_id;";
            $sql_query_params = array("question_id"=>intval($qid));
            $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);            
        }

        $this->set('title','Batch Update');
        $this->set('sub_title','question meta update');
        $this->set('sub','sub_batch.html');
        $out=$this->render('basic/layout.html');        
        $this->set('sub_out_put',$out);
        $this->set('LANGUAGE','en-US');     
        echo $this->render('basic/main.html');
    }


    function users_meta_update() {
        $sql_query = "select * from user";
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query);
        $user_names = array();
        foreach (F3::get('ASKYOURGOVT_DB->result') as $row){
            array_push($user_names,$row["user_name"]); 
        }

        foreach ($user_names as $user_name){
            //update the meta_reaction_count
            $sql_query = "update user set meta_questions_count = ( select  count(*) ";
            $sql_query = $sql_query." from questions where user_name=:user_name ) where user_name=:user_name;";
            $sql_query_params = array("user_name"=>$user_name);
            $ASKYOURGOVT_DB->exec($sql_query, $sql_query_params);
        }

        $this->set('title','Batch Update');
        $this->set('sub_title','users meta update');
        $this->set('sub','sub_batch.html');
        $out=$this->render('basic/layout.html');        
        $this->set('sub_out_put',$out);
        $this->set('LANGUAGE','en-US');     
        echo $this->render('basic/main.html');
    }
}
?>    