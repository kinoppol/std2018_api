<?php

function callAPI($method, $url,$school_id,$data){
   //header("Content-type: application/json; charset=utf-8");
   $curl = curl_init();

   curl_setopt($curl, CURLOPT_FAILONERROR, true);
   switch ($method){
      
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, std2018apikey($school_id));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){
      //print "Connection Failure ".curl_error($curl);
   }
   curl_close($curl);
   return $result;
}

function convertdate($date){
   //$startdate = “25/03/2012”;
   $dateobj = DateTime::createFromFormat('dmY', $date);
   return $dateobj->format('Y-m-d');
}
