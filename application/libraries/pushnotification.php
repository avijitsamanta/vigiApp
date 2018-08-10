<?php 
// Server file
class PushNotification {

	// (Android)API access key from Google API's Console.
	private static $API_ACCESS_KEY = 'AIzaSyDG3fYAj1uW7VB-wejaMJyJXiO5JagAsYI';
	// (iOS) Private key's passphrase.
	private static $passphrase = '';
	// (Windows Phone 8) The name of our push channel.
        private static $channelName = "joashp";
	
	// Change the above three vriables as per your app.

	/*public function __construct() {
		exit('Init function is not allowed');
	}*/
	
        // Sends Push notification for Android users
	public function android($data, $reg_id) {
	        $url = 'https://android.googleapis.com/gcm/send';
	        $message = array(
	            'title' => $data['mtitle'],
	            'message' => $data['mdesc'],
	            'subtitle' => '',
	            'tickerText' => '',
	            'msgcnt' => 1,
	            'vibrate' => 1
	        );
	        
	        $headers = array(
	        	'Authorization: key=' .self::$API_ACCESS_KEY,
	        	'Content-Type: application/json'
	        );
	
	        $fields = array(
	            'registration_ids' => array($reg_id),
	            'data' => $message,
	        );
	
	    	return $this->useCurl($url, $headers, json_encode($fields));
    	}
	
	// Sends Push's toast notification for Windows Phone 8 users
	public function WP($data, $uri) {
		$delay = 2;
		$msg =  "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
		        "<wp:Notification xmlns:wp=\"WPNotification\">" .
		            "<wp:Toast>" .
		                "<wp:Text1>".htmlspecialchars($data['mtitle'])."</wp:Text1>" .
		                "<wp:Text2>".htmlspecialchars($data['mdesc'])."</wp:Text2>" .
		            "</wp:Toast>" .
		        "</wp:Notification>";
		
		$sendedheaders =  array(
		    'Content-Type: text/xml',
		    'Accept: application/*',
		    'X-WindowsPhone-Target: toast',
		    "X-NotificationClass: $delay"
		);
		
		$response = $this->useCurl($uri, $sendedheaders, $msg);
		
		$result = array();
		foreach(explode("\n", $response) as $line) {
		    $tab = explode(":", $line, 2);
		    if (count($tab) == 2)
		        $result[$tab[0]] = trim($tab[1]);
		}
		
		return $result;
	}
	
        // Sends Push notification for iOS users
	public function iOS($deviceToken, $data) {

		//echo "asdasd";exit;

		$apnsCert = APPPATH.'libraries/devPushCert.pem';

		$ctx = stream_context_create();
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		// Create the payload body
		$body['aps'] = array(
			'alert' => array(
			    'title' => $data['mtitle'],
                'body' => $data['mdesc'],
			 ),
			'sound' => 'default'
		);

		// Encode the payload as JSON
		$payload = json_encode($body);

		foreach($deviceToken as $tokenvalue){
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $tokenvalue) . pack('n', strlen($payload)) . $payload;
			}

			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
			//print_r($result);
			// Close the connection to the server
			fclose($fp);
		

		if (!$result)
			return 'FAILURE';
		else
			return 'SUCCESS';

	}

	 public function pushNoti_ios($deviceToken='', $data=array()) {

	 	 $ctx = stream_context_create();
       $apnsCert = APPPATH.'libraries/devPushCert.pem';
        stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
        // Put your private key's passphrase here: 
        $passphrase = '';
        stream_context_set_option($ctx, 'ssl', 'passphrase', '');
		$fpurl='ssl://gateway.push.apple.com:2195';
       
        
        $body['aps'] = array(
			'alert' => array(
			    'title' => $data['mtitle'],
                'body' => $data['mdesc'],
			 ),
			'sound' => 'default'
		);
        
       
   
        $payload = json_encode($body);

       // echo CRC32($deviceToken);exit;

	// Build the binary notification
	try {
	    $msg = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', sprintf('%u', CRC32($deviceToken)))) . chr(0) . chr(strlen($payload)) . $payload;
	} catch (Exception $e) {
	    return 'FAILURE';
	}
	$fp = null;
	$fp = @stream_socket_client($fpurl, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
	if (!$fp)
	    exit("Failed to connect: $err $errstr" . PHP_EOL);

	// Send it to the server
	try {
	    $result = fwrite($fp, $msg, strlen($msg));
	    fclose($fp);
	    $fp = null;
	    $ctx = null;
	} catch (Exception $e) {
	    if (!$fp) {
		fclose($fp);
	    }
	    $fp = null;
	    $ctx = null;
	    return 'FAILURE';
	}
	//print_r($result);
	if ($result)
	    return 'SUCCESS';
	else
	    return 'FAILURE';
    }


    public function iOS1($devicetoken='',$data=array()) {
		 $deviceToken = $devicetoken;
		//echo "lal".$deviceToken."lal";exit;
		$ctx = stream_context_create();
		$apnsCert = APPPATH.'libraries/prodPushCert.pem'; 
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		// Create the payload body
		$body['aps'] = array(
			'alert' => array(
			    'title' => $data['mtitle'],
                'body' => $data['mdesc'],
			 ),
			'sound' => 'default'
		);
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		//$msg = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		// Close the connection to the server
		fclose($fp);
		//print_r($result);exit;
		if (!$result)
			return 'FAILURE';
		else
			return 'SUCCESS';
	}
	
	// Curl 
	private function useCurl(&$model, $url, $headers, $fields = null) {
	        // Open connection
	        $ch = curl_init();
	        if ($url) {
	            // Set the url, number of POST vars, POST data
	            curl_setopt($ch, CURLOPT_URL, $url);
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	     
	            // Disabling SSL Certificate support temporarly
	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	            if ($fields) {
	                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	            }
	     
	            // Execute post
	            $result = curl_exec($ch);
	            if ($result === FALSE) {
	                die('Curl failed: ' . curl_error($ch));
	            }
	     
	            // Close connection
	            curl_close($ch);
	
	            return $result;
        }
    }
    
}
?>