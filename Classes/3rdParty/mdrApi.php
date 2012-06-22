<?php

class Tx_Mdrmanager_3rdParty_mdrApi {
	// When filled in, the auth,user and pass values are automatically supplied in each request
	var $authtype = "md5";    // Tells server if password is sent in 'plain' or 'md5', when useSSL = false only 'md5' is allowed
	var $user     = '';
	var $pass     =  '';

	var $host   = "manager.mijndomeinreseller.nl";
	var $url    = "/api/?";
	var $useSSL = true;

	var $PostString;
	var $RawData;
	var $Values;

	public function __construct() {
		$info = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mdrmanager']);
		$this->user = $info['username'];
		$this->pass = md5($info['password']);
	}

	function NewRequest() {
		// Clear out all previous values
		$this->PostString = "";
		$this->RawData = "";
		$this->Values = "";
	}

	function AddError( $error ) {
		// Add an error to the result list
		$this->Values[ "errcount" ] = "1";
		$this->Values[ "Err1" ] = $error;
	}

	function ParseResponse( $buffer ) {
		// Parse the string into lines
		$Lines = explode( "\n", $buffer );

		// Get # of lines
		$NumLines = count( $Lines );

		// Skip past header
		$i = 0;
		while ( trim( $Lines[ $i ] ) != "" ) {
			$i = $i + 1;
		}

		$StartLine = $i;

		// Parse lines
		$GotValues = 0;
		for ( $i = $StartLine; $i < $NumLines; $i++ ) {
			// Is this line a comment?
			if ( substr( $Lines[ $i ], 1, 1 ) != ";" ) {
				// It is not, parse it
				$Result = explode( "=", $Lines[ $i ] );


				// Make sure we got 2 strings
				if ( count( $Result ) >= 2 ) {

					// Trim whitespace and add values
					$name = trim( $Result[0] );
					$value = trim( $Result[1] );
					$this->Values[ $name ] = $value;

					// Was it an errcount value?
					if ( $name == "errcount" ) {
						// Remember this!
						$GotValues = 1;
					}
				}
			}
		}

		if ( $GotValues == 0 ) {
			// We didn't, so add an error message
			$this->AddError( "Could not connect to Server -Please try again Later" );
		}
	}

	function AddParam( $Name, $Value ) {
		// URL encode the value and add to PostString
		$this->PostString = $this->PostString . $Name . "=" . urlencode( $Value ) . "&";
	}

	function DoTransaction() {
		if($this->user != "" && $this->pass != "" && $this->authtype != "") {
			$this->AddParam( "user" , $this->user );
			$this->AddParam( "pass" , $this->pass );
			$this->AddParam( "authtype" , $this->authtype );
		}

		$Values = "";

		if($this->useSSL){
			$port = 443;
			$address = gethostbyname( $this->host );
			$socket = fsockopen("ssl://".$this->host,$port);
		} else {
			$port = 80;
			$address = gethostbyname( $this->host );
			$socket = fsockopen($this->host,$port,$errno,$errstr,30);
		}
		if ( !$socket ) {
			function strerror()
			{
				echo "Could not connect to Server -Please try again Later ($errno, $errstr)";
			}
			$this->AddError( "socket() failed: " . strerror( $socket ) );
		} else {
			// Send GET command with our parameters
			$out = '';

			$in = "GET " . $this->url . $this->PostString . " HTTP/1.0\r\n";
			$in .= "Host: " . $this->host . "\r\n";
			$in .= "Connection: Close\r\n\r\n";

			fputs($socket,$in);

			// Read response
			while ( $out=fread ($socket,2048) ) {
				// Save in rawdata
				$this->RawData .= $out;
			}
			// Close the socket
			fclose( $socket );

			// Parse the output for name=value pairs
			$this->ParseResponse( $this->RawData );
		}
	}

	function getRequest() {
		return $this->PostString;
	}
}

?>