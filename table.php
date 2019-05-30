<?php 
	include('fun.php');
	$se = select('teacher','*');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>数据展示</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="col-xs-10">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="table.php">讲师列表</a></li>
					<li><a href="add.php">添加讲师</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<table class="table table-striped table-bordered table-hover">
		<tr class="info">
			<td>讲师ID</td>
			<td>讲师姓名</td>
			<td>讲师年龄</td>
			<td>状态</td>
			<td>操作</td>
		</tr>
		<?php 
			foreach($se as $v){
		?>
		<tr>
			<td><?php echo $v['id']; ?></td>
			<td><?php echo $v['name']; ?></td>
			<td><?php echo $v['age']; ?></td>
			<td>
				<?php     if($v['status'] == 1){       ?>
					<span class="text-success">在职</span>
				<?php     }else{      ?>
					<span class="text-danger">离职</span>
				<?php     }           ?>
			</td>
			<td><button class="btn btn-danger" onclick="del(<?php echo $v['id']; ?>)">删除</button></td>
		</tr>
		<?php 
			}
		?>
	</table>
</body>
<script type="text/javascript">
	function del(id){
		if(confirm('删除后不能恢复，您确定删除吗？') == true){
			window.location.href="del.php?id="+id;
			return true;
		}
	}
</script>
</html>