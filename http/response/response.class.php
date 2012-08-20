<?php namespace alanpich\REST\HTTP\Response;

class Response {

protected $status = 200;
protected $message;

function __construct(){
		
	}//
	
	
public function Send(){
		
		$R = new \stdClass;
		$R->status = $this->status;
		if(!empty($this->message)){
			$R->msg = $this->message;
		};
		if(isset($this->data)){
			$R->data = $this->data;
		};

		echo json_encode($R);
		die();
	}//

};// end class Response
