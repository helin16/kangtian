<?php
class FileLoaderController extends EshopPage 
{
	public function onLoad()
	{
		if(!isset($this->Request["type"]) || trim($this->Request["type"])=="")
			die();
			
		switch (strtolower(trim($this->Request["type"])))
		{
			case "images":
				{
					if($this->Request["path"]=="captcha")
						$this->getCaptcha();
					else
						$this->getImage($this->Request["path"]);
					break;
				}
			case "css":
				{
					$this->getCss($this->Request["path"]);
					break;
				}
		}
		die;
	}
	
	public function getCss($cssPath="default.css")
	{
		try
		{
			$theme = Config::get("theme","name");
			$cssFilePath = dirname(__FILE__)."/../../theme/$theme/$cssPath";
			header('Content-Type: content=text');
			readfile($cssFilePath);
		}
		catch(Exception $ex)
		{
			echo ($ex->getMessage());
		}
	}

	public function getImage($path="")
	{
		try
		{
			$minetype =$this->mime_content_type(end(explode("/",$path)));

			$theme = Config::get("theme","name");
			$imagePath = dirname(__FILE__)."/../../theme/$theme/images/$path";
			header('Content-Type: ' . $minetype);
			readfile($imagePath);
		}
		catch(Exception $ex)
		{
			echo ($ex->getMessage());
		}
	}

	private function mime_content_type($filename) {

		$mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

		// images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

		// archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

		// adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

		// ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

		// open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		$ext = strtolower(array_pop(explode('.',$filename)));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}

	public function getCaptcha($width=50,$heigh=24)
	{
		header('Content-type: image/jpeg');
		
		$my_image = imagecreatetruecolor($width, $height);
		imagefill($my_image, 0, 0, 0xFFFFFF);

		// add noise
		for ($c = 0; $c < 100; $c++)
		{
			$x = rand(0,$width-1);
			$y = rand(0,$height-1);
			imagesetpixel($my_image, $x, $y, 0x000000);
		}
		
		$x = rand(1,10);
		$y = rand(1,10);
		
		$rand_string = rand(1000,9999);
		imagestring($my_image, 5, $x, $y, $rand_string, 0x000000);
		
		setcookie('tntcon',(md5($rand_string).'a4xn'));
		
		imagejpeg($my_image);
		imagedestroy($my_image);
	}
}
?>