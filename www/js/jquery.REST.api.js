

REST = {

	Version: '1.0'
	
	,BASE_URL: 'https://localhost/'
	,USERNAME: 'alan'

	// Main worker function - sends request and handles response
	//		@param	string	method		get|post|put|delete
	//		@param	string	path		RESTful path to request
	//		@param	object	data		Data params to be sent to server
	//		@param	func	callback	callback/response handler function	
	//		@param	bool	noauth		set to false to not send auth details	  
	//------------------------------------------------------------------------
	,send: function(method,path,data,callback,noauth){
			
			var params = {
					url: this.BASE_URL+path,
					type: method.toLowerCase(),
					context: this,
					complete: function(){
						this.receive(arguments)
					}
				};
			
			//	Add authentication details
			if(noauth==null || noauth === false){
				REQUEST_TOKEN = '123445';
				params.username = this.USERNAME;
				params.password = REQUEST_TOKEN;
			}
			
			// Add request headers
			params.headers = {
					'Request-Time': Math.round((new Date()).getTime() / 1000)
				};
				
			// Add request data params
			if( data == null || typeof(data) != 'object' ){
				console.warn('REST.send > data type ['+typeof(data)+'] is not an object');
				data = {};
			};
			params.data = data;

			// Send the request
			var R = $.ajax(params);
				
			// Assign the callback function
			if(callback == null){	callback = array(this,'dud');	};
			R.RESTcallback = callback
				
			console.log('sent');
			
			
		}//	
		
		
		
		
	,receive: function(args){
			var response = args[0];
			
			var R = {
				status: response.status,
				content: (response.responseText == null)? '{}' : response.responseText,
				headers: {}
			};
			
			// Grab all response headers
			var hdrs = response.getAllResponseHeaders().split("\n");
			for(var k=0;k<hdrs.length;k++){
				var bits = hdrs[k].split(': ',2);
				if(bits[0].length>1){
					R.headers[bits[0]] = bits[1];
				};
			};
			
			// Try and evaluate json in response content
			try {
				R.data = eval(R.content);
			} catch(err){}
			
			
			// Grab the callback function object
			var callback = response.RESTcallback;
			
			// If callback is already a function, just execute it
			if( $.isFunction( callback )){
				callback(R);
				return;
			};
			
			console.log(typeof(callback));
			
			// Otherwise, work through as an array( (Object) object , (string) function )
			if(isArray(callback)){
				var obj = callback[0];
				var fn = callback[1];
				obj[fn](R);			
				return;
			};
			
			// Should have exited, else warn
			console.warn('REST.receive > callback function not valid',callback);
			
		}//


	,dud: function(){}
};// end REST object


function isArray(obj) {
    return obj.constructor == Array;
}
