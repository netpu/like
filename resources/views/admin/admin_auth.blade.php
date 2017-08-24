@include('commter.top')
<title>添加管理员 - 管理员管理</title>
</head>
<body>
<article class="page-container">
	<form action="{{url('/store3')}}" class="form form-horizontal" id="form-admin-add" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{old('name')}}" placeholder="" id="name" name="name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否为列表：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="lie" type="radio" id="lie-1" value="0" checked>
				<label for="lie-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="lie-2" name="lie" value="1">
				<label for="lie-2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{old('action')}}" placeholder="" id="action" name="action">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="contro" id="contro" value="{{old('contro')}}">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="route" id="route" value="{{old('route')}}">
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

@include('commter.footer')

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		/*rules:{
			name:{
				required:true,
				minlength:5,
				maxlength:16
			},
			pwd:{
				required:true,
				minlength:6,
				maxlength:16
			},
			pwd2:{
				required:true,
				equalTo: "#pwd"
			},
			lie:{
				required:true,
			},
			action:{
				required:true,
				isaction:true,
			},
			contro:{
				required:true,
				contro:true,
			},
			qx:{
				required:true,
			},
		},*/
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(msg){
				if( msg.status ){
				layer.msg('添加管理员成功！',{icon:1,time:3000},function(){
					parent.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
				});
			}else{
				var info = '';
				for( i in msg.message ){ // 得到是数据是json对象，所以需要遍历这个对象
					info += msg.message[i][0] + '<br>';
				}
				layer.msg(info,{icon:2,time:3000});
			}
			});
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>