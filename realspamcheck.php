<?php
	session_start();
	$realImageSpamCode = strtoupper(substr(md5(rand()),20,4));
	if($realImageSpamCode)
	{
		$_SESSION['spamcheck'] = $realImageSpamCode;
		@session_write_close();
		if(function_exists('imagecreate'))
		{
			$realImageWidth = 44;
			$realImageHeight= 22;
			$im = @imagecreate($realImageWidth, $realImageHeight)
				or die ("Error:We can not create new GD image,please check your hosting setting !");
			$realBrown = imagecolorallocate($im, 253, 147, 10);
			$realBlack = imagecolorallocate($im, 0, 0, 0);
			
			for ($i=0;$i<strlen($realImageSpamCode);$i++)
			{
				imagechar($im,3,$i*$realImageWidth/4+3,5, $realImageSpamCode[$i],$realBlack);
			}

			for($i=0; $i <= 100; $i++) 
			{
				$realRandPoint = imagecolorallocate($im, mt_rand(40, 220), mt_rand(40, 220), mt_rand(40, 220));
				imagesetpixel($im, mt_rand(0, 43), mt_rand(0, 21), $realRandPoint);
			}
			
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			
			if(function_exists("imagepng"))
			{
				header("Content-type: image/png");
				imagepng($im);
			}
			elseif(function_exists("imagegif"))
			{
				header("Content-type: image/gif");
				imagegif($im);
			}
			elseif(function_exists("imagejpeg"))
			{
				header("Content-type: image/jpeg");
				imagejpeg($im);
			}
			else
			{
				die(__("It seems this PHP server do not support image!"));
			}
			imagedestroy($im);
		}
		else
		{
			echo "Hi,Your server do not support GD,please contact your administrator to support GD, or you can change it at php.ini, we need GD to generate CAPTCHA CODE";
		}
	}
?>