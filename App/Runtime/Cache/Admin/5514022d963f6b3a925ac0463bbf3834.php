<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>编辑内容</title>
<link rel="stylesheet" type="text/css" href="__ADMIN__/Public/css/base.css" />
<script src="__ADMIN__/Public/js/jquery-1.7.1.min.js"></script>
<script src="__ADMIN__/Public/js/base.js"></script>
<script src="__ADMIN__/Public/js/97Date/WdatePicker.js"></script>
<!-- layout::Inc:ueditor::0 -->

</head>
<body>
<div class="nav-site">
    <?php getNavSite($nav_site,$_GET['cid']);?> > 编辑内容
</div>
<form action="__APP__/Admin/<?php echo $actionName;?>/saveOne/cid/<?php echo $_GET["cid"];?>" method="post" enctype="multipart/form-data" class="form">
    <input type="hidden" name="id" value="<?php echo ($obj["id"]); ?>">
	<input type="hidden" name="category_id" value="<?php echo $_GET["cid"];?>">
	<input type="hidden" name="hardware" value="<?php echo ($_SESSION['hardware']); ?>">
	<input type="hidden" name="lang" value="<?php echo $_GET["lang"];?>">
	<input type="hidden" name="imgwidth" value="300">
	<input type="hidden" name="imgheight" value="300">
    <fieldset>
        <ul class="align-list">
        	<li>
               <label>当前分类</label>
               <?php getCurCategoryNav($_GET['cid']);?>
           </li>
            <li style="display:none;">
                <label>正文标题</label>
                <input type="text" id="title" name="title" value="<?php getCategoryTitle($_GET['cid']);?>" class="type-text">
            </li>
            <li>
                <label>正文描述</label>
 
				<textarea id="content" name="content" style="margin-left:200px;margin-left: 140px;margin-top: -25px;margin-bottom: 10px;"><?php echo (htmlspecialchars_decode($obj["content"])); ?></textarea>

                <script type="text/javascript">
                    var editor = new baidu.editor.ui.Editor();
                    editor.render("content");
                </script>
            </li>
			<li>
           		<label for="more_home">首页设置</label>
				<input type="checkbox" id="more_home"> <small class="fc-999"> --如果这篇文章在首页设置了栏目摘要说明，请在这里填写</small>
		   </li>
            <div id="more_options_box" class="more-box hide">
                <li>
                    <label>正文摘要</label>
                    <textarea id="summary" name="summary" cols="100" rows="3"><?php echo ($obj["summary"]); ?></textarea>
                </li>
                <li>
                    <label>正文插图</label>
                    <?php if( !empty($obj['image']) ) { ?>
                    <span id="span_image">
                    <img alt="" align="middle" height="80" vspace="5" src="<?php echo __ROOT__.'/Public/images/news/s_'.$obj['image']; ?>"> <a href="javascript:void(0)" id="delete_image" style="color:red;text-decoration:underline;">删除封面</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <?php } ?>
                    <input type="file" name="image">
                </li>
            </div>
            <li>
	           	<label for="more_seo">SEO优化</label>
				<input type="checkbox" id="more_seo"> <small class="fc-999"> --您还可以单独设置这篇文章搜索引擎关键字收录</small>
		    </li>
            <div id="more_seo_box" class="more-box hide">
                <li>
                    <label>页面标题<br>(Title)</label>
                    <input type="text" id="seo_title" name="seo_title" value="<?php echo ($obj["seo_title"]); ?>" class="type-text">
                </li>
                <li>
                    <label>页面关键字<br>(Keywords)</label>
                    <input type="text" id="seo_keywords" name="seo_keywords" value="<?php echo ($obj["seo_keywords"]); ?>" class="type-text">
                </li>
                <li>
                    <label>页面描述<br>(Description)</label>
                    <input type="text" id="seo_description" name="seo_description" value="<?php echo ($obj["seo_description"]); ?>" class="type-text">
                </li>
            </div>
			
			<?php isComment($category['is_comment']);?>

			<?php if( $_SESSION['hardware']=='pc' ) { ?>
            <li id="li_synch_mobile">
                <label for="synch_mobile">手机同步</label>
                <input type="checkbox" name="synch_mobile" id="synch_mobile" value="1"> <small class="fc-999"> --如果手机版对应栏目也有这篇文章，您还可以同步过去</small>
            </li>
			<li id="li_mobile_category">
                <label>手机分类</label>
                <select id="one_mobile_category_id" name="one_mobile_category_id" style="width:200px;" onchange="changeCategory(this,'two_mobile_category_id')">
                	<option value="-1" selected="">请选择手机分类</option>
					<?php selectCateoryOptions($_SESSION['c_root'], 'all');?>
                </select>
            </li>
			<script>$('#li_mobile_category').hide();</script>
			<?php } ?>
            <li>
                <label>现在发布<a href="#" class="issue" title="在网站前台显示">?</a></label>
                <input type="checkbox" id="is_publish" name="is_publish" value="1">
            </li>
			 <li>
                <label></label>
            </li>
            <li>
                <label></label>
                <input type="submit" value="确定并保存" class="button button-green button-big" />
            </li>
        </ul>
    </fieldset>
