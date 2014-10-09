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

<link href="__PUBLIC__/jydt/css/main.css" rel="stylesheet" media="screen" type="text/css" />
<script language="JavaScript" src="__PUBLIC__/jydt/js/all.js" type="text/javascript"></script>
<script type="text/javascript">
	function func(obj_val){
		var sx=<?php echo ($str6); ?>/100;
		document.getElementById("shifa").value=parseInt(obj_val)+parseInt(sx*obj_val);
		document.getElementById("shouxufei").value=sx*obj_val;
	}
</script>

<body>
<div class="box">
<div class="box_title"><h1>交易大厅</h1></div>
<div class="box_body">
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" >
	
    <tr>
        <td>
            <form name="forms" method="POST" action="__URL__/jy_AC">
            <table width="98%" align="center" border="0" cellpadding="0" cellspacing="1"> 
                <tr>
                    <td align="right">金币余额：</td>
                    <td><strong style="color:#F00"><?php echo ($fck['agent_use']); ?></strong></td>
                </tr>
                <tr style="display:none">
                    <td align="right">交易费：</td>
                    <td><strong style="color:#F00"><?php echo ($str6); ?>%</strong></td>
                </tr>
                <tr>
                    <td align="right">出售金币：</td>
                    <td><input name="AgentMax" type="text" class="text" value="" onkeyup="func(this.value);"></td>
                </tr>
                <tr>
                    <td align="right">手续费：</td>
                    <td><input name="shouxufei" id="shouxufei" type="text" class="text" value="" readonly="readonly"></td>
                </tr>
                <tr>
                    <td align="right">实扣金币：</td>
                    <td><input name="shifa" id="shifa" type="text" class="text" value="" readonly="readonly"></td>
                </tr>
                
                <tr>
                    <td align="right">二级密码：</td>
                    <td><input name="PWD" type="password" class="text" value=""></td>
                </tr>      
                <tr>
                    <td align="right">&nbsp;</td>
                    <td>
                    <input type="submit" value="出售" name="action" class="st_btn01"  onclick="{if(confirm('确定要进行此操作吗？')){return true;}return false;}">                                    　　　　
                    </td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
    <form name="form0" action="" method="get">
    <tr>
    	<td align="center">
        	<select class="select" name="isp">
                    <option value="" <?php if(($isp) == ""): ?>selected<?php endif; ?>>全部</option>
                <option value="0" <?php if(($isp) == "0"): ?>selected<?php endif; ?>>未交易</option>
                <option value="1" <?php if(($isp) == "1"): ?>selected<?php endif; ?>>已购买</option>
                <option value="2" <?php if(($isp) == "2"): ?>selected<?php endif; ?>>已完成</option>
                <option value="3" <?php if(($isp) == "3"): ?>selected<?php endif; ?>>已取消</option>
            </select>
            <input type="submit" name="submit" value="搜索" class="st_btn01" />
        </td>
    </tr>
    </form>
	<form action="__URL__/confirm_AC" method="post" name="form1">
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                <tr class="headTr">
                    <td><input type="checkbox" name="checkbox" value="checkbox" onClick="SelectAll(document.form1.UID)"/></td>
                    <td>交易时间</td>
                    <td>出售金币</td>
                    <td>实扣金币</td>
                    <td>交易费</td>
                    <td>状态</td>
                    <td>购买人</td>
                    <td>购买时间</td>
                    <td>完成时间</td>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="bodyTr">
                    <td><input type="checkbox" name="UID[]" value="<?php echo ($vo["id"]); ?>" /></td>									
                    <td><?php echo (dates("Y-m-d H:i:s",$vo["time"])); ?></td>
                    <td><?php echo ($vo["agent_use"]); ?></td>
                    <td><?php echo ($vo["zhen_use"]); ?></td>
                    <td><?php echo ($vo["shui_use"]); ?></td>
                    <td><?php echo (check_status($vo["status"])); ?></td>
                    <td><?php echo (check_null($vo["user_id"])); ?></td>
                    <td><?php echo (dates("Y-m-d H:i:s",$vo["before_time"])); ?></td>
                    <td><?php echo (dates("Y-m-d H:i:s",$vo["after_time"])); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                
            </table>
            <div><?php echo ($page); ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<input type="submit" name="action" value="删除" onclick="if(confirm('确定删除吗？')) return true;else return false;" class="st_btn01" />
            <input type="submit" name="action" value="确认" onclick="if(confirm('确认吗？')) return true;else return false;" class="st_btn01" />
        </td>
    </tr>
    <tr style="display:none">
    	<td align="center"><table align="center" border="0" cellpadding="0" cellspacing="0" ><tr><td><form action="?&isp=" method="get"><div class="kuai"><div class="kuai_clean"></div><div class="kuai_float">共2条，每页10条，分1頁<!--，目前显示第1页--></div><div class="kuai_float"><font class="kuai_1">上一页</font><font class='kuai_1'><strong>1</strong></font><font class="kuai_1">下一页</font><input type=hidden name=isp value=""></div><input name="page" class="kuai_float kuai_text" type="text" boder="0" value="1" /><input class="kuai_float kuai_input" type="submit" value="跳转" /><div class="kuai_clean"></div></div></form></td></tr></table></td>
    </tr>
	</form>
    	<form action="__URL__/mairu_AC" method="post" name="form2">
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                <tr class="headTr">
                    <td><input type="checkbox" name="checkbox" value="checkbox" onClick="SelectAll(document.form2.UIDD)"/></td>
                    <td>交易时间</td>
                    <td>出售人</td>
                    <td>交易金额</td>
                    <!--<td>实发金额</td>-->
                    <!--<td>交易费</td>-->
                    <td>联系方式</td>
                    <td>账户类型</td>
                </tr>
                
                <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="bodyTr">
                    <td><input type="checkbox" name="UIDD[]" value="<?php echo ($vo["id"]); ?>" /></td>
                    <td><?php echo (dates("Y-m-d H:i:s",$vo["time"])); ?></td>
                    <td><?php echo (get_user_id($vo["uid"])); ?></td>
                    <td><?php echo ($vo["agent_use"]); ?></td>
                    <!--<td><?php echo ($vo["zhen_use"]); ?></td>-->
                    <!--<td><?php echo ($vo["shui_use"]); ?></td>-->
                    <td>-</td>
                    <td>-</td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="bodyTr" style='color:blue'>
                        <td><?php echo (check_status($vo["status"])); ?></td>
                    <td><?php echo (dates("Y-m-d H:i:s",$vo["time"])); ?></td>
                    <td><?php echo (get_user_id($vo["uid"])); ?></td>
                    <td><?php echo ($vo["agent_use"]); ?></td>
                    <!--<td><?php echo ($vo["zhen_use"]); ?></td>-->
                    <!--<td><?php echo ($vo["shui_use"]); ?></td>-->
                    <td style="text-align: left;">QQ:<?php echo (get_info($vo["uid"],4)); ?><br>电话:<?php echo (get_info($vo["uid"],3)); ?></td>
                    <td style="text-align: left;">银行：<?php echo (get_info($vo["uid"],1)); ?><br>账户：<?php echo (get_info($vo["uid"],2)); ?><br>开户人：<?php echo (get_info($vo["uid"],2)); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div><?php echo ($page3); ?></div>
        </td>
    </tr>
    <tr>
    	<td>
            <input type="submit" name="action" value="买入" onclick="if(confirm('确定买入吗？')) return true;else return false;" class="st_btn01" />
        </td>
    </tr>
    <tr style="display:none">
    	<td align="center"><table align="center" border="0" cellpadding="0" cellspacing="0" ><tr><td><form action="?" method="get"><div class="kuai"><div class="kuai_clean"></div><div class="kuai_float">共0条，每页10条，分頁<!--，目前显示第1页--></div><div class="kuai_float"><font class="kuai_1">上一页</font><font class='kuai_1'><strong>1</strong></font><font class="kuai_1">下一页</font></div><input name="page" class="kuai_float kuai_text" type="text" boder="0" value="1" /><input class="kuai_float kuai_input" type="submit" value="跳转" /><div class="kuai_clean"></div></div></form></td></tr></table></td>
    </tr>
	</form>                      
</table>
</div>
</div>
</body>
</html>