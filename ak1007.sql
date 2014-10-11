-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.20-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  事件 ak1007.event_huiben 结构
DELIMITER //
CREATE DEFINER=`root`@`localhost` EVENT `event_huiben` ON SCHEDULE EVERY 10 SECOND STARTS '2014-09-10 14:04:45' ON COMPLETION PRESERVE DISABLE COMMENT '日分红' DO BEGIN
call proc_history();
call proc_time();
END//
DELIMITER ;


-- 导出  过程 ak1007.proc_bonus 结构
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_bonus`(IN `id` INT)
BEGIN
  set @id=id;
  update xt_bonus b,xt_fck f set b.b1=b.b1+f.b1,b.b2=b.b2+f.b2 where b.did=@id and b.uid=f.id;
  update xt_fck set zjj=zjj+b1+b2,agent_use=agent_use+b1+b2,agent_zz=agent_zz+b5;
  update xt_fck set b0=0,b1=0,b2=0,b3=0,b4=0,b5=0,b6=0,b7=0,b8=0,b9=0,b10=0;
END//
DELIMITER ;


-- 导出  过程 ak1007.proc_history 结构
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_history`()
BEGIN
   /*生成历史记录*/
   set @str4=(select str4 from xt_fee where id=1);/*日分红*/
   set @s15=(select s15 from xt_fee where id=1);
   set @s14=(select s14 from xt_fee where id=1);
   set @s1=(select s1 from xt_fee where id=1);/*领导奖*/
   set @str41=@str4*@s15/100;
   set @str42=@str4*@s14/100;
   update xt_fck set b1=b1+@str41,b5=b5+@str42 where is_pay=1;
   
   update xt_fck set b3=b3+@str41,b5=b5+@str42 where is_pay=1;
   
   /*日分红*/
   insert into xt_history(uid,user_id,did,user_did,action_type,pdt,epoints,allp,bz,type,act_pdt) select id,user_id,0,0,1,unix_timestamp(now()),b1,0,1,1,0 from xt_fck where  b1!=0;/*日分红*/
   
	/*领导奖*/
	insert into xt_history(uid,user_id,did,user_did,action_type,pdt,epoints,allp,bz,type,act_pdt) select id,user_id,0,0,3,unix_timestamp(now()),b3,0,3,1,0 from xt_fck where  b3!=0;/*日分红*/
	
	/*集合金种子*/
   insert into xt_history(uid,user_id,did,user_did,action_type,pdt,epoints,allp,bz,type,act_pdt) select id,user_id,0,0,5,unix_timestamp(now()),b5,0,5,1,0 from xt_fck where  b5!=0;/*金种子*/
END//
DELIMITER ;


-- 导出  过程 ak1007.proc_time 结构
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_time`()
BEGIN
set @y=year(now());
set @m=month(now());
set @d=day(now());
set @t=concat(@y,"-",@m,"-",@d," 23:59:59");
set @time=unix_timestamp(@t);
set @count=(select count(*) from xt_times where benqi=@time); /*本期是否存在*/
if @count=1 then
set @id=(select id from xt_times where benqi=@time);
call proc_bonus(@id);
else 
set @shangqi=(select benqi from xt_times order by id desc limit 1);
insert into xt_times(benqi,shangqi,is_count_b,is_count_c,is_count,type) values(@time,@shangqi,0,0,0,0);
set @id=(select id from xt_times where benqi=@time);
call proc_bonus(@id);
end if;
END//
DELIMITER ;


-- 导出  表 ak1007.xt_access 结构
CREATE TABLE IF NOT EXISTS `xt_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_access 的数据：136 rows
DELETE FROM `xt_access`;
/*!40000 ALTER TABLE `xt_access` DISABLE KEYS */;
INSERT INTO `xt_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
	(2, 1, 1, 0, ''),
	(2, 40, 2, 1, ''),
	(2, 30, 2, 1, ''),
	(3, 1, 1, 0, ''),
	(2, 69, 2, 1, ''),
	(2, 50, 3, 40, ''),
	(3, 50, 3, 40, ''),
	(1, 50, 3, 40, ''),
	(3, 7, 2, 1, ''),
	(3, 39, 3, 30, ''),
	(2, 39, 3, 30, ''),
	(2, 49, 3, 30, ''),
	(4, 1, 1, 0, ''),
	(4, 2, 2, 1, ''),
	(4, 3, 2, 1, ''),
	(4, 4, 2, 1, ''),
	(4, 5, 2, 1, ''),
	(4, 6, 2, 1, ''),
	(4, 7, 2, 1, ''),
	(4, 11, 2, 1, ''),
	(5, 25, 1, 0, ''),
	(5, 51, 2, 25, ''),
	(1, 1, 1, 0, ''),
	(1, 39, 3, 30, ''),
	(1, 69, 2, 1, ''),
	(1, 30, 2, 1, ''),
	(1, 40, 2, 1, ''),
	(1, 49, 3, 30, ''),
	(3, 69, 2, 1, ''),
	(3, 30, 2, 1, ''),
	(3, 40, 2, 1, ''),
	(1, 37, 3, 30, ''),
	(1, 36, 3, 30, ''),
	(1, 35, 3, 30, ''),
	(1, 34, 3, 30, ''),
	(1, 33, 3, 30, ''),
	(1, 32, 3, 30, ''),
	(1, 31, 3, 30, ''),
	(2, 32, 3, 30, ''),
	(2, 31, 3, 30, ''),
	(7, 1, 1, 0, ''),
	(7, 69, 2, 1, ''),
	(7, 30, 2, 1, ''),
	(7, 40, 2, 1, ''),
	(7, 50, 3, 40, ''),
	(7, 39, 3, 30, ''),
	(7, 49, 3, 30, ''),
	(7, 84, 1, 0, ''),
	(7, 85, 1, 0, ''),
	(2, 84, 1, 0, ''),
	(2, 85, 1, 0, ''),
	(1, 84, 1, 0, ''),
	(1, 85, 1, 0, ''),
	(1, 7, 2, 1, ''),
	(1, 6, 2, 1, ''),
	(1, 2, 2, 1, ''),
	(1, 83, 2, 1, ''),
	(7, 7, 2, 1, ''),
	(7, 6, 2, 1, ''),
	(7, 2, 2, 1, ''),
	(7, 83, 2, 1, ''),
	(7, 37, 3, 30, ''),
	(7, 36, 3, 30, ''),
	(7, 35, 3, 30, ''),
	(7, 34, 3, 30, ''),
	(7, 33, 3, 30, ''),
	(7, 32, 3, 30, ''),
	(7, 31, 3, 30, ''),
	(2, 1, 1, 0, ''),
	(2, 40, 2, 1, ''),
	(2, 30, 2, 1, ''),
	(3, 1, 1, 0, ''),
	(2, 69, 2, 1, ''),
	(2, 50, 3, 40, ''),
	(3, 50, 3, 40, ''),
	(1, 50, 3, 40, ''),
	(3, 7, 2, 1, ''),
	(3, 39, 3, 30, ''),
	(2, 39, 3, 30, ''),
	(2, 49, 3, 30, ''),
	(4, 1, 1, 0, ''),
	(4, 2, 2, 1, ''),
	(4, 3, 2, 1, ''),
	(4, 4, 2, 1, ''),
	(4, 5, 2, 1, ''),
	(4, 6, 2, 1, ''),
	(4, 7, 2, 1, ''),
	(4, 11, 2, 1, ''),
	(5, 25, 1, 0, ''),
	(5, 51, 2, 25, ''),
	(1, 1, 1, 0, ''),
	(1, 39, 3, 30, ''),
	(1, 69, 2, 1, ''),
	(1, 30, 2, 1, ''),
	(1, 40, 2, 1, ''),
	(1, 49, 3, 30, ''),
	(3, 69, 2, 1, ''),
	(3, 30, 2, 1, ''),
	(3, 40, 2, 1, ''),
	(1, 37, 3, 30, ''),
	(1, 36, 3, 30, ''),
	(1, 35, 3, 30, ''),
	(1, 34, 3, 30, ''),
	(1, 33, 3, 30, ''),
	(1, 32, 3, 30, ''),
	(1, 31, 3, 30, ''),
	(2, 32, 3, 30, ''),
	(2, 31, 3, 30, ''),
	(7, 1, 1, 0, ''),
	(7, 69, 2, 1, ''),
	(7, 30, 2, 1, ''),
	(7, 40, 2, 1, ''),
	(7, 50, 3, 40, ''),
	(7, 39, 3, 30, ''),
	(7, 49, 3, 30, ''),
	(7, 84, 1, 0, ''),
	(7, 85, 1, 0, ''),
	(2, 84, 1, 0, ''),
	(2, 85, 1, 0, ''),
	(1, 84, 1, 0, ''),
	(1, 85, 1, 0, ''),
	(1, 7, 2, 1, ''),
	(1, 6, 2, 1, ''),
	(1, 2, 2, 1, ''),
	(1, 83, 2, 1, ''),
	(7, 7, 2, 1, ''),
	(7, 6, 2, 1, ''),
	(7, 2, 2, 1, ''),
	(7, 83, 2, 1, ''),
	(7, 37, 3, 30, ''),
	(7, 36, 3, 30, ''),
	(7, 35, 3, 30, ''),
	(7, 34, 3, 30, ''),
	(7, 33, 3, 30, ''),
	(7, 32, 3, 30, ''),
	(7, 31, 3, 30, '');
/*!40000 ALTER TABLE `xt_access` ENABLE KEYS */;


-- 导出  表 ak1007.xt_address 结构
CREATE TABLE IF NOT EXISTS `xt_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `moren` int(11) NOT NULL COMMENT '是否为默认地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_address 的数据：1 rows
DELETE FROM `xt_address`;
/*!40000 ALTER TABLE `xt_address` DISABLE KEYS */;
INSERT INTO `xt_address` (`id`, `uid`, `name`, `address`, `tel`, `moren`) VALUES
	(1, 1, '尼玛', '北京市', '13899999999', 0);
