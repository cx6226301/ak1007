// JavaScript Document
	
function SelectAll(theform) {
	//alert(theform.length);
	for (var i=0;i<theform.length;i++) {
		var e=theform[i];
		e.checked=!e.checked;
	}
}

function output(ObjID) 
{ 
//拷贝 
var elTable = document.getElementById(ObjID); 
var oRangeRef = document.body.createTextRange(); 
oRangeRef.moveToElementText( elTable ); 
oRangeRef.execCommand( "Copy" );
//粘贴 
try{ 
var appExcel = new ActiveXObject( "Excel.Application" ); 
appExcel.Visible = true; 
appExcel.Workbooks.Add().Worksheets.Item(1).Paste(); 
//appExcel = null; 
}catch(e){ 
alert("使用此功能必须在浏览器中设置:Internet选项->安全->自定义级别->对没有标记为安全的ActiveX控件进行初始化和脚本运行->启用"); 
}
}