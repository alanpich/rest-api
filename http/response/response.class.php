<?php namespace alanpich\REST\HTTP\Response;

class Response {

protected $status = 200;
protected $message;

function __construct(){
		
	}//
	
// Send the response 
//------------------------------------------------------------------
public function Send(){
			
		$R = new \stdClass;
		$R->status = $this->status;
		if(!empty($this->message)){
			$R->msg = $this->message;
		};
		if(isset($this->data)){
			$R->data = $this->data;
		};
		
		// If set, include Request in response
		if(defined('RESPOND_WITH_REQUEST') && RESPOND_WITH_REQUEST){	
			 $R->_Request = $GLOBALS['Request'];
		};

		echo json_encode($R);
		die();
	}//

};// end class Response
