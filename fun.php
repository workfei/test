<?php 
/**
 * 数据库连接
 * @param $db
 * @return PDO
 */




function connect()
{
	$db = array(
		'charset' => 'utf8',
		'port' => '3306',
		'type' => 'mysql',
		'host' => '127.0.0.1',
		'user' => 'root',
		'pass' => 'root',
		'name' => 'ouyangke'
	);
	$dsn = "{$db['type']}:host={$db['host']}; dbname={$db['name']}; charset={$db['charset']}; port={$db['port']}";//数据源
	try {
		//实例化PDO类,创建PDO对象
		$pdo = new PDO($dsn,$db['user'],$db['pass']);
	} catch (PDOException $e) {
		die('数据库错误:'.$e->getMessage());
	}
	return $pdo;
}
/**
 * 查询多条记录
 * @param $db
 * @param $table
 * @param $fields
 * @param string $where
 * @return array
 */
function select($table,$fields, $where='', $order='',$limit='') {
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql = 'SELECT ';
	if (is_array($fields)) {
		foreach ($fields as $field) {
			$sql .= $field.', ';
		}
	} else {
		$sql .= $fields;
	}
	$sql = rtrim(trim($sql),',');
	$sql .= '  FROM '.$table;
	//查询条件
	if(!empty($where)){
		$sql .= ' WHERE '.$where;
	}
	//排序条件
	if(!empty($order)) {
		$sql .= ' ORDER BY '.$order;
	}
	//分页条件
	if(!empty($limit)) {
		$sql .= ' LIMIT '.$limit;
	}
	$sql .= ';';
	//创建PDO预处理对象，执行sql语句，返回PDO对象
	$stmt = $pdo->prepare($sql);
	//执行查询操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			//返回一个二维数组
			return $stmt->fetchAll();
		}
	} else {
		return false;
	}
}
/**
 * 查询单条记录
 * @param $db
 * @param $table   表名
 * @param $fields  返回值 *
 * @param string $where  条件
 * @return array
 */
function find($table,$fields,$where='') {
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql = 'SELECT ';
	if (is_array($fields)) {
		foreach ($fields as $field) {
			$sql .= $field.', ';
		}
	} else {
		$sql .= $fields;
	}
	$sql = rtrim(trim($sql),',');

	$sql .= ' FROM '.$table;
	//查询条件
	if(!empty($where)){
		$sql .= ' WHERE '.$where;
	}
	$sql .= ' LIMIT 1;';
	//创建PDO预处理对象
	$stmt = $pdo->prepare($sql);
	//执行查询操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
	} else {
		return false;
	}
}
/**
 * 新增数据
 * @param $db
 * @param $table
 * @param $data
 * @return bool
 */
function insert($table,$data=[]){
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql = "INSERT INTO {$table} SET ";
	//组装插入语句
	if(is_array($data)){
		foreach ($data as $k=>$v) {
			$sql .= $k.'="'.$v.'", ';
		}
	}else{
		return false;
	}
	//去掉尾部逗号,并添加分号结束
	$sql = rtrim(trim($sql),',').';';
	//创建PDO预处理对象
	$stmt = $pdo->prepare($sql);
	//执行新增操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			return true;
		}
	} else {
		return false;
	}
}
/**
 * 更新数据
 * @param $db
 * @param $table
 * @param $data
 * @return bool
 */
function update($table,$data=[], $where='') {
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql = "UPDATE {$table} SET ";
	//组装修改语句
	if(is_array($data)){
		foreach ($data as $k=>$v) {
			$sql .= $k.'="'.$v.'", ';
		}
	}
	//去掉尾部逗号,并添加分号结束
	$sql = rtrim(trim($sql),',');
	//查询条件
	if(!empty($where)){
		$sql .= ' WHERE '.$where;
	}
	//创建PDO预处理对象
	$stmt = $pdo->prepare($sql);
	//执行新增操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			return true;
		}
	} else {
		return false;
	}
}
/**
 * 删除记录
 * @param $db
 * @param $table
 * @param string $where
 * @return bool
 */
function delete($table,$where=''){
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql = "DELETE FROM {$table}  ";
	//查询条件
	if(!empty($where)){
		$sql .= ' WHERE '.$where;
	}
	//创建PDO预处理对象
	$stmt = $pdo->prepare($sql);
	//执行删除操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			return true;
		}
	} else {
		return false;
	}
}
/**
 * 统计数量
 * @param $pdo
 * @param $table
 * @param string $where
 * @return number
 */
function count_num($table,$where){
	//连接pdo
	$pdo = connect();
	//创建SQL语句
	$sql  = 'SELECT count(*) as count_number FROM '.$table;
	//查询条件
	if(!empty($where)){
		$sql .= ' WHERE '.$where;
	}
	//创建PDO预处理对象
	$stmt = $pdo->prepare($sql);
	//执行查询操作
	if($stmt->execute()){
		if($stmt->rowCount()>0){
			$row  = $stmt->fetch(PDO::FETCH_ASSOC);
			$rows = $row['count_number'];
			return $rows;
		}
	} else {
		return false;
	}
}