// JavaScript Document
function menuGetLeft(Mum,Num)
{
	var sfEls = document.getElementById("menu").getElementsByTagName("h3");
	var topm = "s_menu"+Mum;
	for (var i=0; i<sfEls.length; i++)
	{
		sfEls[i].className="ddiv2";
		var dism = "s_menu"+i;
		document.getElementById(dism).style.display="none";
		
	}
	sfEls[Num].className="ddiv1";
	document.getElementById(topm).style.display="";
}
//导航栏
function SetCwinHeight(iframename)
{
	var cwin=iframename;
	if (document.getElementById)
	{
		if (cwin && !window.opera)
		{
			if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight)
			cwin.height = cwin.contentDocument.body.offsetHeight; 
			else if(cwin.Document && cwin.Document.body.scrollHeight)
			cwin.height = cwin.Document.body.scrollHeight;
		}
	}
}
function autoHeight(){
	var iframe = document.getElementById("Iframe");
	if(iframe.Document){//ie自有属性
		iframe.style.height = iframe.Document.documentElement.scrollHeight;
	}else if(iframe.contentDocument){//ie,firefox,chrome,opera,safari
		iframe.height = iframe.contentDocument.body.offsetHeight ;
	}
}
//iframe框架
function SetUrl(url)
{
	window.status="Welcome!";
	parent.main.location.href = url;
}//连接
function allTrim(ui){
  var newText = ui.replace(/\s{1,}/g,"");
  return newText;
}//过滤空格

