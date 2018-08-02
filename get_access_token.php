<?php
$appid = 'wxd02bb17b41447670';
$secret = '32ecf1c97664e149f70ee8e331604b85';
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

$url = "https://api.weixin.qq.com/device/getqrcode?access_token=".$access_token."&product_id=48872";
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
var_dump($out) ;

$deviceid = $out['deviceid'];

	function http_post_data($url, $data) {  
       
       //将数组转成json格式
       $data = json_encode($data);
       
       //1.初始化curl句柄
        $ch = curl_init(); 
        
        //2.设置curl
        //设置访问url
        curl_setopt($ch, CURLOPT_URL, $url);  
        
        //捕获内容，但不输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        //模拟发送POST请求
        curl_setopt($ch, CURLOPT_POST, 1);  
        
        //发送POST请求时传递的参数
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        
        //设置头信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
            'Content-Type: application/json; charset=utf-8',  
            'Content-Length: ' . strlen($data))  
        );  
 
        //3.执行curl_exec($ch)
        $return_content = curl_exec($ch);  
        
        //如果获取失败返回错误信息
        if($return_content === FALSE){ 
            $return_content = curl_errno($ch);
        }
        
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
        
        //4.关闭curl
        curl_close($ch);
        
        return array($return_code, $return_content);  
    }  

    function jsonFormat($data, $indent=null){  
   
	    // 对数组中每个元素递归进行urlencode操作，保护中文字符  
	    array_walk_recursive($data, 'jsonFormatProtect');  
	   
	    // json encode  
	    $data = json_encode($data);  
	   
	    // 将urlencode的内容进行urldecode  
	    $data = urldecode($data);  
	   
	    // 缩进处理  
	    $ret = '';  
	    $pos = 0;  
	    $length = strlen($data);  
	    $indent = isset($indent)? $indent : '    ';  
	    $newline = "\n";  
	    $prevchar = '';  
	    $outofquotes = true;  
	   
	    for($i=0; $i<=$length; $i++){  
	   
	        $char = substr($data, $i, 1);  
	   
	        if($char=='"' && $prevchar!='\\'){  
	            $outofquotes = !$outofquotes;  
	        }elseif(($char=='}' || $char==']') && $outofquotes){  
	            $ret .= $newline;  
	            $pos --;  
	            for($j=0; $j<$pos; $j++){  
	                $ret .= $indent;  
	            }  
	        }  
	   
	        $ret .= $char;  
	           
	        if(($char==',' || $char=='{' || $char=='[') && $outofquotes){  
	            $ret .= $newline;  
	            if($char=='{' || $char=='['){  
	                $pos ++;  
	            }  
	   
	            for($j=0; $j<$pos; $j++){  
	                $ret .= $indent;  
	            }  
	        }  
	   
	        $prevchar = $char;  
	    }  
	   
	    return $ret;  
	}  
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
		'product_id'=>'48872'
	);

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
	$url = "https://api.weixin.qq.com/device/create_qrcode?access_token=".$access_token."";  
	$device_id_list = array(
		"test",
	);
  	$data = array(
		'device_num'=>'1',
		'device_id_list'=>$device_id_list,
	);
	$postJosnData = json_encode($data);
	echo $postJosnData;
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