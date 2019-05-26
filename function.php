<?php 
	$arr = array(
		'type' => 'mysql',
		'host' => '127.0.0.1',
		'charset' => 'utf8',
		'port' => 3306,
		'name' => 'ouyangke',
		'user' => 'root',
		'pass' => 'root'
	);
	// mysql:host=127.0.0.1;dbname=ouyangke;charset=utf8;port=3306;
	$db = "{$arr['type']}:host={$arr['host']};
			dbname={$arr['name']};
			charset={$arr['charset']};
			port={$arr['port']}";
	$root = $arr['user'];
	$pass = $arr['pass'];

	$a = new PDO($db,$root,$pass);

	$sql = "SELECT	* FROM	`teacher` WHERE	`age` < 20";
	// 创建PDO预处理
	$b = $a->prepare($sql);
	// 执行一条sql语句，是成功或失败
	$c = $b->execute();
	// 返回SQL语句影响行数
	$d = $b->rowCount();
	// 设置默认的获取模式
	$e = $b->setFetchMode(PDO::FETCH_ASSOC);
	// 返回结果集
	$f = $b->fetchAll();
	print_r($f);