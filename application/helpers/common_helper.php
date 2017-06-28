<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getActiveClass')){
   function getActiveClass($class = NULL, $method = NULL){
          if(isset($method)){

				if($method == 'dashboard'){
					return 'dashboard';
				}elseif($method == 'users'){
					return 'users';
				}elseif($method == 'questionTemplate' OR  $method == 'addquestion' OR  $method == 'question' OR $method == 'edittemplate'){
					return 'question';
				}

              }
           }
       }

if ( ! function_exists('getProductImage')){
   function getProductImage($filePath = NULL, $fileName = NULL){
		 if($filePath != NULL && $fileName != NULL){
		 	if (file_exists($filePath.$fileName)) {
		 		return $filePath.$fileName;
 			 }else{
 			 	return base_url() . 'webassets/images/cap_01.png';
 			 }
		 }else{
		 	return base_url() . 'webassets/images/cap_01.png';
		 }

	}
  }


if ( ! function_exists('getMessage')){
   function getMessage($messageType = NULL, $message = NULL){
		 if($messageType != NULL && $message != NULL){

		 	switch($messageType){
		 		case 'success' : 
			 		return '<div class="alert alert-success">
	                              '.$message.'
	                        </div>';
			 		break;
			 	case 'error' : 
			 		return '<div class="alert alert-danger">
	                              '.$message.'
	                        </div>';
			 		break;
			 	case 'info' : 
			 		return '<div class="alert alert-info">
	                              '.$message.'
	                        </div>';
			 		break;
			 }
	 }
  }
}


if ( ! function_exists('questionType')){
   function questionType($questionType){
		 if($questionType != NULL){

		 	switch($questionType){
		 		case 'text' : 
			 		return 'Text Input';
			 		break;
			 	case 'date' : 
			 		return 'Date Input';
			 		break;
			 	case 'select' : 
			 		return 'Drop Down';
			 		break;
			 }
	 }
  }
}