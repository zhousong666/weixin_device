<?php

$appid = 'wx0ba40bcb9a4e719b';
$secret = '6a5ad357e27a2cc9d250fa8534fa0e94';

function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}
function http_post_data($url, $data) {  
   	$data = json_encode($data);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	$data = curl_exec($ch);
	return $data;//return array($return_code, $return_content);  
} 

function getAccessToken($appid,$secret){
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret . "";
	$result = httpGet($url);
	$out = json_decode($result, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
	$access_token = $out['access_token'];
	echo $access_token;
	return $access_token;;
}

function getDeviceID($access_token){
	$url = "https://api.weixin.qq.com/device/getqrcode?access_token=".$access_token."&product_id=48842";
	$result = httpGet($url);
	$out = json_decode($result, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
	//var_dump($out) ;
	$deviceid = $out['deviceid']; 
	echo $deviceid;
	return $deviceid;
}

function authorizedDeviceSevice($access_token,$deviceid){
	$url = "https://api.weixin.qq.com/device/authorize_device?access_token=".$access_token."";  
	$device_list = array(array(
		'id'=>$deviceid,
		'mac'=>'1cda27c12d69',
		'connect_protocol'=>'4',		 
		'auth_key'=>'Abcdef1234566543abcdef1234566544',
		'close_strategy'=>'2',
		'conn_strategy'=>'1',		 
		'crypt_method'=>'0',
		'auth_ver'=>'0',
		'manu_mac_pos'=>'-1',		 
		'ser_mac_pos'=>'-2',
		'ble_simple_protocol'=>'0'),
	);
	$data = array(
	'device_num'=>'1',
	'device_list'=>$device_list,
	'op_type'=>'0',
	'product_id'=>'48842'
	);
	$data = http_post_data($url, $data);
	//var_dump($data);
	//$data = json_decode($data,true);
	//$device_type = $data['resp']['0']['base_info']['device_type'];
	//$device_type = json_encode($device_type,JSON_FORCE_OBJECT);
	//echo $device_type;
	//$device_id = $data['resp']['0']['base_info']['device_id'];
	//$device_id = json_encode($device_id,JSON_FORCE_OBJECT);
	//echo $device_id;
}
function createQrode($access_token,$deviceid)
{
	$url = "https://api.weixin.qq.com/device/create_qrcode?access_token=".$access_token."";  
	$device_id_list = array(
		$deviceid,
	);
  	$data = array(
		'device_num'=>'1',
		'device_id_list'=>$device_id_list,
	);
	$qrode = http_post_data($url, $data);
	echo $qrode;
	return $qrode;	
}
//需要设备授权邦定之后才能获取openid
function getOpenID($access_token){
	$url = "https://api.weixin.qq.com/device/get_openid?access_token=".$access_token."&device_type=gh_4f83fa5bb880&device_id=gh_4f83fa5bb880_130a827fdf4ff052";
	$result = httpGet($url);
	$out = json_decode($result, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
	var_dump($out) ;
	return $out;
}
$access_token = getAccessToken($appid,$secret);
$deviceid = getDeviceID($access_token);
authorizedDeviceSevice($access_token,$deviceid);
$qrode = createQrode($access_token,$deviceid);
//$openid = getOpenID($access_token);
?>