<?php
class ContactUsController extends EshopPage 
{
	private $reciever = "administrator";
	private $recieverEmail = "helin16@gmail.com";
	
	public function onload()
	{
		if(!$this->IsPostBack)
		{
			$this->result->Visible=false;
			
			$this->setTitle("fdsfdsfsd");
			
			$no1 = rand(11,20);
			$no2 = rand(null,10);
			$operators = array("+","-","*");
			$opr = $operators[rand(null,2)];
			$this->spamCheckingLabel->Text = "$no1 $opr $no2 = ";
			switch($opr)
			{
				case "+" : $no = $no1 + $no2;break;
				case "-" : $no = $no1 - $no2;break;
				case "*" : $no = $no1 * $no2;break;
			}
			$this->spamCheckingNo->Text=$no;
//			$this->Page->setFocus($this->name->getClientId());
		}
	}
	
	public function sendEmail($sender, $params)
	{
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
}
?>