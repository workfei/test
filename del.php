<?php 
	include('fun.php');
	if(empty($_GET['id'])){
		echo "<script>alert('未找到用户');window.location.href='table.php';</script>";
		return false;
	}
	// 先查询讲师是否存在
	$find = find('teacher','*','id='.$_GET['id']);
	if(empty($find)){
		echo "<script>alert('未找到用户');window.location.href='table.php';</script>";
		return false;
	}
	// 删除
	$del = delete('teacher','id='.$_GET['id']);
	if($del){
		echo "<script>alert('删除成功');window.location.href='table.php';</script>";
		return false;
	}else{
		echo "<script>alert('删除失败');window.location.href='table.php';</script>";
		return false;
	}