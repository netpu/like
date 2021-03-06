﻿<?php echo $__env->make('commter.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<title>权限管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" method="post" action="" target="_self">
			<input type="text" class="input-text" style="width:250px" placeholder="权限名称" id="" name="">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','<?php echo e(url('add2')); ?>','','310')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span></div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="8">权限节点</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="40">父级ID</th>
				<th width="80">权限名称</th>
				<th>方法</th>
				<th>控制器</th>
				<th>路由</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $__currentLoopData = $str; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo e($value->auth_id); ?>" name=""></td>
				<td><?php echo e($value->auth_id); ?></td>
				<td><?php echo e($value->qx_id); ?></td>
				<td><?php echo e($value->auth_name); ?></td>
				<td><?php echo e($value->auth_action); ?></td>
				<td><?php echo e($value->auth_controller); ?></td>
				<td><?php echo e($value->auth_route); ?></td>
				<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑','admin-permission-add.html','1','','310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>
<?php echo $__env->make('commter.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function admin_permission_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
</script>
</body>
</html>