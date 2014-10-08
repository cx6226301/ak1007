<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生成走势图及水印</title>
<?php require_once("inc/inc.php");?>
<script type="text/javascript" src="js/jquery1101.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>

<script type="text/javascript">

$(function () {
	<?php $sql="select * from xt_zoushi";
          $result=mysql_query($sql);
          $i=0;
	   ?>
	$('#container').highcharts({
		title: {//走势图标题
			text: '股价走势图',
			x: 20 ,
			//style:{display:"none"}可隐藏
		},
		subtitle: {//走势图来源
			text: '',
			x: 20,
			style:{display:"none"}//可隐藏
		},
		xAxis: {//X轴分类
			categories: ['2013-11-06', '2013-11-07', '2013-11-08', '2013-11-09', '2013-11-22', '2013-11-07', '2013-11-08', '2013-11-09', '2013-11-22', '2013-11-22']
		},
		yAxis: {//Y轴会根据series的data数值自动分格并划分上下限
			title: {
				text: '(股价)',//Y轴表示的文本
				//style:{display:"none"}可隐藏
			}
		},
		tooltip: {
			valueSuffix: '(元/股)'//数据的后辍
		},
		legend:{//线条所表示的品种分类
			enabled:0,//0为隐藏1为显示
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle',
			borderWidth: 0
		},
		credits:{//制作人；可作为本站水印
			text:"123",
			href:"http://www.91metal.com",
			position:{x:-250,y:-180},
			style:{"z-index":"999",display:"none"}
		},
		series: [{//可以为多个品种
			name: '股价',
			data: [1.19, 1.20, 1.21, 1.22, 1.23, 1.22, 1.24, 1.26, 1.28, 1.25]
		}]
	});
	  
});
</script>

</head>
<body>
	<script type="text/javascript">
	var i='';
<?php while($row=mysql_fetch_array($result)){
				if($i==0)
				?>i='<?php echo date("H:i:s",$row['add_time']);?>'
			else ?>i=i+'<?php echo ",".date("H:i:s",$row['add_time']);
			} ?>'
	document.write(i);
			</script>
	<div id="container" style="width:600px;height:300px;margin:0 auto"></div>

</body>
</html>
