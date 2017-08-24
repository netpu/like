<?php echo $__env->make('commter.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick='admin_add("添加管理员","<?php echo e(url('add0')); ?>","800","500")' class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> <a href="<?php echo e(url('list2')); ?>"class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 回收站</a></span>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="10">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">登录名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th>角色</th>
				<th>头像</th>
				<th width="130">加入时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if($str!=""): ?>
			<?php $__currentLoopData = $str; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr class="text-c">
					<td><input type="checkbox" value="<?php echo e($value->id); ?>" name=""></td>
					<td><?php echo e($value->id); ?></td>
					<td><?php echo e($value->name); ?></td>
					<td><?php echo e($value->shouji); ?></td>
					<td><?php echo e($value->email); ?></td>
					<td><?php echo e($value->qx); ?></td>
					<td><img src="<?php echo e($value->logo); ?>" width="50" alt=""></td>
					<td><?php echo e($value->created_at); ?></td>
					<?php if($value->qiy==0): ?>
					<td class="td-status"><span class="label label-success radius">已启用</span></td>
					<td class="td-manage">
						<a style="text-decoration:none" onClick="admin_stop(this,<?php echo e($value->id); ?>)" href="javascript:;" title="停用">
							<i class="Hui-iconfont">&#xe631;</i>
						</a>
					<?php else: ?>
					<td class="td-status"><span class="label label-default radius">已禁用</span></td>
					<td class="td-manage">
						<a onClick="admin_start(this,<?php echo e($value->id); ?>)" href="javascript:;" title="启用" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe615;</i>
						</a>
					<?php endif; ?>
						<a title="编辑" href="javascript:;" onclick='admin_edit("管理员编辑","<?php echo e(url('edit0'.$value->id)); ?>","1","800","500")' class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6df;</i>
						</a>
						<a title="删除" href="javascript:;" onclick="admin_del(this,<?php echo e($value->id); ?>,<?php echo e($value->del); ?>)" class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6e2;</i>
						</a>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
			<tr>
				<th scope="col" colspan="10">这儿什么也没有哦～</th>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
</div><?php echo e($str->links()); ?>

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
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id,del){
	if(del!=0){
		layer.confirm('确认要还原吗？',function(index){
			//此处请求后台程序，下方是成功后的前台处理……
			$(obj).parents("tr").remove();
			$.get("<?php echo e(url('destroy')); ?>", {id:id,del:del}, function(data) {
				if(data!=0){
					layer.msg('已还原!',{icon:1,time:1000});
				}else{
					layer.msg('还原失败!',{icon:1,time:1000});
				}
			});
		});
	}else{
		layer.confirm('确认要删除吗？',function(index){
			//此处请求后台程序，下方是成功后的前台处理……
			$(obj).parents("tr").remove();
			$.get("<?php echo e(url('destroy')); ?>", {id:id,del:del}, function(data) {
				if(data!=0){
					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:1,time:1000});
				}
			});
		});
	}
	
}
/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已停用</span>');
		$(obj).remove();
		$.get("<?php echo e(url('update')); ?>", {id:id,ad:2}, function(data) {
			if(data!=0){
				layer.msg('已停用!',{icon: 5,time:1000});
			}else{
				layer.msg('停用失败!',{icon: 5,time:1000});
			}
		});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……	
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		$.get("<?php echo e(url('update')); ?>", {id:id,ad:1}, function(data) {
			if(data!=0){
				layer.msg('已启用!',{icon: 5,time:1000});
			}else{
				layer.msg('启用失败!',{icon: 5,time:1000});
			}
		}); 
	});
}
</script>
</body>
</html>