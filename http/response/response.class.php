<?php namespace alanpich\REST\HTTP\Response;

class Response {

protected $status = 200;
protected $message;

protected $headers = array(
		'Cache-Control: no-cache',				// Prevent any caching en-route
		'Pragma: no-cache',						//		ditto (just in case)
		'Content-Type: application/json',		// MIME type for a json response	
	);

function __construct(){
		
	}//
	
// Add a response header to be sent
//------------------------------------------------------------------
protected function header($content){
		$this->headers[] = $content;
	}//
	
// Send the response 
//------------------------------------------------------------------
public function Send(){

		// Clear output buffer
		ob_clean();
		ob_start();
			
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
		
		
		// Set all headers
			$this->header('Rest-Token: '.TOKEN);
		$this->header('Rest-Server: '.SERVER_NAME);
		$this->header('Rest-Server-Version: '.SERVICE_VERSION);
		foreach($this->headers as $header){
			header($header,true);
		};
		

		echo json_encode($R);
		die();
	}//

};// end class Response