/*!40000 ALTER TABLE `xt_address` ENABLE KEYS */;


-- 导出  表 ak1007.xt_bonus 结构
CREATE TABLE IF NOT EXISTS `xt_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `did` int(11) NOT NULL,
  `s_date` int(11) NOT NULL,
  `e_date` int(11) NOT NULL,
  `b0` decimal(12,2) NOT NULL,
  `b1` decimal(12,2) NOT NULL,
  `b2` decimal(12,2) NOT NULL,
  `b3` decimal(12,2) NOT NULL,
  `b4` decimal(12,2) NOT NULL,
  `b5` decimal(12,2) NOT NULL,
  `b6` decimal(12,2) NOT NULL,
  `b7` decimal(12,2) NOT NULL,
  `b8` decimal(12,2) NOT NULL,
  `b9` decimal(12,2) NOT NULL,
  `b11` decimal(12,2) NOT NULL,
  `b12` decimal(12,2) NOT NULL,
  `b10` decimal(12,2) NOT NULL,
  `encash_l` int(11) NOT NULL,
  `encash_r` int(11) NOT NULL,
  `encash` int(11) NOT NULL,
  `is_count_b` int(11) NOT NULL,
  `is_count_c` int(11) NOT NULL,
  `is_pay` int(11) NOT NULL,
  `u_level` int(11) NOT NULL,
  `type` smallint(2) NOT NULL DEFAULT '0',
  `additional` varchar(50) NOT NULL COMMENT '额外奖',
  `encourage` varchar(50) NOT NULL COMMENT '阶段鼓励奖',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2227 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_bonus 的数据：2 rows
DELETE FROM `xt_bonus`;
/*!40000 ALTER TABLE `xt_bonus` DISABLE KEYS */;
INSERT INTO `xt_bonus` (`id`, `uid`, `user_id`, `did`, `s_date`, `e_date`, `b0`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b11`, `b12`, `b10`, `encash_l`, `encash_r`, `encash`, `is_count_b`, `is_count_c`, `is_pay`, `u_level`, `type`, `additional`, `encourage`) VALUES
	(2226, 2270, '1', 114, 1262275200, 1412870399, 16.25, 16.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
	(2225, 1, '100000', 114, 1262275200, 1412870399, 376.93, 24.31, 351.00, 1.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '', '');
/*!40000 ALTER TABLE `xt_bonus` ENABLE KEYS */;


-- 导出  表 ak1007.xt_chongzhi 结构
CREATE TABLE IF NOT EXISTS `xt_chongzhi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `epoint` decimal(12,2) NOT NULL,
  `huikuan` decimal(12,2) NOT NULL,
  `zhuanghao` int(11) NOT NULL,
  `rdt` int(11) NOT NULL,
  `pdt` int(11) NOT NULL DEFAULT '0',
  `is_pay` smallint(2) NOT NULL,
  `stype` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 正在导出表  ak1007.xt_chongzhi 的数据：0 rows
DELETE FROM `xt_chongzhi`;
/*!40000 ALTER TABLE `xt_chongzhi` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_chongzhi` ENABLE KEYS */;


-- 导出  表 ak1007.xt_cody 结构
CREATE TABLE IF NOT EXISTS `xt_cody` (
  `c_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cody_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_cody 的数据：30 rows
DELETE FROM `xt_cody`;
/*!40000 ALTER TABLE `xt_cody` DISABLE KEYS */;
INSERT INTO `xt_cody` (`c_id`, `cody_name`) VALUES
	(1, 'profile'),
	(2, 'password'),
	(3, 'Jj_FA'),
	(4, '4'),
	(5, '5'),
	(6, '6'),
	(7, '7'),
	(8, '8'),
	(9, '9'),
	(10, '10'),
	(11, '11'),
	(12, '12'),
	(13, '13'),
	(14, '14'),
	(15, '15'),
	(16, '16'),
	(17, '17'),
	(18, '18'),
	(19, '19'),
	(20, '20'),
	(21, '21'),
	(22, '22'),
	(23, '23'),
	(24, '24'),
	(25, '25'),
	(26, '26'),
	(27, '27'),
	(28, '28'),
	(29, '29'),
	(30, '30');
/*!40000 ALTER TABLE `xt_cody` ENABLE KEYS */;


-- 导出  表 ak1007.xt_cptype 结构
CREATE TABLE IF NOT EXISTS `xt_cptype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tpname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `b_id` int(11) NOT NULL DEFAULT '0',
  `s_id` int(11) NOT NULL DEFAULT '0',
  `t_pai` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_cptype 的数据：3 rows
DELETE FROM `xt_cptype`;
/*!40000 ALTER TABLE `xt_cptype` DISABLE KEYS */;
INSERT INTO `xt_cptype` (`id`, `tpname`, `b_id`, `s_id`, `t_pai`, `status`) VALUES
	(1, '家用电器', 0, 0, 0, 0),
	(2, '食品', 0, 0, 0, 0),
	(3, '生活用品', 0, 0, 0, 0);
/*!40000 ALTER TABLE `xt_cptype` ENABLE KEYS */;


-- 导出  表 ak1007.xt_fck 结构
CREATE TABLE IF NOT EXISTS `xt_fck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(64) DEFAULT NULL,
  `bind_account` varchar(50) DEFAULT NULL,
  `new_login_time` int(11) NOT NULL DEFAULT '0',
  `new_login_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text,
  `name` varchar(25) DEFAULT NULL,
  `dept_id` smallint(3) DEFAULT NULL,
  `user_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '用户编号',
  `user_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '银行开户名',
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '一级密码',
  `pwd1` varchar(50) DEFAULT NULL COMMENT '一级密码不加密',
  `passopen` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '二级密码',
  `pwd2` varchar(50) DEFAULT NULL COMMENT '二级密码不加密',
  `passopentwo` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '三级密码',
  `pwd3` varchar(50) DEFAULT NULL COMMENT '三级密码不加密',
  `nickname` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '昵称',
  `qq` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'QQ',
  `bank_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '开户银行',
  `bank_card` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '银行卡号',
  `bank_province` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '开户银行所在省',
  `bank_city` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '开户银行所在城市',
  `bank_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '支行地址',
  `user_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '身份证',
  `user_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '联系地址',
  `user_post` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '联系方式',
  `user_tel` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '电话',
  `user_phone` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '手机',
  `rdt` int(11) NOT NULL COMMENT '注册时间',
  `treeplace` int(11) DEFAULT NULL COMMENT '区分左(中)右',
  `father_id` int(11) NOT NULL COMMENT '父节点',
  `father_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '父名',
  `re_id` int(11) NOT NULL COMMENT '推荐ID',
  `re_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '推荐人名称',
  `is_pay` int(11) NOT NULL COMMENT '是否开通(0,1)',
  `is_lock` int(11) NOT NULL COMMENT '是否锁定(0,1)',
  `shoplx` int(11) NOT NULL COMMENT '报单中心ID',
  `shop_a` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '//中心所在省',
  `shop_b` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '//中心所在县',
  `is_agent` int(11) NOT NULL COMMENT '报单中心(0,1,2)',
  `agent_max` decimal(12,2) NOT NULL COMMENT '申请报单总金额',
  `agent_use` decimal(12,2) NOT NULL COMMENT '奖金币',
  `agent_cash` decimal(12,2) NOT NULL COMMENT '报单币',
  `agent_zz` decimal(12,2) NOT NULL COMMENT '金种子',
  `agent_kt` decimal(12,2) NOT NULL DEFAULT '0.00',
  `agent_xf` decimal(12,2) NOT NULL DEFAULT '0.00',
  `agent_cf` decimal(12,2) NOT NULL DEFAULT '0.00',
  `agent_gp` decimal(12,2) NOT NULL DEFAULT '0.00',
  `agent_qb` decimal(12,2) NOT NULL DEFAULT '0.00',
  `gp_num` int(11) NOT NULL DEFAULT '0',
  `lssq` decimal(12,2) NOT NULL,
  `zsq` decimal(12,2) NOT NULL,
  `adt` int(11) NOT NULL COMMENT '申请成报单中心时间',
  `l` int(11) NOT NULL COMMENT '左边总人数',
  `r` int(11) NOT NULL COMMENT '右边总人数',
  `benqi_l` int(11) NOT NULL COMMENT '本期左区新增',
  `benqi_r` int(11) NOT NULL COMMENT '本期右区新增',
  `shangqi_l` int(11) NOT NULL COMMENT '上期左区剩余',
  `shangqi_r` int(11) NOT NULL COMMENT '上期右区剩余',
  `peng_num` int(11) NOT NULL DEFAULT '0',
  `u_level` int(11) NOT NULL COMMENT '等级(会员级别)',
  `is_boss` int(11) NOT NULL COMMENT '管理人为1,其它为0',
  `idt` int(11) NOT NULL,
  `pdt` int(11) NOT NULL COMMENT '开通时间',
  `re_level` int(11) NOT NULL COMMENT '相对于推的代数',
  `p_level` int(11) NOT NULL COMMENT '绝对层数',
  `re_path` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '推荐的路径',
  `p_path` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '自已的路径',
  `is_del` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL COMMENT '隶属报单ID',
  `shop_name` varchar(50) NOT NULL,
  `b0` decimal(12,2) NOT NULL COMMENT '每期总资金',
  `b1` decimal(12,2) NOT NULL COMMENT '奖1',
  `b2` decimal(12,2) NOT NULL COMMENT '奖2',
  `b3` decimal(12,2) NOT NULL COMMENT '奖3',
  `b4` decimal(12,2) NOT NULL COMMENT '奖4',
  `b5` decimal(12,2) NOT NULL COMMENT '奖5',
  `b6` decimal(12,2) NOT NULL COMMENT '奖6',
  `b7` decimal(12,2) NOT NULL COMMENT '奖7',
  `b8` decimal(12,2) NOT NULL COMMENT '奖8',
  `b9` decimal(12,2) NOT NULL COMMENT '奖9',
  `b12` decimal(12,2) NOT NULL COMMENT '奖12',
  `b11` decimal(12,2) NOT NULL COMMENT '奖11',
  `b10` decimal(12,2) NOT NULL COMMENT '奖10',
  `wlf` int(11) NOT NULL COMMENT '网络费',
  `wlf_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `cpzj` decimal(12,2) NOT NULL COMMENT '注册金额',
  `zjj` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总奖金',
  `re_money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '推荐总注册金额',
  `cz_epoint` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '冲值总金额',
  `lr` int(11) NOT NULL COMMENT '中间总单数',
  `shangqi_lr` int(11) NOT NULL COMMENT '中间上期剩余单数',
  `benqi_lr` int(11) NOT NULL COMMENT '中间本期单数',
  `user_type` varchar(200) NOT NULL COMMENT '多线登录限制',
  `re_peat_money` decimal(12,2) NOT NULL COMMENT 'x',
  `re_nums` smallint(4) NOT NULL DEFAULT '0' COMMENT 'x',
  `duipeng` decimal(12,2) NOT NULL,
  `_times` int(11) NOT NULL,
  `fanli` int(11) NOT NULL,
  `fanli_time` int(11) NOT NULL,
  `fanli_num` int(11) NOT NULL,
  `is_fenh` smallint(2) NOT NULL,
  `open` smallint(2) NOT NULL,
  `f4` int(11) NOT NULL DEFAULT '0',
  `new_agent` smallint(1) NOT NULL DEFAULT '0' COMMENT '//是否新服务中心',
  `day_feng` decimal(12,2) NOT NULL DEFAULT '0.00',
  `get_date` int(11) DEFAULT '0',
  `get_numb` int(11) DEFAULT '0',
  `is_jb` int(11) DEFAULT '0',
  `sq_jb` int(11) DEFAULT '0',
  `jb_sdate` int(11) DEFAULT '0',
  `jb_idate` int(11) DEFAULT '0',
  `man_ceng` int(11) NOT NULL DEFAULT '0' COMMENT '//满层数',
  `prem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '//权限',
  `wang_j` smallint(1) NOT NULL DEFAULT '0' COMMENT '//结构图',
  `wang_t` smallint(1) NOT NULL DEFAULT '0' COMMENT '//推荐图',
  `get_level` int(11) NOT NULL DEFAULT '0',
  `is_xf` smallint(11) NOT NULL DEFAULT '0',
  `xf_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_zy` int(11) NOT NULL DEFAULT '0',
  `zyi_date` int(11) NOT NULL DEFAULT '0',
  `zyq_date` int(11) NOT NULL DEFAULT '0',
  `mon_get` decimal(12,2) NOT NULL DEFAULT '0.00',
  `xy_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `down_num` int(11) NOT NULL DEFAULT '0',
  `u_pai` int(11) NOT NULL DEFAULT '0',
  `n_pai` int(11) NOT NULL DEFAULT '0',
  `ok_pay` int(11) NOT NULL DEFAULT '0',
  `wenti` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wenti_dan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_tj` int(11) NOT NULL DEFAULT '0',
  `re_f4` int(11) NOT NULL DEFAULT '0',
  `fuli` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wangluo` smallint(6) NOT NULL DEFAULT '0',
  `real_name` varchar(50) NOT NULL COMMENT '原名称（此为新增账号）',
  `real_id` smallint(6) NOT NULL DEFAULT '0',
  `real_nums` smallint(6) NOT NULL DEFAULT '0' COMMENT '下级新增点位个数',
  `fengding` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '日分红总封顶',
  `agent_use_mr` decimal(10,2) NOT NULL DEFAULT '0.00',
  `agent_zz_mr` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2277 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_fck 的数据：6 rows
DELETE FROM `xt_fck`;
/*!40000 ALTER TABLE `xt_fck` DISABLE KEYS */;
INSERT INTO `xt_fck` (`id`, `account`, `bind_account`, `new_login_time`, `new_login_ip`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `info`, `name`, `dept_id`, `user_id`, `user_name`, `password`, `pwd1`, `passopen`, `pwd2`, `passopentwo`, `pwd3`, `nickname`, `qq`, `bank_name`, `bank_card`, `bank_province`, `bank_city`, `bank_address`, `user_code`, `user_address`, `user_post`, `user_tel`, `user_phone`, `rdt`, `treeplace`, `father_id`, `father_name`, `re_id`, `re_name`, `is_pay`, `is_lock`, `shoplx`, `shop_a`, `shop_b`, `is_agent`, `agent_max`, `agent_use`, `agent_cash`, `agent_zz`, `agent_kt`, `agent_xf`, `agent_cf`, `agent_gp`, `agent_qb`, `gp_num`, `lssq`, `zsq`, `adt`, `l`, `r`, `benqi_l`, `benqi_r`, `shangqi_l`, `shangqi_r`, `peng_num`, `u_level`, `is_boss`, `idt`, `pdt`, `re_level`, `p_level`, `re_path`, `p_path`, `is_del`, `shop_id`, `shop_name`, `b0`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b12`, `b11`, `b10`, `wlf`, `wlf_money`, `cpzj`, `zjj`, `re_money`, `cz_epoint`, `lr`, `shangqi_lr`, `benqi_lr`, `user_type`, `re_peat_money`, `re_nums`, `duipeng`, `_times`, `fanli`, `fanli_time`, `fanli_num`, `is_fenh`, `open`, `f4`, `new_agent`, `day_feng`, `get_date`, `get_numb`, `is_jb`, `sq_jb`, `jb_sdate`, `jb_idate`, `man_ceng`, `prem`, `wang_j`, `wang_t`, `get_level`, `is_xf`, `xf_money`, `is_zy`, `zyi_date`, `zyq_date`, `mon_get`, `xy_money`, `down_num`, `u_pai`, `n_pai`, `ok_pay`, `wenti`, `wenti_dan`, `is_tj`, `re_f4`, `fuli`, `wangluo`, `real_name`, `real_id`, `real_nums`, `fengding`, `agent_use_mr`, `agent_zz_mr`) VALUES
	(1, 'admin', '0', 1412847107, '127.0.0.1', 1412847107, '127.0.0.1', 0, '1', '344168949@qq.com', '00', 0, 0, 1, 0, '0', '100000', 0, '100000', '公司', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'd41d8cd98f00b204e9800998ecf8427e', '', '管理员', '777888', '工商银行', '8889992', '222', '333', '444', '4444', '51', 'QQ126163@QQ.com', '633144', '0', 1295884800, 0, 0, '0', 0, '0', 2, 0, 1, '全国总代理', '全国总代理', 2, 0.00, 376.93, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 210.00, 0, 0.00, 0.00, 1317024831, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, ',', ',', 0, 0, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 376.93, 0.00, 0.00, 0, 0, 0, '558ffce517279d76626e285352cf49e9', 0.00, 2, 0.00, 1412784000, 0, 1412818383, 0, 0, 0, 0, 0, 0.00, 1412784000, 0, 1, 0, 0, 1323230473, 0, ',1,2,3,4,16,17,5,14,6,7,8,15,9,10,11,12,13,', 0, 0, 0, 0, 0.00, 0, 0, 0, 919379.05, 0.00, 0, 1, 1, 1, '你爱人叫什么名字？', '123', 0, 2, 0.00, 2014, '', 0, 1, 346.80, 193.37, 104.13),
	(2272, NULL, '3333', 1412847185, '127.0.0.1', 1412847185, '127.0.0.1', 0, '0', '888', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '1000001', '222', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', NULL, NULL, '483615', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412820350, 0, 2270, '1', 1, '0', 1, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1412820350, 1, 2, '', ',1,2270,', 0, 0, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, 'c145be0b6d7963bbafab6170999439fd', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 1, 1, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '100000', 1, 0, 0.00, 0.00, 0.00),
	(2273, NULL, '3333', 0, '', 1412823296, '', 0, '0', '3441689@qq.com', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '3', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '3', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412823296, NULL, 0, '', 1, '100000', 0, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, ',1,', '', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 1, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 0.00, 0.00, 0.00),
	(2274, NULL, '3333', 0, '', 1412823364, '', 0, '0', '5@q.com45', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '5', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '5', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412823364, NULL, 0, '', 1, '100000', 0, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, ',1,', '', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 1, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 0.00, 0.00, 0.00),
	(2275, NULL, '3333', 0, '', 1412843815, '', 0, '0', '344168949@qq.com', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '6', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '6', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412843815, NULL, 0, '', 2272, '1000001', 0, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2, 0, '2272,', '', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 1, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 0.00, 0.00, 0.00),
	(2276, NULL, '3333', 0, '', 1412847411, '', 0, '0', '344168949@qq.com', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '10', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '10', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412847411, NULL, 0, '', 2272, '1000001', 0, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2, 0, '2272,', '', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 1, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 0.00, 0.00, 0.00),
	(2270, NULL, '3333', 0, '', 1412818420, '', 0, '0', '888', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '1', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '1', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412818420, 0, 1, '100000', 1, '100000', 1, 0, 0, '', '', 0, 0.00, 16.25, 0.00, 8.75, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1412818424, 1, 1, ',1,', ',1,', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 16.25, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 1, 1, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 25.00, 16.25, 8.75),
	(2271, NULL, '3333', 0, '', 1412820344, '', 0, '0', '888', NULL, 0, NULL, 1, 0, '信息', '名称', NULL, '2', '222', '96e79218965eb72c92a549dd5a330112', '111111', 'e3ceb5881a0a1fdaad01296d7554868d', '222222', NULL, NULL, '2', '8888', '农业银行', '11122', '请选择', '请选择', '4554', '888', '888', '', '138', '', 1412820344, 1, 1, '100000', 1, '100000', 1, 0, 0, '', '', 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1412820350, 1, 1, ',1,', ',1,', 0, 1, '100000', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 1500.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0.00, 0, 0.00, 1412784000, 0, 0, 0, 0, 1, 1, 0, 0.00, 1412784000, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '你爱人叫什么名字？', 'xx', 0, 0, 0.00, 0, '', 0, 0, 0.00, 0.00, 0.00);
/*!40000 ALTER TABLE `xt_fck` ENABLE KEYS */;


-- 导出  表 ak1007.xt_fck_shop 结构
CREATE TABLE IF NOT EXISTS `xt_fck_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_pay` smallint(1) NOT NULL DEFAULT '0',
  `pdt` int(11) NOT NULL,
  `type` smallint(2) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `p_dt` int(11) NOT NULL COMMENT '退货时间',
  `p_is_pay` smallint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `out_type` smallint(2) NOT NULL DEFAULT '0' COMMENT '0为未评论，1为已评论',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2533 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_fck_shop 的数据：3 rows
DELETE FROM `xt_fck_shop`;
/*!40000 ALTER TABLE `xt_fck_shop` DISABLE KEYS */;
INSERT INTO `xt_fck_shop` (`id`, `did`, `uid`, `price`, `create_time`, `is_pay`, `pdt`, `type`, `num`, `content`, `p_dt`, `p_is_pay`, `out_type`) VALUES
	(2527, 33, 4054, 20.00, 1296203686, 1, 1296289294, 2, 1, 'fff', 1296289467, 3, 0),
	(2528, 33, 4054, 20.00, 1296203703, 1, 1296289294, 2, 1, '', 1296289462, 3, 1),
	(2532, 31, 1, 68.00, 1296288802, 1, 1296288969, 2, 3, '44444', 1296289223, 3, 1);
/*!40000 ALTER TABLE `xt_fck_shop` ENABLE KEYS */;


-- 导出  表 ak1007.xt_fee 结构
CREATE TABLE IF NOT EXISTS `xt_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `i1` int(12) DEFAULT '0',
  `i2` int(12) DEFAULT '0',
  `i3` int(12) DEFAULT '0',
  `i4` int(12) DEFAULT '0',
  `i5` int(12) DEFAULT '0',
  `i6` int(12) DEFAULT '0',
  `i7` int(12) DEFAULT '0',
  `i8` int(12) DEFAULT '0',
  `i9` int(12) DEFAULT '0',
  `i10` int(12) DEFAULT '0',
  `s1` varchar(200) DEFAULT NULL,
  `s2` varchar(200) DEFAULT NULL,
  `s3` varchar(200) DEFAULT NULL,
  `s4` varchar(200) DEFAULT NULL,
  `s5` varchar(200) DEFAULT NULL,
  `s6` varchar(200) DEFAULT NULL,
  `s7` varchar(200) DEFAULT NULL,
  `s8` varchar(200) DEFAULT NULL,
  `s9` varchar(200) DEFAULT NULL,
  `s10` varchar(200) DEFAULT NULL,
  `s11` varchar(200) DEFAULT NULL,
  `s12` varchar(200) DEFAULT NULL,
  `s13` varchar(200) DEFAULT NULL,
  `s14` varchar(200) DEFAULT NULL,
  `s15` varchar(200) DEFAULT NULL,
  `s16` varchar(200) DEFAULT NULL,
  `s17` varchar(200) DEFAULT NULL,
  `s18` varchar(200) DEFAULT NULL,
  `s19` varchar(200) DEFAULT NULL,
  `s20` varchar(200) DEFAULT NULL,
  `str1` varchar(200) DEFAULT NULL,
  `str2` varchar(200) DEFAULT NULL,
  `str3` varchar(200) DEFAULT NULL,
  `str4` varchar(200) DEFAULT NULL,
  `str5` varchar(200) DEFAULT NULL,
  `str6` varchar(200) DEFAULT NULL,
  `str7` varchar(200) DEFAULT NULL,
  `str8` varchar(200) DEFAULT NULL,
  `str9` varchar(200) DEFAULT NULL,
  `str10` varchar(200) DEFAULT NULL,
  `str11` varchar(200) DEFAULT NULL,
  `str12` varchar(200) DEFAULT NULL,
  `str13` varchar(200) DEFAULT NULL,
  `str14` varchar(200) DEFAULT NULL,
  `str15` varchar(200) DEFAULT NULL,
  `str16` varchar(200) DEFAULT NULL,
  `str17` varchar(200) DEFAULT NULL,
  `str18` varchar(200) DEFAULT NULL,
  `str19` varchar(200) DEFAULT NULL,
  `str20` varchar(200) DEFAULT NULL,
  `str21` varchar(200) DEFAULT NULL,
  `str22` varchar(200) DEFAULT NULL,
  `str23` varchar(200) DEFAULT NULL,
  `str24` varchar(200) DEFAULT NULL,
  `str25` varchar(200) DEFAULT NULL,
  `str26` varchar(200) DEFAULT NULL,
  `str27` varchar(200) DEFAULT NULL,
  `str28` varchar(200) DEFAULT NULL,
  `str29` varchar(200) DEFAULT NULL,
  `str30` varchar(200) DEFAULT NULL,
  `str99` text NOT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '清空数据时间截',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_fee 的数据：1 rows
DELETE FROM `xt_fee`;
/*!40000 ALTER TABLE `xt_fee` DISABLE KEYS */;
INSERT INTO `xt_fee` (`id`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`, `s8`, `s9`, `s10`, `s11`, `s12`, `s13`, `s14`, `s15`, `s16`, `s17`, `s18`, `s19`, `s20`, `str1`, `str2`, `str3`, `str4`, `str5`, `str6`, `str7`, `str8`, `str9`, `str10`, `str11`, `str12`, `str13`, `str14`, `str15`, `str16`, `str17`, `str18`, `str19`, `str20`, `str21`, `str22`, `str23`, `str24`, `str25`, `str26`, `str27`, `str28`, `str29`, `str30`, `str99`, `create_time`) VALUES
	(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', '1', '18', '0', '0.66', '3600', '2', '5', '1500', '普通会员', '10', '1.25', '1260', '35', '65', '100', '银行帐号：农业银行\r\n银行卡号：123456789\r\n开户名：1111\r\n开户地址：aaaa bbbb cccc \r\n联系电话：13899888999', '日分红|直推奖|领导奖|报单奖|金种子', '6.6', '1|2|3|4|5', '会员级别名称', '9', '100', '25', '17:00', '5', '22:30', '财付通QQ', '财付通户名', '直推奖金百分比', '虚拟对碰奖百分比', '对碰奖百分比', '见单奖', '领导奖', '领导奖封顶', 'C网见单金额 1级|2级', '', '实收达到| 税费| 进网平台费', '开户银行', '', '/A136/Public/Images/01.jpg', '/A136/Public/Images/02.jpg', '/A136/Public/Images/03.jpg', '', '', '', '', '恭喜您注册成功！请联系公司客服', '农业银行|工商银行|建设银行|招商银行', '', '你爱人叫什么名字？|你家养有什么宠物？|你的生日是多少？|你最喜欢什么？|你的出生地是？', 1412818383);
/*!40000 ALTER TABLE `xt_fee` ENABLE KEYS */;


-- 导出  表 ak1007.xt_fenhong 结构
CREATE TABLE IF NOT EXISTS `xt_fenhong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `f_num` int(11) NOT NULL DEFAULT '0',
  `f_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `pdt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_fenhong 的数据：0 rows
DELETE FROM `xt_fenhong`;
/*!40000 ALTER TABLE `xt_fenhong` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_fenhong` ENABLE KEYS */;


-- 导出  表 ak1007.xt_form 结构
CREATE TABLE IF NOT EXISTS `xt_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `baile` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_form 的数据：4 rows
DELETE FROM `xt_form`;
/*!40000 ALTER TABLE `xt_form` DISABLE KEYS */;
INSERT INTO `xt_form` (`id`, `title`, `content`, `user_id`, `create_time`, `update_time`, `status`, `baile`, `type`) VALUES
	(62, '关于完善个人资料', '<p>各位会员：</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 请大家在注册成功以后，第一时间更改个人的密码信息，密码保护问题要牢记，千万不要告诉他人，密码保护问题是保护个人资料的安全保障，请大家切记！</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 管理层启</p>', 1, 1344610084, 0, 1, 0, '1'),
	(63, '关于更改资料', '<P>各位会员：</P>\r\n<P>&nbsp;</P>\r\n<P>&nbsp;&nbsp;&nbsp; 凡需更改个人信息资料的，请提供注册时的相关个人资料信息，请留言给公司；</P>\r\n<P>&nbsp;</P>\r\n<P align=right>管理层启</P>', 1, 1344771732, 1359786635, 1, 0, '1'),
	(65, '关于提现问题；', '尊敬的各位会员好；&nbsp;今天是会员提现时间 但是有些会员没有填写 开户行的省和市 所以提款不成功&nbsp; 请各位会员检查一下&nbsp;自己填写的开户银行是否填写完整&nbsp;&nbsp;&nbsp; 望会员互相转告', 1, 1345898706, 1359786371, 1, 0, '1'),
	(66, '提现问题提现问题提现问题提现问题', '<p>大家好&nbsp; 提现的时候必须填写银行卡所在的省和市&nbsp;&nbsp; 不写省和市款无法到账</p>\r\n<p>大家好&nbsp; 提现的时候必须填写银行卡所在的省和市&nbsp;&nbsp; 不写省和市款无法到账</p>\r\n<p>大家好&nbsp; 提现的时候必须填写银行卡所在的省和市&nbsp;&nbsp; 不写省和市款无法到账</p>\r\n<p>大家好&nbsp; 提现的时候必须填写银行卡所在的省和市&nbsp;&nbsp; 不写省和市款无法到账</p>', 1, 1346834036, 1377834479, 1, 0, '1');
/*!40000 ALTER TABLE `xt_form` ENABLE KEYS */;


-- 导出  表 ak1007.xt_form_class 结构
CREATE TABLE IF NOT EXISTS `xt_form_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `baile` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_form_class 的数据：1 rows
DELETE FROM `xt_form_class`;
/*!40000 ALTER TABLE `xt_form_class` DISABLE KEYS */;
INSERT INTO `xt_form_class` (`id`, `name`, `baile`) VALUES
	(1, '新闻公告', 0);
/*!40000 ALTER TABLE `xt_form_class` ENABLE KEYS */;


-- 导出  表 ak1007.xt_gouwu 结构
CREATE TABLE IF NOT EXISTS `xt_gouwu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `lx` int(11) NOT NULL,
  `ispay` smallint(2) NOT NULL,
  `pdt` int(11) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `shu` int(11) NOT NULL,
  `cprice` decimal(12,2) NOT NULL,
  `pvzhi` decimal(12,2) NOT NULL,
  `guquan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `s_type` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `us_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `us_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `us_tel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `isfh` int(11) NOT NULL DEFAULT '0',
  `fhdt` int(11) NOT NULL DEFAULT '0',
  `okdt` int(11) NOT NULL DEFAULT '0',
  `ccxhbz` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_gouwu 的数据：0 rows
DELETE FROM `xt_gouwu`;
/*!40000 ALTER TABLE `xt_gouwu` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_gouwu` ENABLE KEYS */;


-- 导出  表 ak1007.xt_history 结构
CREATE TABLE IF NOT EXISTS `xt_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `did` int(11) NOT NULL,
  `user_did` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `action_type` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pdt` int(11) NOT NULL,
  `epoints` decimal(12,2) NOT NULL,
  `allp` decimal(12,2) NOT NULL,
  `bz` text NOT NULL,
  `type` smallint(1) NOT NULL COMMENT '充值0明细1',
  `act_pdt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23233 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_history 的数据：13 rows
DELETE FROM `xt_history`;
/*!40000 ALTER TABLE `xt_history` DISABLE KEYS */;
INSERT INTO `xt_history` (`id`, `uid`, `user_id`, `did`, `user_did`, `action_type`, `pdt`, `epoints`, `allp`, `bz`, `type`, `act_pdt`) VALUES
	(23232, 2272, '1000001', 0, '', '22', 1412847401, 1500.00, 0.00, '22', 1, 0),
	(23231, 2272, '1000001', 0, '', '22', 1412847357, 1500.00, 0.00, '22', 1, 0),
	(23230, 2272, '1000001', 0, '', '22', 1412847319, 1500.00, 0.00, '22', 1, 0),
	(23229, 1, '100000', 0, '', '5', 1412820350, -1260.00, 0.00, '5', 1, 0),
	(23228, 1, '2', 0, '', '5', 1412820350, 94.50, 0.00, '5', 1, 0),
	(23227, 1, '2', 0, '', '2', 1412820350, 175.50, 0.00, '2', 1, 0),
	(23226, 2270, '1', 0, '', '5', 1412818430, 8.75, 0.00, '5', 1, 0),
	(23225, 2270, '1', 0, '', '1', 1412818430, 16.25, 0.00, '1', 1, 0),
	(23224, 1, '1', 0, '', '5', 1412818430, 0.88, 0.00, '5', 1, 0),
	(23223, 1, '1', 0, '', '3', 1412818430, 1.62, 0.00, '3', 1, 0),
	(23222, 1, '100000', 0, '', '5', 1412818430, 8.75, 0.00, '5', 1, 0),
	(23221, 1, '100000', 0, '', '1', 1412818430, 16.25, 0.00, '1', 1, 0),
	(23220, 1, '1', 0, '', '5', 1412818424, 94.50, 0.00, '5', 1, 0),
	(23219, 1, '1', 0, '', '2', 1412818424, 175.50, 0.00, '2', 1, 0),
	(23218, 1, '100000', 0, '', '5', 1412818384, 4.34, 0.00, '5', 1, 0),
	(23217, 1, '100000', 0, '', '1', 1412818384, 8.06, 0.00, '1', 1, 0);
/*!40000 ALTER TABLE `xt_history` ENABLE KEYS */;


-- 导出  表 ak1007.xt_huikui 结构
CREATE TABLE IF NOT EXISTS `xt_huikui` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `touzi` varchar(255) NOT NULL,
  `zhuangkuang` varchar(255) NOT NULL,
  `hk` decimal(12,2) NOT NULL,
  `time_hk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 正在导出表  ak1007.xt_huikui 的数据：0 rows
DELETE FROM `xt_huikui`;
/*!40000 ALTER TABLE `xt_huikui` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_huikui` ENABLE KEYS */;


-- 导出  表 ak1007.xt_jiadan 结构
CREATE TABLE IF NOT EXISTS `xt_jiadan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adt` int(11) NOT NULL,
  `pdt` int(11) NOT NULL,
  `money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `danshu` smallint(5) NOT NULL DEFAULT '0' COMMENT '单数',
  `is_pay` smallint(3) NOT NULL DEFAULT '0',
  `up_level` smallint(2) NOT NULL DEFAULT '0',
  `out_level` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_jiadan 的数据：0 rows
DELETE FROM `xt_jiadan`;
/*!40000 ALTER TABLE `xt_jiadan` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_jiadan` ENABLE KEYS */;


-- 导出  表 ak1007.xt_jiaoyi 结构
CREATE TABLE IF NOT EXISTS `xt_jiaoyi` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `nums` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总需交易量',
  `end_nums` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '剩余需交易量',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `danjia` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `time` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `cz` tinyint(4) NOT NULL DEFAULT '0' COMMENT '操作 0:卖 1:买',
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 正在导出表  ak1007.xt_jiaoyi 的数据：~0 rows (大约)
DELETE FROM `xt_jiaoyi`;
/*!40000 ALTER TABLE `xt_jiaoyi` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_jiaoyi` ENABLE KEYS */;


-- 导出  表 ak1007.xt_jydt 结构
CREATE TABLE IF NOT EXISTS `xt_jydt` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(50) NOT NULL,
  `agent_use` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zhen_use` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shui_use` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '状态',
  `before_time` bigint(10) NOT NULL DEFAULT '0' COMMENT '购买时间',
  `after_time` bigint(10) NOT NULL DEFAULT '0' COMMENT '完成时间',
  `time` bigint(10) NOT NULL DEFAULT '0' COMMENT '发行时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='交易大厅';

-- 正在导出表  ak1007.xt_jydt 的数据：~3 rows (大约)
DELETE FROM `xt_jydt`;
/*!40000 ALTER TABLE `xt_jydt` DISABLE KEYS */;
INSERT INTO `xt_jydt` (`id`, `uid`, `user_id`, `agent_use`, `zhen_use`, `shui_use`, `status`, `before_time`, `after_time`, `time`) VALUES
	(1, 1, '1', 1000.00, 1000.00, 0.00, 2, 1412739609, 1412739878, 1412739426),
	(2, 1, '1', 100.00, 105.00, 5.00, 3, 1412740753, 1412740788, 1412740693),
	(3, 1, '1', 100.00, 105.00, 5.00, 2, 1412740806, 1412740822, 1412740732);
/*!40000 ALTER TABLE `xt_jydt` ENABLE KEYS */;


-- 导出  表 ak1007.xt_msg 结构
CREATE TABLE IF NOT EXISTS `xt_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isid` int(11) DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `msg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `r_uid` int(11) NOT NULL,
  `r_user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `s_uid` int(11) NOT NULL,
  `s_user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_read` smallint(3) NOT NULL,
  `pdt` int(11) DEFAULT NULL,
  `is_type` smallint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_msg 的数据：0 rows
DELETE FROM `xt_msg`;
/*!40000 ALTER TABLE `xt_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_msg` ENABLE KEYS */;


-- 导出  表 ak1007.xt_news_a 结构
CREATE TABLE IF NOT EXISTS `xt_news_a` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `n_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `n_content` text COLLATE utf8_unicode_ci NOT NULL,
  `n_top` int(11) NOT NULL DEFAULT '0',
  `n_status` tinyint(1) NOT NULL DEFAULT '1',
  `n_create_time` int(11) NOT NULL,
  `n_update_time` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_news_a 的数据：0 rows
DELETE FROM `xt_news_a`;
/*!40000 ALTER TABLE `xt_news_a` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_news_a` ENABLE KEYS */;


-- 导出  表 ak1007.xt_news_class 结构
CREATE TABLE IF NOT EXISTS `xt_news_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `type` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_news_class 的数据：7 rows
DELETE FROM `xt_news_class`;
/*!40000 ALTER TABLE `xt_news_class` DISABLE KEYS */;
INSERT INTO `xt_news_class` (`id`, `title`, `create_time`, `type`) VALUES
	(5, '成衣', 1295838556, 0),
	(6, '汽车', 1295838667, 0),
	(7, '食品', 1295838691, 1),
	(8, '包包', 1295840380, 0),
	(9, '数码', 1295853018, 0),
	(10, '日常用品', 1295853092, 2),
	(11, '电子产品', 1295921932, 2);
/*!40000 ALTER TABLE `xt_news_class` ENABLE KEYS */;


-- 导出  表 ak1007.xt_peng 结构
CREATE TABLE IF NOT EXISTS `xt_peng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(12) NOT NULL,
  `ceng` int(12) NOT NULL,
  `l` int(12) NOT NULL,
  `r` int(12) NOT NULL,
  `l1` int(12) NOT NULL,
  `r1` int(12) NOT NULL,
  `l2` int(12) NOT NULL,
  `r2` int(12) NOT NULL,
  `l3` int(12) NOT NULL,
  `r3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_peng 的数据：0 rows
DELETE FROM `xt_peng`;
/*!40000 ALTER TABLE `xt_peng` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_peng` ENABLE KEYS */;


-- 导出  表 ak1007.xt_plan 结构
CREATE TABLE IF NOT EXISTS `xt_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '奖励计划',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_plan 的数据：5 rows
DELETE FROM `xt_plan`;
/*!40000 ALTER TABLE `xt_plan` DISABLE KEYS */;
INSERT INTO `xt_plan` (`id`, `content`) VALUES
	(1, '<P>奖励计划</P>\r\n<P>\r\n<HR>\r\n\r\n<P></P>\r\n<P>&nbsp;</P>'),
	(2, '<p>客服QQ</p>\r\n<p>&nbsp;</p>\r\n<div style="margin:5px;" align="right">2011-12-20 14:26:04</div>'),
	(3, '<p>创富亮点</p>'),
	(4, '<p>金币中心申请说明：</p>\r\n<p><br />\r\n金币中心名单： </p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),
	(5, '123123');
/*!40000 ALTER TABLE `xt_plan` ENABLE KEYS */;


-- 导出  表 ak1007.xt_product 结构
CREATE TABLE IF NOT EXISTS `xt_product` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `cid` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cptype` int(11) NOT NULL DEFAULT '0',
  `ccname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `xhname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `money` decimal(12,2) DEFAULT '0.00',
  `a_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `b_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `create_time` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `yc_cp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_product 的数据：1 rows
DELETE FROM `xt_product`;
/*!40000 ALTER TABLE `xt_product` DISABLE KEYS */;
INSERT INTO `xt_product` (`id`, `cid`, `name`, `cptype`, `ccname`, `xhname`, `money`, `a_money`, `b_money`, `create_time`, `content`, `img`, `yc_cp`) VALUES
	(18, 'MGVIP100020001', '公司产品', 1, '', '', 500.00, 0.00, 0.00, 1380982893, '<p>MGVIP100020001</p>', '', 0);
/*!40000 ALTER TABLE `xt_product` ENABLE KEYS */;


-- 导出  表 ak1007.xt_promo 结构
CREATE TABLE IF NOT EXISTS `xt_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` decimal(12,2) NOT NULL,
  `money_two` decimal(12,2) NOT NULL,
  `u_level` smallint(3) NOT NULL DEFAULT '0' COMMENT '升级前级别',
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `up_level` smallint(3) NOT NULL COMMENT '升级后级别',
  `danshu` smallint(2) NOT NULL COMMENT '单数',
  `pdt` int(11) NOT NULL,
  `is_pay` smallint(3) NOT NULL DEFAULT '0',
  `u_bank_name` smallint(2) NOT NULL DEFAULT '0' COMMENT '汇款银行',
  `type` smallint(2) NOT NULL DEFAULT '0' COMMENT '0标示晋级，1标示加单',
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_promo 的数据：0 rows
DELETE FROM `xt_promo`;
/*!40000 ALTER TABLE `xt_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_promo` ENABLE KEYS */;


-- 导出  表 ak1007.xt_times 结构
CREATE TABLE IF NOT EXISTS `xt_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benqi` int(11) NOT NULL COMMENT '本期结算日期',
  `shangqi` int(11) NOT NULL COMMENT '上期结算日期',
  `is_count_b` int(11) NOT NULL,
  `is_count_c` int(11) NOT NULL,
  `is_count` int(11) NOT NULL,
  `type` smallint(2) NOT NULL DEFAULT '0' COMMENT '是否已经结算',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_times 的数据：1 rows
DELETE FROM `xt_times`;
/*!40000 ALTER TABLE `xt_times` DISABLE KEYS */;
INSERT INTO `xt_times` (`id`, `benqi`, `shangqi`, `is_count_b`, `is_count_c`, `is_count`, `type`) VALUES
	(114, 1412870399, 1262275200, 0, 0, 0, 0);
/*!40000 ALTER TABLE `xt_times` ENABLE KEYS */;


-- 导出  表 ak1007.xt_tiqu 结构
CREATE TABLE IF NOT EXISTS `xt_tiqu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rdt` int(11) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `money_two` decimal(12,2) NOT NULL,
  `epoint` decimal(12,2) NOT NULL,
  `is_pay` int(11) NOT NULL,
  `user_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bank_card` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `x1` varchar(50) DEFAULT NULL,
  `x2` varchar(50) DEFAULT NULL,
  `x3` varchar(50) DEFAULT NULL,
  `x4` varchar(50) DEFAULT NULL,
  `bank_address` varchar(200) NOT NULL,
  `user_tel` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_tiqu 的数据：0 rows
DELETE FROM `xt_tiqu`;
/*!40000 ALTER TABLE `xt_tiqu` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_tiqu` ENABLE KEYS */;


-- 导出  表 ak1007.xt_ulevel 结构
CREATE TABLE IF NOT EXISTS `xt_ulevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` decimal(12,2) DEFAULT NULL,
  `u_level` smallint(3) DEFAULT '0' COMMENT '升级前级别',
  `uid` int(11) DEFAULT NULL,
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `up_level` smallint(3) DEFAULT NULL COMMENT '升级后级别',
  `danshu` smallint(2) DEFAULT NULL COMMENT '单数',
  `pdt` int(11) DEFAULT NULL,
  `is_pay` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_ulevel 的数据：0 rows
DELETE FROM `xt_ulevel`;
/*!40000 ALTER TABLE `xt_ulevel` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_ulevel` ENABLE KEYS */;


-- 导出  表 ak1007.xt_xiaof 结构
CREATE TABLE IF NOT EXISTS `xt_xiaof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rdt` int(11) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `money_two` int(11) NOT NULL DEFAULT '0',
  `epoint` decimal(12,2) NOT NULL,
  `fh_money` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_pay` int(11) NOT NULL,
  `user_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bank_card` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `x1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `x2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `x3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `x4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 正在导出表  ak1007.xt_xiaof 的数据：0 rows
DELETE FROM `xt_xiaof`;
/*!40000 ALTER TABLE `xt_xiaof` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_xiaof` ENABLE KEYS */;


-- 导出  表 ak1007.xt_zhuanj 结构
CREATE TABLE IF NOT EXISTS `xt_zhuanj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) DEFAULT NULL,
  `out_uid` int(11) DEFAULT NULL,
  `in_userid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `out_userid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `epoint` decimal(12,2) DEFAULT NULL,
  `rdt` int(11) DEFAULT NULL,
  `sm` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

-- 正在导出表  ak1007.xt_zhuanj 的数据：0 rows
DELETE FROM `xt_zhuanj`;
/*!40000 ALTER TABLE `xt_zhuanj` DISABLE KEYS */;
/*!40000 ALTER TABLE `xt_zhuanj` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