//注册验证
function SignCheck(){
	var NickName=document.signform.NickName.value;
	var Pass=document.signform.Pass.value;
	var Pass2=document.signform.Pass2.value;
	var PassOpen=document.signform.PassOpen.value;
	var PassOpen2=document.signform.PassOpen2.value;
	var reman=document.signform.reman.value;
	var FatherID=document.signform.FatherID.value;
	var shopid=document.signform.shopid.value;
	var UserCode=document.signform.UserCode.value;
	var BankCard=document.signform.BankCard.value;
	var UserName=document.signform.UserName.value;
	var signcon=new Array();
	signcon[1]=allTrim(NickName);
	signcon[2]=allTrim(Pass);
	signcon[3]=allTrim(Pass2);
	signcon[4]=allTrim(PassOpen);
	signcon[5]=allTrim(PassOpen2);
	signcon[6]=allTrim(reman);
	signcon[7]=allTrim(FatherID);
	signcon[8]=allTrim(shopid);
	signcon[9]=allTrim(UserCode);
	signcon[10]=allTrim(BankCard);
	signcon[11]=allTrim(UserName);
	for (var k = 1 ; k < 12 ; k++){
	if(signcon[k].length<=0){
		alert('温馨提示：必填内容不能为空！');
		return false;
	}
	}
	if(Pass.length<6 || Pass2.length<6 || PassOpen.length<6 || PassOpen2.length<6){
		alert('温馨提示：您输入的密码存在少于六位！');
		return false;
	}
	if(Pass != Pass2){
		alert('温馨提示：两次输入登录密码不一致！');
		document.signform.Pass.focus();
		return false;
	}
	if(PassOpen != PassOpen2){
		alert('温馨提示：两次输入的二级密码不一致！');
		document.signform.PassOpen.focus();
		return false;
	}
	if(Pass == PassOpen){
		alert('温馨提示：登录密码与二级密码一致！');
		document.signform.Pass.focus();
		return false;
	}
}
//二级密码输入验证
function PassCheck(){
	var pass_t=document.psecod.Tpass.value;
	ret_pass=allTrim(pass_t);
	if(ret_pass.length<=0){
		alert('温馨提示：请输入二级密码！');
		document.psecod.Tpass.focus();
		return false;
	}
}
//修改密码验证
function ModPassCheck(){
	var passone=document.modpass.txtPassword.value;
	var passtwo=document.modpass.txtNewPassword.value;
	var passthe=document.modpass.txtNewPassword2.value;
	var re_pass=new Array();
	re_pass[1]=allTrim(passone);
	re_pass[2]=allTrim(passtwo);
	re_pass[3]=allTrim(passthe);
	if(passtwo != passthe){
		alert('温馨提示：两次输入的密码不一致！');
		document.modpass.txtNewPassword.focus();
		return false;
	}
	for (var p = 1 ; p < 4 ; p++){
		if(re_pass[p].length<=0){
			alert('温馨提示：密码不能为空！');
			return false;
		}
	}
}
//提现验证
function carrycheck(){
	var b_name=document.carry.bankname.value;
	var b_card=document.carry.bankcard.value;
	var u_name=document.carry.bankuname.value;
	var b_jxje=document.carry.tx_je.value;
	var tixian=new Array();
	tixian[1]=allTrim(b_name);
	tixian[2]=allTrim(b_card);
	tixian[3]=allTrim(u_name);
	tixian[4]=allTrim(b_jxje);
	for (var t = 1 ; t < 5 ; t++){
		if(tixian[t].length<=0){
			alert('温馨提示：必填内容不能为空！');
			return false;
		}
	}
}
//充值验证
function reloadcheck(){
	var e_uname=document.e_form.m_e_name.value;
	var e_price=document.e_form.m_e_price.value;
	var re = /^[0-9]+.?[0-9]*$/;
	ret_e_uname=allTrim(e_uname);
	ret_e_price=allTrim(e_price);
	if(ret_e_uname.length<=0){
		alert('温馨提示：请输入会员账号！');
		document.e_form.m_e_name.focus();
		return false;
	}
	if(ret_e_price.length<=0){
		alert('温馨提示：请输入充值金额！');
		document.e_form.m_e_price.focus();
		return false;
	}
	if (!re.test(e_price)){
		alert('温馨提示：请输入正确的金额！');
		document.e_form.m_e_price.focus();
		return false;
	}
}
//会员转账验证
function zhuancheck(){
	var name=document.zhuan.name.value;
	var z_je=document.zhuan.z_price.value;
	var r_mn = /^[0-9]+.?[0-9]*$/;
	re_name=allTrim(name);
	re_mony=allTrim(z_je);
	if(re_name.length<=0){
		alert('温馨提示：请输入会员账号！');
		document.zhuan.name.focus();
		return false;
	}
	if(re_mony.length<=0){
		alert('温馨提示：请输入充值金额！');
		document.zhuan.z_price.focus();
		return false;
	}
	if (!r_mn.test(z_je)){
		alert('温馨提示：请输入正确的金额！');
		document.zhuan.z_price.focus();
		return false;
	}
	if(confirm('您确定把'+re_mony+'币转借给会员（'+re_name+'）吗？')){
		return true;
	}
	else{
		alert('您取消了本次转账操作');
        return false;
    }
}
//添加新闻信息验证
function addnewcheck(){
	var new_tit=document.addnew.n_tit.value;
	var new_aut=document.addnew.author.value;
	//var new_con=document.addnew.content.value;
	var anew=new Array();
	anew[1]=allTrim(new_tit);
	anew[2]=allTrim(new_aut);
	//anew[3]=allTrim(new_con);
	for(var n = 1 ; n < 3 ; n++){
		if(anew[n].length<=0){
			alert('温馨提示：必填内容不能为空！');
			return false;
		}
	}
}
//报单申请验证
function appcheck(){
	var spname=document.form1.shname.value;
	var smoney=document.form1.eprice.value;
	var isNum = /^[0-9]+.?[0-9]*$/;
	ret_sname=allTrim(spname);
	ret_price=allTrim(smoney);
	if(ret_sname.length<=0){
		alert('温馨提示：请输入会员账号！');
		document.form1.shname.focus();
		return false;
	}
	if(ret_price.length<=0){
		alert('温馨提示：请输入申请金额！');
		document.form1.eprice.focus();
		return false;
	}
	if(smoney < 5000){
		alert('温馨提示：预存报单币不低于5000！');
		document.form1.eprice.focus();
		return false;s
	}
	if (!re.test(smoney)){
		alert('温馨提示：请输入正确的金额！');
		document.form1.eprice.focus();
		return false;
	}
}
//添加产品
function addProcheck(){
	var cpname=document.myform.name.value;
	var cpid=document.myform.cpid.value;
	var cppri=document.myform.price.value;
	var cpnum=document.myform.cpnum.value;
	var isNum = /^[0-9]+.?[0-9]*$/;
	r_cpname=allTrim(cpname);
	r_cp_id=allTrim(cpid);
	if(r_cpname.length<=0){
		alert('温馨提示：请输入产品名称！');
		document.myform.name.focus();
		return false;
	}
	if(r_cp_id.length<=0){
		alert('温馨提示：请输入产品代号！');
		document.myform.cpid.focus();
		return false;
	}
	if(cppri < 1){
		alert('温馨提示：请输入大于 0 的产品价格！');
		document.myform.price.focus();
		return false;
	}
	if(cpnum < 1){
		alert('温馨提示：请输入大于 0 的产品数量！');
		document.myform.cpnum.focus();
		return false;
	}
	if (!re.test(cppri)){
		alert('温馨提示：请输入正确的产品价格！');
		document.myform.price.focus();
		return false;
	}
	if (!re.test(cpnum)){
		alert('温馨提示：请输入正确的产品数量！');
		document.myform.cpnum.focus();
		return false;
	}
}
  
