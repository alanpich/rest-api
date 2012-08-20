<?php namespace alanpich\REST\HTTP\Response;

class Success extends Response {

function __construct($data = NULL){
	$this->message = 'success';
	$this->data = $data;
}//

};// end class alanpich\REST\HTTP\Response\Success
