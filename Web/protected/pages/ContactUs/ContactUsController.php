<?php
class ContactUsController extends EshopPage 
{
	private $reciever;
	private $recieverEmail;
	
	public function __construct()
	{
		parent::__construct();
		$this->reciever= Config::get("email","contactUsReciever");
		$this->recieverEmail= Config::get("email","contactUsRecieverEmail");
		$this->menuItemName="contactus";
	}
	
	public function onload()
	{
		if(!$this->IsPostBack)
		{
			$this->result->Visible=false;
			
			$this->setTitle("Contact Us");
			
			$this->captcha->ImageUrl="/stream?method=getCaptcha&width=60&height=23";
//			$this->Page->setFocus($this->name->getClientId());
		}
	}
	
	public function sendEmail($sender, $params)
	{
		$this->result->Visible=false;
		if(md5(trim($this->spamInput->Text)).'a4xn' != $_COOKIE['tntcon'])
		{
			$this->spamError->Text="Invalid verification code!";
			return;
		}
		
		$todayis = date("l, F j, Y, g:i a") ;

		$attn = $this->reciever;
		$visitor = $this->name->Text ;
		$subject = "Email from Web (from $visitor): $todayis";
		
		$visitormail = $this->emailAddr->Text;
		$notes = stripcslashes($this->emailContent->Text);
		
		$message = " $todayis [EST] \n
		Attention: $attn \n
		Message: $notes \n
		From: $visitor ($visitormail)\n
		Additional Info : IP = $ip \n
		Browser Info: $httpagent \n
		Referral : $httpref \n
		";
		
		$from = "From: $visitormail\r\n";
		
		
//		mail($this->recieverEmail, $subject, $message, $from);
		$this->result->Visible=true;
	}
	
	public function changeCaptcha($sender, $param)
	{
		$now = mktime();
		$this->captcha->ImageUrl="/stream?method=getCaptcha&width=60&height=23&".$now;
	}
}
?>