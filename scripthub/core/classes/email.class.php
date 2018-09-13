<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class email {
	
	public $contentType = 'text/plain';
	public $charSet = 'UTF-8';
	public $fromEmail = 'no-reply@domain.com';
	public $subject = '';
	public $message = '';	
	
	public $sendTo = '';
	private $sendCc = '';
	private $sendBcc = '';	
	
	public function to($email) {
		if(is_array($email)) {
			foreach($email as $e) {
				if($this->sendTo != '') {
					$this->sendTo .= ', ';
				}
				$this->sendTo .= $e;
			}
		}
		else {
			if($this->sendTo != '') {
				$this->sendTo .= ', ';
			}
			$this->sendTo .= $email;
		}
		
		return true;
	}
	
	public function cc($email) {
		if(is_array($email)) {
			foreach($email as $e) {
				if($this->sendCc != '') {
					$this->sendCc .= ', ';
				}
				$this->sendCc .= $e;
			}
		}
		else {
			if($this->sendCc != '') {
				$this->sendCc .= ', ';
			}
			$this->sendCc .= $email;
		}
		
		return true;
	}

	public function bcc($email) {
		if(is_array($email)) {
			foreach($email as $e) {
				if($this->sendBcc != '') {
					$this->sendBcc .= ', ';
				}
				$this->sendBcc .= $e;
			}
		}
		else {
			if($this->sendBcc != '') {
				$this->sendBcc .= ', ';
			}
			$this->sendBcc .= $email;
		}
		
		return true;
	}
	
	public function send() {
		
		if($this->sendTo == '' && $this->sendCc == '' && $this->sendBcc == '') {
			return 'Please set a recipient.';
		}
		
		if($this->subject == '') {
			return 'Please set a subject.';
		}
		
		if($this->message == '') {
			return 'Please set a message.';
		}
		
		$headers  = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: '.$this->contentType.'; charset='.$this->charSet."\r\n";
		
		$headers .= 'From: '.$this->fromEmail."\r\n";
		if($this->sendCc != '') {
			$headers .= 'Cc: '.$this->sendCc."\r\n";
		}
		if($this->sendBcc != '') {
			$headers .= 'Bcc: '.$this->sendBcc."\r\n";
		}

		return mail($this->sendTo, $this->subject, $this->message, $headers);
		
	}
}

?>