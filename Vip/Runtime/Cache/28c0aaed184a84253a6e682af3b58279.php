<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($System_namex); ?></title>
<link href="__PUBLIC__/Css/body.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/menu.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/main.css" rel="stylesheet" media="all" type="text/css" />
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Base.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/prototype.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/mootools.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Ajax/ThinkAjax.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Form/CheckForm.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/common.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Util/ImageLoader.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/myfocus-1.0.4.min.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/all.js\"></sc"+"ript>")</script>
<script language="JavaScript">
ifcheck = true;
function CheckAll(form)
{
	for (var i=0;i<form.elements.length-2;i++)
	{
		var e = form.elements[i];
		e.checked = ifcheck;
	}
	ifcheck = ifcheck == true ? false : true;
}
</script>
</head>
<body onLoad="loadBar(0)">

<script type="text/javascript" src="__PUBLIC__/Js/tree.js"></script>
<div class="ncenter_box">
<div class="accounttitle"><h1>推荐关系图 </h1></div>

    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tab3">
      <form method='post' action="__URL__/Tree">
      <tr>
        <td><?php echo ($User_namex); ?>：
            <input type="text" name="UserID" title="帐号查询"  >
            <input type="submit" name="Submit" value="查询" class="button_text"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="MzTreeView.prototype.expandAll.call(tree);">展开全部节点</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__URL__/Tree/UID/<?php echo ($ID); ?>">关闭全部节点</a>
        </td>
      </tr>
      </form>
      <tr>
        <td><div id="thisTree" style="padding:15px;"></div></td>
      </tr>
      <tr>
        <td>说明：<img src="__PUBLIC__/Images/tree/center.gif" width="18" height="18" /> 报单中心&nbsp;&nbsp; <img src="__PUBLIC__/Images/tree/Official.gif" width="18" height="18" /> 已开通&nbsp;&nbsp; <img src="__PUBLIC__/Images/tree/trial.gif" width="18" height="18" /> 未开通</td>
      </tr>
    </table>
</div>
</body>
</html>
<?php echo ($rs['0']); ?>