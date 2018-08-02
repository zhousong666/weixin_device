<?php

$json = '{
    "device_num": "1", 
    "device_list": [
        {
            "id": "gh_4f83fa5bb880_fb3a7861663b0d07", 
            "mac": "A81B6A76048E", 
            "connect_protocol": "4", 
            "auth_key": "", 
            "close_strategy": "1", 
            "conn_strategy": "1", 
            "crypt_method": "0", 
            "auth_ver": "0", 
            "manu_mac_pos": "-1", 
            "ser_mac_pos": "-1", 
            "ble_simple_protocol": "0"
        }
    ], 
    "op_type": "1", 
    "product_id": "48865"
}';

var_dump(json_decode($json));
//var_dump(json_decode($json, true));

?>