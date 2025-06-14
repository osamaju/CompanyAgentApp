<?php
if (isset($_POST['key'])) {
    require_once 'queries.php';
    $x = new analyse();
    $id=0;
    if(isset($_POST['id'])){
        $id=$_POST['id'];
    }
    switch ($_POST['key']) {
        case 'survey':
            $x->get_ddl_question($id);
            break;
        case 'question':
            $x->get_ddl_answer($id);
            break;
        case 'result':
            $x->get_result($_POST['id_survey'],$_POST['id_question'],$_POST['id_answer']);
            break;
        default:
            exit;
    }
} else {
    exit;
}
