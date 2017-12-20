<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'pdo', // 数据库类型
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	// 'DB_PREFIX' => 'shop_', // 数据库表前缀
	'DB_PREFIX' => '',
	'DB_DSN'    => 'mysql:host=localhost;dbname=lzshoa_db;charset=utf8',
	'URL_HTML_SUFFIX' => 'html',	// 伪静态（就是给URL后面添加后缀名）
	'SHOW_PAGE_TRACE' => false,
	'READ_DATA_MAP'   => true
);