//检测用户名是否存在   
var userid, oXMLHTTP;    
function JJB1(UURL)
{    
    document.getElementById("loader_container").style.display='';
	document.getElementById("jiesuanshijian").style.display='none';
	
	document.getElementById("UDUD").style.display='none';
	var sURL = UURL;
	
    //ie浏览器   
    if (window.ActiveXObject){       
        oXMLHTTP = new ActiveXObject("Microsoft.XMLHTTP");    
        oXMLHTTP.onreadystatechange = CheckUIDState;    
        oXMLHTTP.open("GET", sURL, true);    
        try{  
        oXMLHTTP.send(); 
		   
        }    
        catch(e)    
        {    
        document.getElementById("uid_check").innerHTML="<font color='red'><b>×</b>对不起，暂时无法检测！</font>";   
        document.form1.FirstName.focus();    
        }    
    }else if(window.XMLHttpRequest) {//火狐等其他浏览器   
        oXMLHTTP = new XMLHttpRequest();   
        oXMLHTTP.onreadystatechange = CheckUIDState;   
        oXMLHTTP.open("GET", sURL, true);   
        try{    
        oXMLHTTP.send(null);    
        }    
        catch(e)    
        {    
        document.getElementById("uid_check").innerHTML="<font color='red'><b>×</b>对不起，暂时无法检测！</font>";   
        document.form1.FirstName.focus();    
        }    
    } 
	
}    
function CheckUIDState(){ //检查状态   
    switch(oXMLHTTP.readyState)    
    {    
    case 2, 3:    
    document.getElementById("uid_check").innerHTML="正在检测,请稍候…";   
    break;    
    case 4:    
    if(oXMLHTTP.responseText == "true")    
    document.getElementById("uid_check").innerHTML="<font color='red'><b>×</b>"+oXMLHTTP.responseText+"！</font>";   
    else
	document.getElementById("wcqd").style.display='';
	document.getElementById("myloader").style.display='none';
	document.getElementById("UDUD").style.display='none';
    document.getElementById("uid_check").innerHTML="<font color=green><b>√</b></font><font color=green>恭喜你，此用户可以使用！"+oXMLHTTP.responseText+"</font>";  
    break;
    }    
}


function addFavorite(url, title) {
	try {
		window.external.addFavorite(url, title);
	} catch (e){
		try {
			window.sidebar.addPanel(title, url, '');
        	} catch (e) {
			showDialog("请按 Ctrl+D 键添加到收藏夹", 'notice');
		}
	}
}





//function document.oncontextmenu(){event.returnValue=false;}//屏蔽鼠标右键
function clickIE4(){
	if (event.button==2){
			return false;
	}
}
function clickNS4(e){
	if (document.layers||document.getElementById&&!document.all){
		if (e.which==2||e.which==3){
				return false;
		}
	}
}
 
function OnDeny(){
	if(event.ctrlKey || event.keyCode==78 && event.ctrlKey || event.altKey || event.altKey && event.keyCode==115){
		return false;
	}
}
 
if (document.layers){
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown=clickNS4;
    document.onkeydown=OnDeny();
}else if (document.all&&!document.getElementById){
    document.onmousedown=clickIE4;
    document.onkeydown=OnDeny();
}
//document.oncontextmenu=new Function("return false");