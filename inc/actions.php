<?php

class Actions extends F3instance {
    function report_question_by_id() {
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
        $comment = "no comment";
        if(isset($_GET["comment"])){
            $comment = htmlspecialchars($_GET["comment"]);
        }

        $sql_query = 'insert into report_issue("type" , "type_id" , "comments") values ("question",'.$question_id.',"'.$comment.'")';
        $ASKYOURGOVT_DB=F3::get('ASKYOURGOVT_DB');
        $ASKYOURGOVT_DB->exec($sql_query);

        $this->set('title', 'Thank you');
        $this->set('sub','sub_action_report.html');
        $out=$this->render('basic/layout.html');
        $this->set('sub_out_put',$out);
        $this->set('LANGUAGE','en-US');     
        echo $this->render('basic/main.html');   

     }
}

?>