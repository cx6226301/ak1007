<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($System_namex); ?></title>
<link href="__PUBLIC__/Css/css/body.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/css/menu.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/css/main.css" rel="stylesheet" media="all" type="text/css" />
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
<script>
//function checkLeave(){
//	window.parent.stateChangeIE();
//}
</script>
</head>
<body>


<div class="ncenter_box0">
<div class="ntr1_left">
<table class="ccdd" cellspacing=0 cellpadding=0 border=0>
     <tbody>
        <tr>
          <td align=right height=15 width="100">会员编号:</td>
        <td align=left><span> <?php echo ($fck_rs['user_id']); ?></span></td></tr>
        <tr>
          <td align=right height=15 width="100">等级:</td>
        <td align=left>[<span style="color:red"><?php echo (getdengji($fck_rs['user_id'])); ?></span>]</td></tr>
        <tr>
          <td align=right height=15>总奖金:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['zjj']); ?></span></td></tr>
        <tr>
          <td align=right height=15>报单币:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_cash']); ?></span></td></tr>
        <tr>
          <td align=right height=15>金币账户:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_use']); ?></span></td></tr>
        <tr>
          <td align=right height=15>金种子账户:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_zz']); ?></span></td></tr>
        <tr>
          <td align=right height=15>今日获得金币:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_use_mr']); ?></span></td></tr>
        <tr>
          <td align=right height=15>今日获得种子:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_zz_mr']); ?></span></td></tr>
        
    <!--    <tr>
          <td align=right height=20>储蓄账户:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_qb']); ?></span></td></tr>
        <tr>
          <td align=right height=20>现金钱包:</td>
        <td align=left><span>￥ <?php echo ($fck_rs['agent_xianjin']); ?></span></td></tr>
        <tr>
          <td align=right height=20>电子股:</td>
        <td align=left><span><?php echo ($fck_rs['live_gupiao']); ?></span></td></tr>
        <tr>
          <td align=right height=20>原始股:</td>
        <td align=left><span><?php echo ($fck_rs['yuan_gupiao']); ?></span></td></tr>-->
    </tbody></table>


</div>
<div class="ntr1_right"></div>

</div>
<div class="ncenter_box1">
<div class="ntr1_left1">
 <div class="miandgengd1"><a href="__APP__/News/index/">更多...</a></div>
<div class="bar_cont1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php if(is_array($t_list)): $i = 0; $__LIST__ = $t_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td style="border-bottom:1px dotted #ccc!important;">&nbsp;&nbsp;<img src="__PUBLIC__/Images/li.gif">&nbsp;&nbsp;[<font color="#FF0000">新闻公告</font>]&nbsp;&nbsp;<a href="__APP__/Public/News_show/NewID/<?php echo ($vo["id"]); ?>"><?php echo (mysubstr(nohtml($vo['title']),"10")); ?></a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            </div>



</div>
<div class="ntr1_rigkj">
 <ul>
<li> <div class="utri1"></div><div class="titel2"><a href="__APP__/Public/cody/c_id/2">修改密码</a></div><div class="jeisd"></div></li>
<li> <div class="utri1"></div><div class="titel2"><a href="__APP__/Tree/cody/c_id/6">推荐关系图</a></div><div class="jeisd"></div></li>
<!--<li> <div class="utri1"></div><div class="titel2"><a href="__APP__/Tree/cody/c_id/5">系统架构图</a></div><div class="jeisd"></div></li>-->
<li> <div class="utri1"></div><div class="titel2"><a href="__APP__/Public/cody/c_id/3">账户查询</a></div><div class="jeisd"></div></li>
<li> <div class="utri1"></div><div class="titel2"><a href="__APP__/Fck/cody/c_id/10">充值申请</a></div><div class="jeisd"></div></li>
    
 </ul>
</div>


</div>

<div class="ncenter_box2">
<div class="ntr1_left2">


</div>
<div class="ntr1_rigkj2">
 <div class="miandgengd"><a href="__APP__/News/index/">更多...</a></div>
<div class="bar_cont">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php if(is_array($f_list)): $i = 0; $__LIST__ = $f_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td style="border-bottom:1px dotted #ccc!important;">&nbsp;&nbsp;<img src="__PUBLIC__/Images/li.gif">&nbsp;&nbsp;[<font color="#FF0000">新闻公告</font>]&nbsp;&nbsp;<a href="__APP__/Public/News_show/NewID/<?php echo ($vo["id"]); ?>"><?php echo ($vo['title']); ?></a>&nbsp;&nbsp;<font color='#999999'>[<?php echo (date('Y-m-d',$vo["create_time"])); ?>]</font></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            </div>

</div>

</div>






<!--<div class="ncenter_box">
<div class="accounttitle"><h1>我的信息 </h1></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="bor">
    <th width="20%" align="right">账户名称：</th>
    <td width="30%" align="left"><?php echo ($fck_rs['user_id']); ?></td>
    <th width="10%" align="right">上次登录：</th>
    <td width="40%" align="left"><?php echo (date("Y-m-d H:i:s",$fck_rs['last_login_time'])); ?></td>
  </tr>
  <tr class="bor">
    <th align="right">推荐人数：</th>
    <td align="left"><?php echo ($fck_rs['re_nums']); ?>人</td>
    <th align="right">注册时间：</th>
    <td align="left"><?php echo (date("Y-m-d H:i:s",$fck_rs['rdt'])); ?></td>
  </tr>
  <tr class="bor">
    <th align="right">会员级别：</th>
    <td align="left"><?php echo ($voo[$fck_rs['u_level']]); ?></td>
    <th align="right">开通时间：</th>
    <td align="left"><?php echo (date("Y-m-d H:i:s",$fck_rs['pdt'])); ?></td>
  </tr>
  <tr class="bor">
    <th align="right">电子币账户余额：</th>
    <td align="left"><?php echo ($fck_rs['agent_use']); ?></td>
    <th align="right">电子账户余额：</th>
    <td align="left"><?php echo ($fck_rs['agent_cash']); ?></td>
  </tr>
  <tr class="bor">
    <th align="right">创业基金账户：</th>
    <td align="left"><?php echo ($fck_rs['agent_xf']); ?></td>
    <th align="right">分红奖金池：</th>
    <td align="left"><?php echo ($all_money); ?></td>
  </tr>
  <tr class="bor2">
    <th align="right">推广链接：</th>
    <td colspan="3"><a href="http://<?php echo ($server); ?>/Reg/us_reg/rid/<?php echo ($fck_rs['id']); ?>/" target="_blank"><span id="copyurl" style="cursor:hand;" title="打开">http://<?php echo ($server); ?>/Reg/us_reg/rid/<?php echo ($fck_rs['id']); ?>/</span></a></td>
  </tr>
</table>
</div>
<br />
<div class="ncenter_box">
<div class="accounttitle"><h1>新闻公告 </h1></div>
<table width="100%" border="0" cellspacing="3" cellpadding="0" class="tab5">
  <?php if(is_array($f_list)): $i = 0; $__LIST__ = $f_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    <td height="28">&nbsp;&nbsp;<img src="__PUBLIC__/Images/news_li.gif">&nbsp;&nbsp;<a href="__APP__/News/News_show/NewID/<?php echo ($vo["id"]); ?>"><?php echo ($vo['title']); ?></a>&nbsp;&nbsp; <span style="color:#999">[<?php echo (date("m/d/Y H A",$vo['create_time'])); ?>]</span></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>-->
</body></html>