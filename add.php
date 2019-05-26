<?php 
	include('fun.php');
	if(!empty($_POST)){
		if(empty($_POST['user'])){
			echo "<script>alert('请输入姓名');window.history.back(1);</script>";
			return false;
		}
		if(empty($_POST['age'])){
			echo "<script>alert('请输入年龄');window.history.back(1);</script>";
			return false;
		}
		if(empty($_POST['status']) && $_POST['status'] != 0){
			echo "<script>alert('请选择状态');window.history.back(1);</script>";
			return false;
		}
		$data = array(
			'name' => $_POST['user'],
			'age'  => $_POST['age'],
			'status' => $_POST['status']
		);
		$add = insert('teacher',$data);
		if($add){
			echo "<script>alert('添加成功');window.location.href='table.php';</script>";
			return false;
		}else{
			echo "<script>alert('添加失败');window.location.href='add.php';</script>";
			return false;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加数据</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="col-xs-6">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="table.php">讲师列表</a></li>
					<li class="active"><a href="add.php">添加讲师</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<form method="post" action="">
		<div class="form-group">
			<label for="user">姓名</label>
			<input type="text" class="form-control" id="user" name="user" placeholder="请输入姓名">
		</div>
		<div class="form-group">
			<label for="age">年龄</label>
			<input type="text" class="form-control" id="age" name="age" placeholder="请输入年龄">
		</div>
		<div class="form-group">
			<label for="status">状态</label>
			<select class="form-control" id="status" name="status">
				<option value="" selected="selected">请选择</option>
				<option value="1">在职</option>
				<option value="0">离职</option>
			</select>
		</div>
		<button type="submit" class="btn btn-info">添加讲师</button>
	</form>
</body>
</html>