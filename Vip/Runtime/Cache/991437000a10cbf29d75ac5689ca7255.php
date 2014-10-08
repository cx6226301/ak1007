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
<div class="accounttitle"><h1>参数设置 </h1></div>
<form method='post' id="myform" action="__URL__/setParameterSave" >
    &nbsp;
<table width="100%" cellpadding=3 cellspacing=0 border=0 id="tb1" class="tab4">
<tr  class="content_td">
  <td width="15%" >&nbsp;</td>
  <td width="85%">&nbsp;</td>
</tr>
<tr>
				<td align="right">级别：</td>
				<td class="center"><input name="s10" type="text" id="s10" value="<?php echo ($fee_s10); ?>" size="80" maxlength="80" />
                用|分割</td>
</tr>
<tr>
				<td align="right">级别单数：</td>
				<td class="center"><input name="s2" type="text" id="s2" value="<?php echo ($fee_s2); ?>" size="40" maxlength="80" />
                单 用|分割</td>
</tr>
<tr>
				<td align="right">投资金额：</td>
				<td class="center"><input name="s9" type="text" id="s9" value="<?php echo ($fee_s9); ?>" size="40" maxlength="80" />
                元 用|分割</td>
</tr>
<tr>
				<td align="right">日分红：</td>
				<td class="center"> 金币:<input name="str4" type="text" id="str4" value="<?php echo ($fee_str4); ?>" size="8" maxlength="50" /> 种子:<input name="s19" type="text" id="s19" value="<?php echo ($fee_s19); ?>" size="8" maxlength="50" />
                元</td>
</tr>
<tr>
				<td align="right">日分红封顶：</td>
				<td class="center"><input name="s6" type="text" id="s6" value="<?php echo ($fee_s6); ?>" size="8" maxlength="12" />
                元</td>
</tr>
<tr>
				<td align="right">直推奖：</td>
				<td class="center"><input name="s3" type="text" id="s3" value="<?php echo ($fee_s3); ?>" size="8" maxlength="50" />
                百分比</td>
</tr>
<tr style="display:none">
				<td align="right">领导奖：</td>
				<td class="center"><input name="s1" type="text" id="s1" value="<?php echo ($fee_s1); ?>" size="8" maxlength="50" />
                百分比</td>
</tr>
<tr>
				<td align="right">领导奖：</td>
				<td class="center">金币:<input name="s12" type="text" id="s12" value="<?php echo ($fee_s12); ?>" size="8" maxlength="50" />
                   &nbsp;&nbsp;&nbsp;种子:<input name="s5" type="text" id="s5" value="<?php echo ($fee_s5); ?>" size="8" maxlength="80" /></td>
</tr>



<tr>
				<td align="right">报单中心条件：</td>
				<td class="center"><input name="str2" type="text" id="str2" value="<?php echo ($fee_str2); ?>" size="8" maxlength="50" />
                单</td>
</tr>
<tr>
				<td align="right">报单奖：</td>
				<td class="center"><input name="s7" type="text" id="s7" value="<?php echo ($fee_s7); ?>" size="8" maxlength="12" />
                百分比</td>
</tr>

<tr>
				<td align="right">奖金转换：</td>
				<td class="center">
                                    金币:<input name="s15" type="text" id="s15" value="<?php echo ($fee_s15); ?>" size="8" maxlength="80" />百分比&nbsp;&nbsp;
                                    金种子:<input name="s14" type="text" id="s14" value="<?php echo ($fee_s14); ?>" size="8" maxlength="80" />
                百分比</td>
</tr>
<tr>
				<td align="right">金种子增位：</td>
				<td class="center"><input name="s13" type="text" id="s13" value="<?php echo ($fee_s13); ?>" size="8" maxlength="12" />
                个</td>
</tr>


<tr>
				<td align="right" style='color:red'>弃户日：</td>
				<td class="center"><input name="s11" type="text" id="s11" value="<?php echo ($fee_s11); ?>" size="8" maxlength="12" />
              天  </td>
</tr>
<tr>
				<td align="right">奖名称：</td>
				<td class="center"><input name="s18" type="text" id="s18" value="<?php echo ($fee_s18); ?>" size="80" maxlength="80" /> 用| 分割</td>
</tr>
<tr>
				<td align="right">转账手续费：</td>
				<td class="center"><input name="s4" type="text" id="s4" value="<?php echo ($fee_s4); ?>" size="8" maxlength="12" />
                百分比</td>
