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

<script language=javascript src="__PUBLIC__/Js/wpCalendar.js"></script>
<style type="text/css">
.us_btn{height:27px; line-height:27px; font-size:12px; font-weight:bold; padding:0 10px; text-decoration:underline;}
.STYLE1 {color: #FF0000}
</style>
<div class="ncenter_box">
<div class="accounttitle"><h1>货币流向统计 </h1></div>
&nbsp;
<table width="100%" border="0" cellpadding="0" cellspacing="3">
    <tr>
    <td>
    <form id="form1" name="form1" method="post" action="__URL__/adminmoneyflows">
    开始日期：<input name="S_Date" type="text" id="S_Date" onFocus="showCalendar(this)" readonly value="<?php echo ($S_Date); ?>" />
    &nbsp;&nbsp;
    结算日期：<input name="E_Date" type="text" id="E_Date" onFocus="showCalendar(this)" readonly value="<?php echo ($E_Date); ?>" />
    &nbsp;&nbsp;
    搜索会员：<input name="UserID" type="text" id="UserID" value="<?php echo ($UserID); ?>"/>
    &nbsp;&nbsp;
    <input type="submit" name="Submit" value="查询" class="button_text" /></form></td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="3">
    <tr>
    <td>
    <?php if(($ry) == "0"): ?><span class="us_btn">查看全部</span>
    <?php else: ?>
    <input type="button" name="action" value="查看全部" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/0/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"/><?php endif; ?>
    <?php if(is_array($fee_s7)): $ti = 0; $__LIST__ = $fee_s7;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tt): $mod = ($ti % 2 );++$ti; if(($ti) < "8"): if(($ry) == $ti): ?><span class="us_btn"><?php echo ($tt); ?></span>
    <?php else: ?>
    <input type="button" name="action" value="<?php echo ($tt); ?>" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/<?php echo ($ti); ?>/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
    <?php if(($ry) == "15"): ?><span class="us_btn">全部奖金</span>
    <?php else: ?>
    <input type="button" name="action" value="全部奖金" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/15/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; ?>
    <?php if(($ry) == "18"): ?><span class="us_btn">奖金提现</span>
    <?php else: ?>
    <input type="button" name="action" value="奖金提现" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/18/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; ?>
    <?php if(($ry) == "19"): ?><span class="us_btn">开通会员</span>
    <?php else: ?>
    <input type="button" name="action" value="开通会员" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/19/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; ?>
    <?php if(($ry) == "20"): ?><span class="us_btn">货币转账</span>
    <?php else: ?>
    <input type="button" name="action" value="货币转账" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/20/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; ?>
    <?php if(($ry) == "21"): ?><span class="us_btn">货币充值</span>
    <?php else: ?>
    <input type="button" name="action" value="货币充值" class="button_text" onclick="window.location='__URL__/adminmoneyflows/tp/21/S_Date/<?php echo ($S_Date); ?>/E_Date/<?php echo ($E_Date); ?>/UserID/<?php echo ($UserID); ?>/'"><?php endif; ?>
    </td>
    </tr>
</table>
<table width="100%" cellpadding=3 cellspacing="1" id="tb1" bgcolor="#b9c8d0" class="tab3">
  <tr align="center" class="content_td">
    <th nowrap >操作会员（一）</th>
    <th nowrap >操作会员（二）</th>
    <th nowrap ><span>金额</span></th>
    <th nowrap ><span>时间</span></th>
    <th nowrap ><span>备注</span></th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" class="content_td">
    <td ><?php echo (user_id($vo['uid'])); ?></td>
    <td ><?php echo ($vo['user_id']); ?></td>
    <td ><span class="STYLE1"><?php echo ($vo['epoints']); ?></span></td>
    <td ><?php echo (date('Y-m-d H:i:s',$vo["pdt"])); ?></td>
    <td>
        &nbsp;
         <?php if(($vo['action_type']) == "1"): echo ($fee_s7[0]); endif; ?>
         <?php if(($vo['action_type']) == "2"): echo ($fee_s7[1]); endif; ?>
         <?php if(($vo['action_type']) == "3"): echo ($fee_s7[2]); endif; ?>
         <?php if(($vo['action_type']) == "4"): echo ($fee_s7[3]); endif; ?>
         <?php if(($vo['action_type']) == "5"): echo ($fee_s7[4]); endif; ?>
         <?php if(($vo['action_type']) == "6"): echo ($fee_s7[5]); endif; ?>
         <?php if(($vo['action_type']) == "7"): echo ($fee_s7[6]); endif; ?>
         <!--<?php if(($vo['action_type']) == "8"): ?>税收<?php endif; ?>-->
         <?php if(($vo['action_type']) == "18"): ?>奖金提现<?php endif; ?>
         <?php if(($vo['action_type']) == "19"): ?>开通会员<?php endif; ?>
         <?php if(($vo['action_type']) == "20"): ?>货币转账<?php endif; ?>
         <?php if(($vo['action_type']) == "21"): ?>货币充值<?php endif; ?>
        </td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<table width="600" align="center">
  <tr class="content_td">
    <td colspan="5" ><div align="center"><?php echo ($page); ?></div></td>
    </tr>
</table>
</div>
</body>
</html>
<script>new TableSorter("tb1");</script>