<?php

class mylib
{
	public function mail_send($to,$subject,$msg)
	{
		echo "mail function";
		 // $to = "gurcharanit@gmail.com";
        // $subject = "This is subject";
         
         $message = "<b>$msg</b>";
         //$message .= "<h1>This is headline.</h1>";
         
         $header = "From:gurcharanit@gmail.com \r\n";
       //  $header .= "Cc:@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
	}
}


?>