</tr>
<tr>
				<td align="right">最低提现额度：</td>
				<td class="center"><input name="s16" type="text" id="s16" value="<?php echo ($fee_s16); ?>" size="8" maxlength="12" /> 元 </td>
</tr>
<tr>
				<td align="right">提现手续费：</td>
				<td class="center"><input name="s8" type="text" id="s8" value="<?php echo ($fee_s8); ?>" size="8" maxlength="12" />
                百分比</td>
</tr>
<tr>
				<td align="right">转账最低额度：</td>
				<td class="center"><input name="str3" type="text" id="str3" value="<?php echo ($fee_str3); ?>" size="8" maxlength="12" /> 元</td>
</tr>
<tr style="display:none">
            <td colspan="3" style="height:5px;"><hr></td>
</tr>



<tr>
            <td colspan="3" style="height:5px;"><hr></td>
</tr>
<tr>
    <td align="right">开户银行：</td>
    <td><span class="tLeft"><textarea name="str29" cols="60" rows="5" id="str29"><?php echo ($fee_str29); ?></textarea>
    每家银行间用|分割</span></td>
</tr>
<tr>
    <td align="right">汇款信息：</td>
    <td><span class="tLeft">
      <textarea name="s17" cols="60" rows="5" id="s17"><?php echo ($fee_s17); ?></textarea>
    </span></td>
</tr>
<tr>
    <td align="right">会员注册成功信息：</td>
    <td><span class="tLeft">
      <textarea name="str28" cols="60" rows="5" id="str28"><?php echo ($fee_str28); ?></textarea>
    </span></td>
</tr>
<tr style="display:none">
    <td align="right">密保问题：</td>
    <td><span class="tLeft">
      <textarea name="str99" cols="60" rows="6" id="str99"><?php echo ($fee_str99); ?></textarea>
    每个问题用|分割</span></td>
</tr>
<tr>
            <td colspan="3" style="height:5px;"><hr></td>
</tr>
<tr>
				<td align="right">登录设置：</td>
				<td class="center">
				<input type="radio" name="i1" id="i1" value="0" <?php if(($fee_i1) == "0"): ?>checked<?php endif; ?>  class="ipt_radi" />
				允许
				<input type="radio" name="i1" id="i1" value="1" <?php if(($fee_i1) == "1"): ?>checked<?php endif; ?>  class="ipt_radi" />
				不允许 <span class="stytle1">(是否允许一个用户同时多人在线！)</span>
				</td>
</tr>
<tr style="display:none">
  <td align="right">前台修改资料权限：</td>
  <td class="center">
  <input type="radio" name="i2" id="i2" value="1" class="btn1"  <?php if(($fee_i2) == "1"): ?>checked=<?php endif; ?> class="ipt_radi"/>
    开启
  <input type="radio" name="i2" id="i2" value="0" class="btn1" <?php if(($fee_i2) == "0"): ?>checked<?php endif; ?> class="ipt_radi"/>
    关闭
	</td>
</tr>
<tr>
  <td align="right">前台设置：</td>
  <td class="center"><input name="i3" type="radio" id="i3" value="0" <?php if(($fee_i3) == "0"): ?>checked<?php endif; ?> class="ipt_radi"/>
    开启
      <input type="radio" name="i3" id="i3" value="1" <?php if(($fee_i3) == "1"): ?>checked<?php endif; ?> class="ipt_radi"/>
      关闭 <span class="stytle1">(关闭前台会员登录！)</span></td>
</tr>
<tr style="display:none">
  <td align="right">网络图开关：</td>
  <td class="center"><input name="i4" type="radio" id="i4" value="0" <?php if(($fee_i4) == "0"): ?>checked<?php endif; ?> class="ipt_radi"/>
    开启
      <input type="radio" name="i4" id="i4" value="1" <?php if(($fee_i4) == "1"): ?>checked<?php endif; ?> class="ipt_radi"/>
      关闭 <span class="stytle1">(开启/关闭网络图！)</span></td>
</tr>
<tr>
				<td align="right">&nbsp;</td>
				<td class="center">&nbsp;</td>
</tr>
<tr>
  <td></td>
  <td class="center">
    <input type="submit" value="修改" class="button_text">
    <input type="reset" value="还原" class="button_text"></td>
</tr>
</table>
</form>
</div>
</body>
</html>