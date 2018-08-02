<?php 
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret . "";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//跳过证书验证
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在 
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	$out = json_decode($result, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
	$access_token = $out['access_token'];
	echo $access_token;

	$url = "https://api.weixin.qq.com/hardware/mydevice/platform/notify?access_token=".$access_token."";  
	$data = array(
		'error_code'=>'0',
		'error_msg'=>'ok',
	);
	$postJosnData = json_encode($data);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postJosnData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	$data = curl_exec($ch);
	var_dump($data);

    $data = array(
		'asy_error_code'=>'0',
		'asy_error_msg'=>'ok',
		'device_id'=>'gh_4f83fa5bb880_130a827fdf4ff052',
		'device_type'=>'gh_4f83fa5bb880',
		'msg_id'=>'614816609',
		'msg_type'=>'get',
		'data'=>'1',
		'services'=>array(
			'operation_status'=>array(
				'status'=>'0',
			),
			'lightbulb'=>array(
				'alpha'=>'1',
				'color_hsl'=>'1',
			),
		), 

	);	
	$url = "https://api.weixin.qq.com/hardware/mydevice/platform/notify?access_token=".$access_token."";  
	$postJosnData = json_encode($data);
	//echo $postJosnData;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postJosnData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	$data = curl_exec($ch);
	var_dump($data);
?>