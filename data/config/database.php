<?php
/**
 * 配置文件
 */

return [
    // 数据库类型
    'type'     => 'mysql',
    // 服务器地址
    'hostname' => '127.0.0.1',
    // 数据库名
    'database' => 'dsp',
    // 用户名
    'username' => 'dsp',
    // 密码
    'password' => 'dfr38ck.',
    // 端口
    'hostport' => '3306',
    // 数据库编码默认采用utf8
    'charset'  => 'utf8mb4',
    // 数据库表前缀
    'prefix'   => 'cmf_',
    "authcode" => 'b8lzf6NU27MqQb36AN',
    //#COOKIE_PREFIX#
	
	/* redis */
	'REDIS_HOST' => "127.0.0.1",
	'REDIS_AUTH' => "dfr38ck.",
	'REDIS_PORT' => "6379",
];
