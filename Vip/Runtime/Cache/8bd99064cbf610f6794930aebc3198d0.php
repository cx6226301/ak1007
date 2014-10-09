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

<div class="ncenter_box">
<div class="accounttitle"><h1>账户查询 </h1></div>
    <table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="18%" align="right">账户名称：</td>
                <td width="82%" align="left"><?php echo ($rs['user_id']); ?></td>
              </tr>
			  <tr>
                <td width="18%" align="right">推荐人数：</td>
                <td width="82%" align="left"><?php echo ($rs['re_nums']); ?>人</td>
              </tr>
              <tr>
                <td align="right">会员级别：</td>
                <td align="left"><?php echo ($u_level); ?></td>
              </tr>
              <tr>
                <td align="right">总 奖 金：</td>
                <td align="left"><?php echo ($rs['zjj']); ?></td>
              </tr>
              <tr>
                <td align="right">报单币：</td>
                <td align="left"><?php echo ($rs['agent_cash']); ?></td>
              </tr>
              <tr>
                <td align="right">金币账户：</td>
                <td align="left"><?php echo ($rs['agent_use']); ?></td>
              </tr>
              <tr>
                <td align="right">金种子账户：</td>
                <td align="left"><?php echo ($rs['agent_zz']); ?></td>
              </tr>
              <tr style="display:none">
                <td align="right">开通币余额：</td>
                <td align="left"><?php echo ($rs['agent_kt']); ?></td>
              </tr>
              <tr style="display:none">
                <td align="right">重消币余额：</td>
                <td align="left"><?php echo ($rs['agent_xf']); ?></td>
              </tr>
              <tr style="display:none">
                <td align="right">股权兑换币：</td>
                <td align="left"><?php echo ($rs['agent_gp']); ?></td>
              </tr>
              <tr style="display:none">
                <td align="right">持股数量：</td>
                <td align="left"><?php echo ($rs['agent_gp']); ?></td>
              </tr>
              
            </table>
</div>
</body>
</html>