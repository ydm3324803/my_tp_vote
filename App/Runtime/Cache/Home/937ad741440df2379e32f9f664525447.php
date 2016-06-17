<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="__PUBLIC__/js/jquery-1.7.1.min.js" type="text/javascript"></script>
</head>
<body>

组别:
<?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" name="group" value="<?php echo ($vo['id']); ?>" /><?php echo ($vo['title']); ?><?php endforeach; endif; else: echo "" ;endif; ?>

<br/>

类型:
<?php if(is_array($typelist)): $i = 0; $__LIST__ = $typelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" name="type" value="<?php echo ($vo['id']); ?>" /><?php echo ($vo['title']); ?><?php endforeach; endif; else: echo "" ;endif; ?>

<br/>
作品名称 <input name="title" type="text" /><br/>
作者名称 <input name="name" type="text" /><br/>
作者年龄 <input name="age" type="text" /><br/>
地区:
<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" name="city" value="<?php echo ($vo['id']); ?>" /><?php echo ($vo['title']); ?><?php endforeach; endif; else: echo "" ;endif; ?>
<br/>
指导老师 <input name="teacher" type="text" /><br/>
参赛单位名称 <input name="entry_mame" type="text" /><br/>
作者监护人<input name="guardian" type="text" /><br/>
与作者关系<input name="relation" type="text" /><br/>
电话<input name="phone" type="text" /><br/>
地址<input name="address" type="text" /><br/>
邮箱<input name="email" type="text" /><br/>
<form action="<?php echo U('Index/upload?position=avatar');?>" method="post" enctype="multipart/form-data"  target="upframe" id="form_avatar">
作者头像<input name="author_avatar" type="file"  onchange="upload('avatar');"/><br/>
</form>

<form action="<?php echo U('Index/upload?position=work1');?>" method="post" enctype="multipart/form-data"  target="upframe" id="form_work1">
作品1<input name="work_1" type="file" onchange="upload('work1');" /> 
</form>
<input type="text" name="works_1_w" /> x <input type="text" name="works_1_h" /> <br/>

<form action="<?php echo U('Index/upload?position=work2');?>" method="post" enctype="multipart/form-data"  target="upframe" id="form_work2">
作品2<input name="work_2" type="file" onchange="upload('work2');" /> 
</form>
<input type="text" name="works_2_w" /> x <input type="text" name="works_2_h" /> <br/>

验证码<input name="codes" type="text" />
	<img src="<?php echo U('Index/verify');?>" id="verifyImg" onclick="javascript:fleshVerify()"/>
<br/>
<input id="avatar" type="hidden" />
<input id="work1" type="hidden" />
<input id="work2" type="hidden" />
<iframe id="upframe" name="upframe" style="display:none"></iframe>
<button id="submit">提交</button>

<script>
	$(document).ready(function() { 
		$('#submit').click(function(){
			var group = $("input[name=group]:checked").val();
			var type = $("input[name=type]:checked").val();
			var title = $("input[name=title]").val();
			var name = $("input[name=name]").val();
			var age = $("input[name=age]").val();
			var city = $("input[name=city]:checked").val();
			var teacher = $("input[name=teacher]").val();
			var entry_mame = $("input[name=entry_mame]").val();
			var guardian = $("input[name=guardian]").val();
			var relation = $("input[name=relation]").val();
			var phone = $("input[name=phone]").val();
			var address = $("input[name=address]").val();
			var email = $("input[name=email]").val();
			var avatar = $("#avatar").val();
			var work_1 = $("#work1").val();
			var works_1_w = $("input[name=works_1_w]").val();
			var works_1_h = $("input[name=works_1_h]").val();
			var work_2 = $("#work2").val();
			var works_2_w = $("input[name=works_2_w]").val();
			var works_2_h = $("input[name=works_2_h]").val();
			var codes = $("input[name=codes]").val();
			
			$.ajax({
			    url: "<?php echo U('Vote/application');?>",
			    dataType: "json",
			    async: false,
			    data: { 
			    	"group": group,
			    	"type" : type,
			    	"title":title,
			    	"name":name,
			    	"age":age,
			    	"city":city,
			    	"teacher":teacher,
			    	"entry_mame":entry_mame,
			    	"guardian":guardian,
			    	"relation":relation,
			    	"phone":phone,
			    	"address":address,
			    	"email":email,
			    	"avatar":avatar,
			    	"work_1":work_1,
			    	"works_1_w":works_1_w,
			    	"works_1_h":works_1_h,
			    	"work_2":work_2,
			    	"works_2_w":works_2_w,
			    	"works_2_h":works_2_h,
			    	"codes":codes
			    	},
			    type: "post",
			   
			    success: function(req) {
			    	if(req.status == 0){
			    		alert(req.info);
			    		fleshVerify();
			    		return false;
			    	}else{
			    		alert('suess');
			    		fleshVerify();
			    		return false;
			    	}
			    },
			    
			    error: function() {
			    	fleshVerify();
			        alert("网络超时，请重试");
			        return false;
			    }
			});
			
		});
	});
	
	function fleshVerify(type){ 
		var timenow = new Date().getTime();
		if (type){
			document.getElementById('verifyImg').src= '__APP__/Index/verify/adv/1/'+timenow;
		}else{
			document.getElementById('verifyImg').src= '__APP__/Index/verify/'+timenow;
		}
	}
	
	function upload(position){
			$('#form_'+position).submit();
	}
	
	function add(data,position){
		$('#'+position).val(data);
		return false;
	}
	function error(data){
		alert(data);
		return false;
	}
</script>
</body>
</html>