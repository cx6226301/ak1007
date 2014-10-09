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
<div class="accounttitle"><h1>会员管理 </h1></div>
&nbsp;
<form name="form3" method="post" action="__URL__/adminMenberAC">
<table width="100%" class="tab3" border="0" cellpadding="3" cellspacing="1" id="tb1" bgcolor="#b9c8d0">
	<thead>
    <tr align="center">
        <th></th>
        <th><span>会员编号</span></th>
        <th><span>姓名</span></th>
        <!--<th><span>身份</span></th>-->
        <th><span>联系电话</span></th>
        <th><span>报单中心</span></th>
        <th><span>开通时间</span></th>
        <th><span>总奖金</span></th>
        <th><span>报单币</span></th>
        <th><span>金币账户</span></th>
        <th><span>金种子账户</span></th>
        <!--<th><span>业务员</span></th>-->
        <th><span>查看奖金</span></th>
        <th><span>状态</span></th>
        <th><span>是否奖金</span></th>
    </tr>
    </thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="content_td lz" align="center">
        <td><input type="checkbox" name="tabledb[]" value="<?php echo ($vo['id']); ?>" class="btn2" /></td>
        <td><a href="__URL__/adminuserData/PT_id/<?php echo ($vo['id']); ?>"><?php echo ($vo['user_id']); ?></a></td>
        <td><?php echo ($vo['user_name']); ?></td>
        <!--<td><span class="ywy1"><?php echo (pd_ywy($vo['ywy'])); ?></span><span class="ywy2"><?php echo (pd_ywy1($vo['id'])); ?></span></td>-->
        <td><?php echo ($vo['user_tel']); ?></td>
        <td><?php if(($vo['is_agent']) == "2"): ?><span style="color:BLUE;">是</span><?php else: ?>否<?php endif; ?></td>
        <td><?php echo (date('Y-m-d H:i:s',$vo["pdt"])); ?></td>
        <td><?php echo ($vo['zjj']); ?></td>
        <td><?php echo ($vo['agent_cash']); ?></td>
        <td><?php echo ($vo['agent_use']); ?></td>
        <td><?php echo ($vo['agent_zz']); ?></td>
        <!--<td><?php echo ($vo['agent_qb']); ?></td>-->
        <td><a href="__APP__/Fck/financeTable/cid/<?php echo ($vo['id']); ?>">查看</a></td>
        <td><?php if(($vo['is_lock']) == "0"): ?><span style="color: #FF0000;">未锁定</span><?php else: ?>已锁定<?php endif; if(($vo['is_pay']) == "2"): ?>[空单]<?php endif; ?></td>
        <td><?php if(($vo['is_fenh']) == "0"): ?><span style="color: #FF0000;">开启奖金</span><?php else: ?>关闭奖金<?php endif; ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
    
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td><?php echo ($page); ?></td>
    </tr>
</table>
</form>
</div>
</body>
</html>
<script>
        var ywy1=document.getElementById('ywy1');
        var ywy2=document.getElementById('ywy2');
        alert(ywy1.value);
        if(ywy1.value=='业务员')
            ywy2.style.display='none';
        else {
            ywy1.style.display='none';
            ywy2.style.display='block';
        }
        
        function url(id){
            window.location.href="__URL__/shengji_ywy/id/"+id;
        }
        </script>
<script>new TableSorter("tb1");</script>