</form>

<?php
$summary = substr(str_replace('"','',$obj['summary']),0,2);
$seo_title = substr(str_replace('"','',$obj['seo_title']),0,2);
$seo_keywords = substr(str_replace('"','',$obj['seo_keywords']),0,2);
$seo_description = substr(str_replace('"','',$obj['seo_description']),0,2);
?>
<script>
$(function(){

    if ("<?php echo $obj['id'];?>" == '') {
        $("input[name=is_publish]").attr("checked", true);
    } else {
        $("input[name=is_comment][value=<?php echo $obj['is_comment'];?>]").attr("checked", true);
        $("input[name=is_publish][value=<?php echo $obj['is_publish'];?>]").attr("checked", true);
    }
    
    //展开表单元素
    $('#more_home').change(function(){
        if ($(this).is(':checked')) {
            $('#more_options_box').show();
        }
        else {
            $('#more_options_box').hide();
        }
    });
    
    $('#more_seo').change(function(){
        if ($(this).is(':checked')) {
            $('#more_seo_box').show();
        }
        else {
            $('#more_seo_box').hide();
        }
    });

	var summary="<?php echo ($summary); ?>";
	var image = "<?php echo $obj['image'];?>";
    if (summary != '' || image != '') {
        $('#more_home').attr('checked', true);
        $('#more_home').trigger('change');
    }
    var seo_title = "<?php echo ($seo_title); ?>";
	var seo_keywords = "<?php echo ($seo_keywords); ?>";
	var seo_description = "<?php echo ($seo_description); ?>";
    if (seo_title != '' || seo_keywords != '' || seo_description != '') {
        $('#more_seo').attr('checked', true);
        $('#more_seo').trigger('change');
    }
    
    $('#delete_image').click(function(){
        if (confirm('确定要删除封面吗？')) {
            $.get('__APP__/Admin/News/deleteImage', {
                'id': "<?php echo $obj['id']; ?>"
            }, function(bool){
                if (bool == 1) {
                    $('#span_image').css('display', 'none');
                }
            });
        }
    });
	
	$('#synch_mobile').click(function(){
		if( $(this).is(':checked') ) {
			$('#li_mobile_category').show();
		} else {
			$('#li_mobile_category').hide();
		}
	});
    
});

//手机同步
function synchMobile(id){
    if (confirm('同步后会覆盖手机数据，确定吗？')) 
        window.location.href = '__APP__/Admin/News/synchMobile/id/' + id;
}
	
//分类下拉联动---------------------------------------------------------------
function changeCategory(_this,target_id){

	if( target_id=='two_category_id' ) {
		$('#three_category_id').html('');
		$('#three_category_id').append('<option value="-1" selected>请选择</option>');
	}
	
	var id = $(_this).val();
	$.getJSON("__APP__/Admin/Index/selectCategoryByPid",{"pid":id},function(json){
	$('#'+target_id).html('');
	$('#'+target_id).append('<option value="-1" selected>请选择</option>');
	if (json.list != undefined) {
		$(json.list).each(function(i, obj){
			var str_tr = '<option value="' + obj.id + '">' + obj.title + '</option>';
			$('#' + target_id).append(str_tr);
		});
		$('#' + target_id).show();
	}
	else {
		$('#' + target_id).hide();

	}
	});
}
</script>
</body>
</html>