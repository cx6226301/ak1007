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

<script type="text/javascript" src="__PUBLIC__/Js/Ajax/ThinkAjax-1.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/UserJs.js"></script>
<script language='javascript'>
function CheckForm(){
	if(document.form1.ePoints.value==""){
		alert("金额不能为空！");
		return false;
	}
	if(document.form1.select.value==1){
		if(confirm('您确定把 '+document.form1.ePoints.value+' 转借给会员（'+document.form1.UserID.value+'）吗？'))
		{
			return true;
		}else{
			alert('您取消了本次操作');
			return false;
		}
	}
}

function yhServer(Ful){
	str = $F(Ful).replace(/^\s+|\s+$/g,"");
	ThinkAjax.send('__URL__/check_CCuser/','ajax=1&userid='+str,'',Ful+'1');
}
</script>
<div class="ncenter_box">
<div class="accounttitle"><h1>账户转账 </h1></div>&nbsp;
    <form name="form1" method="post" action="__URL__/transferMoneyAC" onSubmit="{return CheckForm();}">
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
          <tr>
            <td align="right">金币： </td>
            <td colspan="2" width="80%"><span class="hong"><?php echo ($rs["agent_use"]); ?></span></td>
          </tr>
		  <tr>
            <td align="right">报单币： </td>
            <td colspan="2" width="80%"><span class="hong"><?php echo ($rs["agent_cash"]); ?></span></td>
          </tr>
          <tr>
            <td align="right">类型：</td>
            <td colspan="2">
            <select name="select" id="select" onchange="Selev(this.value)" onpropertychange="Selev(this.value)">
              <option value="1"> 金币 转给 其它会员 </option>
              <option value="2"> 金币 转 报单币 </option>
              <!--<option value="3"> 报单币 转给 其他会员  </option>-->
            </select>
            </td>
          </tr>
          <tr id="Selev">
            <td align="right"><?php echo ($User_namex); ?>：</td>
            <td><input name="UserID" type="text" id="UserID" class="ipt" onblur="javascript:yhServer(this.name);" onfocus="notice('0','')" /></td>
            <td><div id="UserID1" class="info"><div id="0" class="focus_r" style="display:none;"><div class="msg_tip">请输入你要转给会员的编号。</div></div></div></td>
          </tr>
          <tr>
            <td align="right">金额：</td>
            <td><input name="ePoints" type="text" id="ePoints" class="ipt" onkeyup="javascript:Null_Int(this.name)" onfocus="notice('1','')"  onblur="notice('1','none')"/></td>
            <td><div id="ePoints1" class="info"><div id="1" class="focus_r" style="display:none;"><div class="msg_tip">请输入你要转入的金额。</div></div></div></td>
          </tr>
          <tr>
            <td align="right">说明：</td>
            <td colspan="2"><textarea name="content" cols="40" rows="4" id="content"></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><input type="submit" name="Submit" value="确定转账" class="button_text" /></td>
          </tr>
         
      </table>
      </form>
<br>
<table width="100%" class="tab3" border="0" cellpadding="3" cellspacing="1" id="tb1" bgcolor="#b9c8d0">
	<thead>
		<tr>
			<th><span>借方<?php echo ($User_namex); ?></span></th>
			<th><span>贷方<?php echo ($User_namex); ?></span></th>
			<th><span>时间</span></th>
			<th><span>交易额</span></th>
            <th><span>类型</span></th>
            <th><span>说明</span></th>
		</tr>
	</thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
		<td><?php echo ($vo['out_userid']); ?></td>
		<td><?php echo ($vo['in_userid']); ?></td>
		<td><?php echo (date('Y-m-d H:i:s',$vo['rdt'])); ?></td>
		<td><?php echo ($vo['epoint']); ?></td>
        <td><?php if(($vo['type']) == "1"): ?>金币转给其它会员<?php else: endif; ?>
        	<?php if(($vo['type']) == "2"): ?>金币转报单币<?php else: endif; ?>
        	<?php if(($vo['type']) == "3"): ?>报单币转给其它会员<?php else: endif; ?>
        	<?php if(($vo['type']) == "4"): ?>电子币购买电子股<?php else: endif; ?>
        </td>
        <td><?php echo ($vo['sm']); ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td align="center"><?php echo ($page); ?></td>
    </tr>
</table>
</div>
</body>
</html>
<script language="javascript">
function Selev(o){
	if(o==1||o==3){document.getElementById('Selev').style.display = '';}
	if(o==2||o==4){document.getElementById('Selev').style.display = 'none';}
}
new TableSorter("tb1");
</script>