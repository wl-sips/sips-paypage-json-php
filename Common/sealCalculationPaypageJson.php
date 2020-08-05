<?php
//This file is used to calculate the seal using the HMAC-SHA256 AND SHA256 algorithms

$singleDimArray = array();

function compute_payment_init_seal($sealAlgorithm, $data, $secretKey)
{
   $dataStr = flatten($data); 
   return compute_seal_from_string($sealAlgorithm, $dataStr, $secretKey, true);
}

function compute_payment_response_seal($sealAlgorithm, $data, $secretKey)
{
   return compute_seal_from_string($sealAlgorithm, $data, $secretKey, false);
}

function compute_seal_from_string($sealAlgorithm, $data, $secretKey, $hmac256IsDefault)
{
   if (strcmp($sealAlgorithm, "HMAC-SHA-256") == 0){
      $hmac256 = true;
   }elseif(empty($sealAlgorithm)){
      $hmac256 = $hmac256IsDefault;
   }else{
      $hmac256 = false;
   }
   return compute_seal($hmac256, $data, $secretKey);
}

function compute_seal($hmac256, $data, $secretKey)
{
   $serverEncoding = mb_internal_encoding();
   
   if(strcmp($serverEncoding, "UTF-8") == 0){
      $dataUtf8 = $data;
      $secretKeyUtf8 = $secretKey;
   }else{
      $dataUtf8 = iconv($serverEncoding, "UTF-8", $data);
      $secretKeyUtf8 = iconv($serverEncoding, "UTF-8", $secretKey);
   }
   if($hmac256){
      $seal = hash_hmac('sha256', $data, $secretKey);
   }else{
      $seal = hash('sha256',  $data.$secretKey);
   }
   return $seal;
}

function flatten($multiDimArray)
{
   global $singleDimArray;
   $sortedMultiDimArray = recursive_table_sort($multiDimArray);
   array_walk_recursive($sortedMultiDimArray, 'valueResearch');
   $string = implode("", $singleDimArray);
   $singleDimArray = array();
   return $string;
}

//Alphabetical order of field names in the table

function recursive_table_sort($table)
{
   ksort($table);
   foreach($table as $key => $value)
   {
      if(is_array($value)){
         $value = recursive_table_sort($value);
         $table[$key] = $value;
      }
   }
   return $table;
}

//This function flattens the sorted payment data table into singleDimArray 

function valueResearch($value, $key)
{
   global $singleDimArray;
   $singleDimArray[] = $value;
   return $singleDimArray;
}  

?>