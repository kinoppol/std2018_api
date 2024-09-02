<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once('lib.php');
#Config
$api_url='http://std2018-api.vec.go.th/webservice/api/GetStudentList/';
$school_id='1310096201'; //1310096201 bangna commercial college.
$file_dir=APP_PATH."studentTemp/";

set_time_limit(120);
ini_set('memory_limit', '1024M');

$make_call = callAPI('POST', $api_url,$school_id, json_encode($data_array));
 
$file_name=$school_id.".json";
$file_path=$file_dir.$file_name;

if(!is_dir($file_dir)){
    mkdir($file_dir,0777);
}

if(isJson($make_call)){
$file=fopen($file_path,'w');
$ret=array(
    'status'=>'success',
    'message'=>array('en'=>'STUDENT_'.$school_id.'_IS_LOADED',
    )
);
}else{
$file=fopen($file_path.".err",'w');

$ret=array(
    'status'=>'success',
    'message'=>array('en'=>'STUDENT_'.$school_id.'_CAm\'t_LOAD',
    )
);

}
fwrite($file,$make_call);
fclose($file);
print json_encode($ret,JSON_UNESCAPED_UNICODE);
