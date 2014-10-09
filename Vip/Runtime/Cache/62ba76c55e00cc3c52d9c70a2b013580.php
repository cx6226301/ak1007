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

<script type="text/javascript" src="__PUBLIC__/Js/UserJs.js"></script>
<div class="ncenter_box">
<div class="accounttitle"><h1>修改资料 </h1></div>

    <div class="c_p5"><div class="tips">请认真修改自己的个人信息。</div></div>
        <table width="100%" border="0" cellpadding="3" cellspacing="0">
          <form method='post' id="form1" action="__URL__/userInfoSave" >
          <tr>
            <td colspan="3" style="height:5px;"></td>
            </tr>
          <tr>
            <td width="25%" align="right">所属报单中心：</td>
            <td width="25%"><input name="UserID" type="text" id="UserID" value="<?php echo ($vo['shop_name']); ?>" style="background-color:#ddd;" readonly="readonly" class="ipt" /></td>
            <td width="50%">&nbsp;</td>
            </tr>
          <tr>
            <td width="25%" align="right">推荐人：</td>
            <td width="25%"><input name="UserID2" type="text" id="UserID2" value="<?php echo ($vo['re_name']); ?>" style="background-color:#ddd;" readonly="readonly" class="ipt" /></td>
            <td width="50%">&nbsp;</td>
            </tr>
          <tr>
            <td align="right">接点人：</td>
            <td><input name="UserID3" type="text" id="UserID3" value="<?php echo ($vo['father_name']); ?>" style="background-color:#ddd;" readonly="readonly"  class="ipt"/></td>
            <td>&nbsp;</td>
            </tr>
        <?php if(empty($User_namex)): else: ?>
        <tr>
        <td align="right"><?php echo ($User_namex); ?>：</td>
          <td><input name="UserID" type="text" id="UserID" value="<?php echo ($vo['user_id']); ?>" style="background-color:#ddd;" readonly="readonly" class="ipt"/></td>
          <td>&nbsp;</td>
        </tr><?php endif; ?>
        <?php if(empty($Nick_namex)): else: ?>
        <tr style="display:none">
        <td align="right"><?php echo ($Nick_namex); ?>：</td>
          <td><input name="NickName" type="text" id="NickName" value="<?php echo ($vo['nickname']); ?>" class="ipt" onkeyup="javascript:Null_Full(this.name)" onfocus="notice('8','')" onblur="notice('8','none')"/></td>
          <td><div id="NickName1" class="info">
              <div id="8" class="focus_r" style="display:none;">
                <div class="msg_tip">请输入您的昵称。</div>
              </div>
            </div></td>
        </tr><?php endif; ?>
          <tr>
            <td colspan="3" style="height:5px;"><hr></td>
            </tr>
          <tr>
            <td align="right">开户银行：</td>
            <td><?php echo ($b_bank['bank_name']); ?>
                <select name="BankName" id="BankName" style="display:none">
                  <?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i; if(($bank[$key]) == $b_bank['bank_name']): ?><option value="<?php echo ($bank[$key]); ?>" selected="selected"><?php echo ($bank[$key]); ?></option>
                     <?php else: ?>
                       <option value="<?php echo ($bank[$key]); ?>"><?php echo ($bank[$key]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><span id="bank_id">银行卡号</span>：</td>
            <td><input name="BankCard" type="text" id="BankCard" value="<?php echo ($vo['bank_card']); ?>" class="ipt" maxlength="19"/></td>
            <td></td>
            </tr>
          <tr>
            <td align="right">开户姓名：</td>
            <td><input name="UserName" type="text" id="UserName" value="<?php echo ($vo['user_name']); ?>" class="ipt"/></td>
            <td></td>
            </tr>
          <tr>
            <td align="right">开户省份：</td>
            <td><input name="BankProvince" id="BankProvince" type="text" value="<?php echo ($vo['bank_province']); ?>" class="ipt"/></td>
            <td></td>
          </tr>
          <tr>
            <td align="right">开户城市：</td>
            <td><input name="BankCity" id="BankCity" type="text" value="<?php echo ($vo['bank_city']); ?>" class="ipt"/></td>
            <td></td>
          </tr>
          <tr>
            <td align="right">详细开户地址：</td>
            <td><input name="BankAddress" type="text" id="BankAddress" value="<?php echo ($vo['bank_address']); ?>" class="ipt"/></td>
            <td></td>
            </tr>
          <tr>
            <td colspan="3" style="height:5px;"><hr></td>
            </tr>
          <tr>
            <td align="right">身份证号：</td>
            <td><input name="UserCode" type="text" id="UserCode" value="<?php echo ($vo['user_code']); ?>" class="ipt"/></td>
            <td></td>
            </tr>
          <tr>
            <td align="right">Q Q 号码：</td>
            <td><input name="qq" type="text" id="qq" value="<?php echo ($vo['qq']); ?>" class="ipt" onkeyup="javascript:Null_Int(this.name)" onfocus="notice('9','')"  onblur="notice('9','none')" maxlength="19" /></td>
            <td><div id="qq1" class="info"><div id="9" class="focus_r" style="display:none;"><div class="msg_tip">请输入号码。</div></div></div></td>
          </tr>
          <tr>
            <td align="right">联系地址：</td>
            <td><input name="UserAddress" type="text" id="UserAddress" value="<?php echo ($vo['user_address']); ?>" class="ipt" onkeyup="javascript:Null_Full(this.name)" onfocus="notice('6','')"  onblur="notice('6','none')"/></td>
            <td><div id="UserAddress1" class="info"><div id="6" class="focus_r" style="display:none;"><div class="msg_tip">请输入联系地址。</div></div></div></td>
            </tr>
          <tr>
            <td align="right">联系电话：</td>
            <td><input name="UserTel" type="text" id="UserTel" value="<?php echo ($vo['user_tel']); ?>" class="ipt" onkeyup="javascript:Null_Full(this.name)" onfocus="notice('7','')"  onblur="notice('7','none')"/></td>
            <td><div id="UserTel1" class="info"><div id="7" class="focus_r" style="display:none;"><div class="msg_tip">请输入联系电话。</div></div></div></td>
            </tr>
          <tr>
            <td align="right">注册时间：</td>
            <td><?php if(isset($vo['rdt'])): echo (date('Y-m-d H:i:s',$vo['rdt'])); ?>
                  <?php else: ?>
              无<?php endif; ?></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="right">开通时间：</td>
            <td>
            <?php if(($vo['is_pay']) == "0"): ?>未开通
            <?php else: ?>
            <?php echo (date('Y-m-d H:i:s',$vo['pdt'])); endif; ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr style="display:none">
            <td align="right">修改密保问题：</td>
            <td>
            <select name="xg_wenti">
            	<option value="">选择密保问题</option>
              <?php if(is_array($wentilist)): $i = 0; $__LIST__ = $wentilist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($voo); ?>" <?php if(($voo) == $vo['wenti']): ?>selected<?php endif; ?> ><?php echo ($voo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></td>
            <td></td>
          </tr>
          <tr style="display:none">
            <td align="right">修改密保答案：</td>
            <td><input name="xg_wenti_dan" type="text" id="xg_wenti_dan" value="" class="ipt"/></td>
            <td><div class="info"><div class="focus_r"><div class="msg_tip">不修改请留空。</div></div></div></td>
          </tr>
          <tr style="display:none">
            <td colspan="3" style="height:5px;"><hr></td>
            </tr>
          <tr>
          <tr style="display:none">
            <td align="right">密保问题：</td>
            <td><?php echo ($vo['wenti']); ?></td>
            <td>&nbsp;</td>
            </tr>
          <tr style="display:none">
            <td align="right">请回答密保答案：</td>
            <td><input name="wenti_dan" type="text" id="wenti_dan" value="" class="ipt"/></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td colspan="3" style="height:5px;"><hr></td>
            </tr>
          <tr>
          <tr>
            <td height="25" colspan="3" align="center">
            <input type="hidden" name="ID" value="<?php echo ($vo['id']); ?>" >
            <input type="submit" value="修改" class="button_text">&nbsp;&nbsp;
            <input name="重置" type="reset" class="button_text" value="重置"></td>
          </tr>
          </form>
        </table>
</div>
</body>
</html>
<script>
var i=document.getElementById("BankName").selectedIndex;
function setDefault() {
    document.getElementById("BankName").selectedIndex=i;
}
</script>