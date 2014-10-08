<?php

class FckModel extends CommonModel {

    //数据库名称

    public function xiangJiao($Pid = 0, $DanShu = 1) {
        //========================================== 往上统计单数
        $where = array();
        $where['id'] = $Pid;
        $field = 'treeplace,father_id';
        $vo = $this->where($where)->field($field)->find();
        if ($vo) {
            $Fid = $vo['father_id'];
            $TPe = $vo['treeplace'];
            $table = $this->tablePrefix . 'fck';
            if ($TPe == 0 && $Fid > 0) {
                $this->execute("update " . $table . " Set `l`=l+$DanShu, `benqi_l`=benqi_l+$DanShu  where `id`=" . $Fid);
            } elseif ($TPe == 1 && $Fid > 0) {
                $this->execute("update " . $table . " Set `r`=r+$DanShu, `benqi_r`=benqi_r+$DanShu  where `id`=" . $Fid);
            } elseif ($TPe == 2 && $Fid > 0) {
                $this->execute("update " . $table . " Set `lr`=lr+$DanShu, `benqi_lr`=benqi_lr+$DanShu  where `id`=" . $Fid);
            }
            if ($Fid > 0)
                $this->xiangJiao($Fid, $DanShu);
        }
        unset($where, $field, $vo);
    }

//	public function xiangJiao($Pid=0,$DanShu=1,$plv=0,$op=1){
//        //========================================== 往上统计单数【有层碰奖】
//
//        $peng = M ('peng');
//        $where = array();
//        $where['id'] = $Pid;
//        $field = 'treeplace,father_id,p_level';
//        $vo = $this ->where($where)->field($field)->find();
//        if ($vo){
//            $Fid = $vo['father_id'];
//            $TPe = $vo['treeplace'];
//            $table = $this->tablePrefix .'fck';
//			$dt	= strtotime(date("Y-m-d"));//现在的时间
//            if ($TPe == 0 && $Fid > 0){
//            	$p_rs = $peng ->where("uid=$Fid and ceng = $op") ->find();
//            	if($p_rs){
//            		$peng->execute("UPDATE __TABLE__ SET `l`=l+{$DanShu}  WHERE uid=$Fid and ceng = $op");
//            	}else{
//            		$peng->execute("INSERT INTO __TABLE__ (uid,ceng,l) VALUES ($Fid	,$op,$DanShu) ");
//            	}
//
//                $this->execute("UPDATE ". $table ." SET `l`=l+{$DanShu}, `benqi_l`=benqi_l+{$DanShu}  WHERE `id`=".$Fid);
//            }elseif($TPe == 1 && $Fid > 0){
//            	$p_rs = $peng ->where("uid=$Fid and ceng = $op") ->find();
//            	if($p_rs){
//            		$peng->execute("UPDATE __TABLE__ SET `r`=r+{$DanShu}  WHERE uid=$Fid and ceng = $op");
//            	}else{
//            		$peng->execute("INSERT INTO __TABLE__ (uid,ceng,r) VALUES ($Fid,$op,$DanShu) ");
//            	}
//                $this->execute("UPDATE ". $table ." SET `r`=r+{$DanShu}, `benqi_r`=benqi_r+{$DanShu}  WHERE `id`=".$Fid);
//            }
//            $op++;
//            if ($Fid > 0) $this->xiangJiao($Fid,$DanShu,$plv,$op);
//        }
//        unset($where,$field,$vo);
//    }

    public function addencAdd($ID = 0, $inUserID = 0, $money = 0, $name = null, $UID = 0, $time = 0, $acttime = 0, $bz = "") {
        //添加 到数据表
        if ($UID > 0) {
            $where = array();
            $where['id'] = $UID;
            $frs = $this->where($where)->field('nickname')->find();
            $name_two = $name;
            $name = $frs['nickname'] . ' 开通会员 ' . $inUserID;
            $inUserID = $frs['nickname'];
        } else {
            $name_two = $name;
        }

        $data = array();
        $history = M('history');

        $data['user_id'] = $inUserID;
        $data['uid'] = $ID;
        $data['action_type'] = $name;
        if ($time > 0) {
            $data['pdt'] = $time;
        } else {
            $data['pdt'] = mktime();
        }
        $data['epoints'] = $money;
        if (!empty($bz)) {
            $data['bz'] = $bz;
        } else {
            $data['bz'] = $name;
        }
        $data['did'] = 0;
        $data['type'] = 1;
        $data['allp'] = 0;
        if ($acttime > 0) {
            $data['act_pdt'] = $acttime;
        }
        $history->add($data);
        unset($data, $history);
    }

    public function huikuiAdd($ID = 0, $tz = 0, $zk, $money = 0, $nowdate = null) {
        //添加 到数据表

        $data = array();
        $huikui = M('huikui');
        $data['uid'] = $ID;
        $data['touzi'] = $tz;
        $data['zhuangkuang'] = $zk;
        $data['hk'] = $money;
        $data['time_hk'] = $nowdate;
        $huikui->add($data);
        unset($data, $huikui);
    }

    //对碰1：1
    public function touch1to1(&$Encash, $xL = 0, $xR = 0, &$NumS = 0) {
        $xL = floor($xL);
        $xR = floor($xR);

        if ($xL > 0 && $xR > 0) {
            if ($xL > $xR) {
                $NumS = $xR;
                $xL = $xL - $NumS;
                $xR = $xR - $NumS;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            if ($xL < $xR) {
                $NumS = $xL;
                $xL = $xL - $NumS;
                $xR = $xR - $NumS;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            if ($xL == $xR) {
                $NumS = $xL;
                $xL = 0;
                $xR = 0;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            $Encash['2'] = $NumS;
        } else {
            $NumS = 0;
            $Encash['0'] = 0;
            $Encash['1'] = 0;
        }
    }

    //对碰奖
    public function duipeng() {
        $fee = M('fee');

        $fee_rs = $fee->field('s1,s15,s5,s9,s7,s12,str2')->find(1);
        $s1 = explode("|", $fee_rs['s12']);  //各级对碰比例
        $s9 = explode("|", $fee_rs['s9']);  //会员级别费用
        $s7 = explode("|", $fee_rs['s7']);  //
        $s5 = explode("|", $fee_rs['str2']);  //封顶
//        $fbl = $fee_rs['s11'] / 100;
        $fck_array = 'is_pay>=1 and ((shangqi_l+benqi_l)>0 or (shangqi_r+benqi_r)>0)';
        $field = 'id,user_id,shangqi_l,shangqi_r,benqi_l,benqi_r,re_path,re_level,re_nums,nickname,u_level,re_id,day_feng,peng_num';
        $frs = $this->where($fck_array)->field($field)->select();
        //BenQiL  BenQiR  ShangQiL  ShangQiR
        foreach ($frs as $vo) {
            $L = 0;
            $R = 0;
            $L = $vo['shangqi_l'] + $vo['benqi_l'];
            $R = $vo['shangqi_r'] + $vo['benqi_r'];
            $Encash = array();
            $NumS = 0; //碰数
            $money = 0; //对碰奖金额
            $Ls = 0; //左剩余
            $Rs = 0; //右剩余
            $this->touch1to1($Encash, $L, $R, $NumS);
            $Ls = $L - $Encash['0'];
            $Rs = $R - $Encash['1'];
            $ss = $vo['u_level'] - 1;
            $feng = $vo['day_feng'];
            $re_nums = $vo['re_nums'];
            $peng_n = $vo['peng_num'];
            $ul = $s1[$ss] / 100; //对碰比例 0.2
            $pri = $ul * $s9[0]; //1单的对碰奖
            $money = $NumS * $pri; //对碰奖 奖金
            if ($feng >= $s5[$ss]) {
                $money = 0;
            } else {
                $jfeng = $feng + $money;
                if ($jfeng > $s5[$ss]) {
                    $money = $s5[$ss] - $feng;
                }
            }

            $this->query('UPDATE __TABLE__ SET `shangqi_l`=' . $Ls . ',`shangqi_r`=' . $Rs . ',`benqi_l`=0,`benqi_r`=0,peng_num=peng_num+' . $NumS . ' where `id`=' . $vo['id']);

            if ($money > 0) {
                $this->query("UPDATE __TABLE__ SET `b2`=b2+" . $money . ",day_feng=day_feng+" . $money . " where `id`=" . $vo['id']);

                $this->addencAdd($vo['id'], $vo['user_id'], $money, 2); //添加奖金和记录
                //培育+互助
//                $this->lingdao($vo['id'], $vo['re_path'], $vo['user_id'], $money, $vo['re_level']);
                $this->bole($vo['re_path'], $vo['user_id'], $money);
                $this->chongxiao($vo['id'], $vo['user_id'], $money);
            }
        }
    }

    public function getusjj($uid, $type = 0) {

        $mrs = $this->where('id=' . $uid)->find();
        if ($mrs) {
            $this->a_add($uid, $mrs['re_id'], $mrs['user_id'], $mrs['cpzj']); //大公排
            $this->check_baodan($mrs['re_id']);
            $this->tuijianjiang($mrs['re_id'], $mrs['user_id'], $mrs['cpzj']);
            if ($type == 1) {
                //报单奖
                $this->baodanfei($mrs['shop_id'], $mrs['user_id'], $mrs['cpzj']);
            }
        }
        unset($mrs);
    }

    public function a_add($uid, $re_id, $user_id) {
//        $where = "p_path like '%{$re_id}%' or id={$re_id}";
        $where = "is_pay>0";
        $fck_rs = $this->where($where)->order("pdt asc")->select();
        foreach ($fck_rs as $rs) {
            $fck_rss = $this->where("father_id={$rs['id']}")->order('pdt asc')->select();
            $count = $this->where("father_id={$rs['id']}")->order('pdt asc')->count();

            if ($count < 2) {  //判断 该用户下面还有空位
                $father_id = $rs['id'];
                $father_name = $rs['user_id'];
                $p_level = $rs['p_level'] + 1;
                $p_path = $rs['p_path'] . $rs['id'] . ",";
                if ($count == 0) {  //下面没有用户
                    $treeplace = 0;
                } else if ($count == 1) { //下面有一名用户
                    $treeplace = 1;
                }

                $time = time();
                $path = "is_pay=1,pdt={$time},treeplace=" . $treeplace . ",father_id=" . $father_id . ",father_name='" . $father_name . "',p_level=" . $p_level . ",p_path='" . $p_path . "',pdt={$time}";
                $this->query("update __TABLE__ set {$path} where id=" . $uid);
                break;
            }
        }
    }

    public function lingdaojiang($money, $p_path, $user_id) {
        if ($money > 0) {
            $fee = M('fee');
            $fee_rs = $fee->field('s12,s5')->find(1);
            $s12 = $fee_rs['s12']; //金币
            $s5 = $fee_rs['s5'];  //种子
            $fck_rs = $this->where("id in (0{$p_path}0)")->order("pdt desc")->limit('0,9')->select();
//            $end_money=$s1*$money;
//            $b5 = 0;
//            $this->zhuanhuan($end_money, $b5);
            $l = 1;
            foreach ($fck_rs as $rs) {
                if ($rs['re_nums'] >= $l && $rs['real_name'] == '') { //推荐人数大于代数且不是新增账号
                    $this->query("update __TABLE__ set b3=b3+{$s12},b5=b5+{$s5} where id=" . $rs['id']);
                    $this->addencAdd($rs['id'], $user_id, $s12, 3);
                    $this->addencAdd($rs['id'], $user_id, $s5, 5);
                }

                $l++;
            }
        }
    }

    public function rifenhong() {
        $fee = M('fee');
        $fee_rs = $fee->field('str4,s19,s6')->find(1);
        $str4 = $fee_rs['str4']; //分红金币
        $s19 = $fee_rs['s19']; //分红种子
        $s6 = $fee_rs['s6'];     //封顶
        $n=$s19/$s6;//比例
        $fck_rs = $this->where("is_pay=1 and fengding<{$s6}")->select();
        foreach ($fck_rs as $rs) {
            $money1=($rs['re_nums']+1)*$str4;
            $_s19=($rs['re_nums']+1)*$s19;
            if ($money1 + $rs['fengding'] > $s6) {
                $money = $s6 - $rs['fengding'];
                $money = $money > 0 ? $money : 0;
                $s199=$money/$n;
            } else {
                $money = $money1;
                $s199=$_s19;
            }
            $this->lingdaojiang($money, $rs['re_path'], $rs['user_id']);
//            $b5 = 0;
//            $this->zhuanhuan($money, $b5);
            $fengding=$money;
            $this->query("update __TABLE__ set b1=b1+{$money},b5=b5+{$s199},fengding=fengding+{$fengding} where id=" . $rs['id']);
            $this->query("update __TABLE__ set agent_use_mr=0,agent_zz_mr=0");
            $this->addencAdd($rs['id'], $rs['user_id'], $money, 1);
            $this->addencAdd($rs['id'], $rs['user_id'], $s199, 5);
        }
    }

    //直推奖+极差
    public function tuijianjiang($re_id = 0, $inUserID = 0, $money = 0) {

        $fee = M('fee');
        $fee_rs = $fee->field('s3')->find(1);
        $s3 = $fee_rs['s3'] / 100;  //提成点
        if ($money > 0) {
            $end_money = $money * $s3;
            $money = $end_money;
            $b5 = 0;
            $this->zhuanhuan($money, $b5);
//            $this->check_real($re_id); //检测是否是增位
            $this->query("update __TABLE__ set b2=b2+{$money},b5=b5+{$b5} where id=" . $re_id);
            $this->addencAdd($re_id, $inUserID, $money, 2);
            $this->addencAdd($re_id, $inUserID, $b5, 5);
        }

        unset($fee, $fee_rs, $ffrs);
    }

    public function check_real(&$id) {
        $rs = $this->field('real_name,re_id')->find($id);
        if ($rs['real_name'] != '') {
            $id = $rs['re_id'];
        }
    }

    //检查升级报单中心
    public function check_baodan($re_id) {
        $fee = M('fee');
        $fee_rs = $fee->field('str2,s7')->find(1);
        $str2 = $fee_rs['str2'];  //条件
        $s7 = $fee_rs['s7'] / 100;  //报单奖
        $fck_rs = $this->field('re_nums,is_pay')->find($re_id);
        $re_nums = $fck_rs['re_nums'];
        $is_pay = $fck_rs['is_pay'];
        if ($is_pay <= 1 && $re_nums >= $str2) {
            $this->query('update __TABLE__ set is_agent=2 where id=' . $re_id);
        }
    }

    public function xinzeng($uid) {//新增点位  //尚未解决问题:未知晓是自动还是手动
        $fee = M('fee');
        $fee_rs = $fee->field('s13,s9')->find();
        $s13 = $fee_rs['s13']; //扣除的金种子
        $s9 = $fee_rs['s9'];
        $fck_rss = $this->find($uid);
        $real_nums = $fck_rss['real_nums'] + 1;
        $s133=$s13+60;
        if ($fck_rss['agent_zz'] >= $s13) {
            $this->execute("update __TABLE__ set agent_zz=agent_zz-{$s13},real_nums=real_nums+1 where id=" . $uid);
            $this->addencAdd($uid, $fck_rss['user_id'], -$s13, 5);
            $arr = $this->pai($uid);
            $data = array(
                shop_id => $fck_rss['shop_id'],
                shop_name => $fck_rss['shop_name'],
                re_id => $uid,
                re_name => $fck_rss['re_name'],
                re_level => '1',
                user_id => $fck_rss['user_id'] . $real_nums, //新点位账号
                bind_account => '3333',
                last_login_ip => '',
                verify => '0',
                status => '1',
                type_id => '0',
                last_login_time => '0',
                login_count => '0',
                info => '信息',
                name => '名称',
                password => $fck_rss['password'],
                passopen => $fck_rss['passopen'],
                pwd1 => $fck_rss['pwd1'],
                pwd2 => $fck_rss['pwd2'],
                wenti => '你爱人叫什么名字？',
                wenti_dan => 'xx',
                bank_name => '农业银行',
                bank_card => '11122',
                user_name => '222',
                nickname => '483615',
                bank_province => '请选择',
                bank_city => '请选择',
                bank_address => '4554',
                user_code => '888',
                user_address => '888',
                email => '888',
                qq => '8888',
                user_tel => '138',
                is_pay => '1',
                rdt => time(),
                u_level => '1',
                cpzj => $s9,
                f4 => '1',
                wlf => '0',
                pdt => time(),
                open => 1,
                p_path => $arr[0],
                treeplace => $arr[1],
                p_level => $arr[2],
                father_id => $arr[3],
                father_name => $arr[4],
                real_name => $fck_rss['user_id'],
                real_id => $real_nums
            );
            $id = $this->add($data);
        }
    }

    public function pai($uid) {
        $where = "p_path like '%{$uid}%' or id={$uid}";
        $fck_rs = $this->where($where)->order("pdt asc")->select();
        foreach ($fck_rs as $rs) {
            $fck_rss = $this->where("father_id={$rs['id']}")->order('pdt asc')->select();
            $count = $this->where("father_id={$rs['id']}")->order('pdt asc')->count();
            if ($count < 2) {  //判断 该用户下面还有空位
                $father_id = $rs['id'];
                $father_name = $rs['user_id'];
                $p_level = $rs['p_level'] + 1;
                $p_path = $rs['p_path'] . $rs['id'] . ",";
                if ($count == 0) {  //下面没有用户
                    $treeplace = 0;
                } else if ($count == 1) { //下面有一名用户
                    $treeplace = 1;
                }
                return array($p_path, $treeplace, $p_level, $father_id, $father_name);
                break;
            }
        }
    }

    //报单费
    public function baodanfei($uid, $user_id = 0, $cpzj) {
        $fee = M('fee');
        $fee_rs = $fee->field('s7')->find();
        $str2 = $fee_rs['s7'] / 100;
        $money_count = $str2 * $cpzj;
//        $b5 = 0;
//        $this->zhuanhuan($money_count, $b5);
        if ($money_count > 0) { //\
            $this->query("UPDATE __TABLE__ SET `b4`=b4+" . $money_count . " where `id`=" . $uid);
            $this->addencAdd($uid, $user_id, $money_count, 4);
        }
        unset($fee, $fee_rs);
    }

    public function zhuanhuan(&$money, &$b5) {
        $fee = M('fee');
        $fee_rs = $fee->field('s15,s14')->find();
        $s15 = $fee_rs['s15'] / 100;
        $s14 = $fee_rs['s14'] / 100;
        $end_money = $money * $s15;
        $b5 = round($money * $s14, 2);
        $money = $money - $b5;
    }

    //扣税
    public function ap_koushui() {

        $fee = M('fee');
        $fee_rs = $fee->field('s7')->find();
        $s7 = $fee_rs['s7'] / 100; //税

        $where = array();
        $where['b0'] = array('gt', 0);
        $mrs = $this->where($where)->field('id,user_id,b0')->select();
        foreach ($mrs as $vo) {
            $inUserID = $vo['user_id'];
            $ccc = $vo['b0'] * $s7;
            $kb_mon = $ccc;
            $this->query("UPDATE __TABLE__ SET `b4`=b4-" . $kb_mon . " where `id`=" . $vo['id'] . " ");
            $this->addencAdd($vo['id'], $inUserID, -$kb_mon, 4);
        }
        unset($mrs);
    }

    //扣网络税
    public function ap_wlf() {

        $fee = M('fee');
        $fee_rs = $fee->field('str2')->find();
        $str2 = $fee_rs['str2'];

        $where = array();
        $where['wlf'] = array('eq', 0);
        $where['b0'] = array('gt', 0);
        $where['is_fenh'] = array('eq', 0);
        $lirs = $this->where($where)->field('id,b0,wlf,wlf_money')->select();
        foreach ($lirs as $mrs) {
            $myid = $mrs['id'];
            $get_mon = $mrs['b0'];
            $wlf_money = $mrs['wlf_money'];
            $all_mm = $wlf_money + $get_mon;
            $k_mon = 0;
            if ($all_mm >= $str2) {
                $k_mon = $str2 - $wlf_money;
                $this->execute("UPDATE __TABLE__ SET wlf=" . mktime() . " where `id`=" . $myid . " and wlf=0");
            } else {
                $k_mon = $get_mon;
            }
            if ($k_mon < 0) {
                $k_mon = 0;
            }
            if ($k_mon > 0) {
                $this->execute("UPDATE __TABLE__ SET `b7`=b7-" . $k_mon . ",wlf_money=wlf_money+" . $k_mon . " where `id`=" . $myid);
            }
        }
        unset($fee, $str2, $lirs, $mrs);
    }

    public function add_xf($uid, $user_id, $money = 0, $gnum = 0) {

        $fenhong = M('fenhong');

        $data = array();
        $data['uid'] = $uid;
        $data['user_id'] = $user_id;
        $data['f_num'] = $gnum;
        $data['f_money'] = $money;
        $data['pdt'] = mktime();
        $fenhong->add($data);

        unset($fenhong, $data);
    }

    //日封顶
    public function ap_rifengding() {

        $fee = M('fee');
        $fee_rs = $fee->field('s5')->find();
        $s5 = explode("|", $fee_rs['s5']); //日封顶
        $where = array();
        $where['b0'] = array('gt', 0);
        $mrs = $this->where($where)->field('id,b0,day_feng,u_level')->select();
        foreach ($mrs as $vo) {
            $day_feng = $vo['day_feng'];
            $ss = $vo['u_level'] - 1;
            $bbb = $vo['b0'];
            $fedd = $s5[$ss]; //封顶
            $get_money = $bbb;
            $all_money = $bbb + $day_feng;
            if ($all_money > $fedd) {
                $get_money = $fedd - $day_feng;
            }
            if ($get_money < 0) {
                $get_money = 0;
            }
            if ($get_money >= 0) {
                $this->query("UPDATE __TABLE__ SET `b0`=" . $get_money . ",day_feng=day_feng+" . $get_money . " where `id`=" . $vo['id']);
            }
        }
        unset($mrs);
    }

    //总封顶
    public function ap_zongfengding() {

        $fee = M('fee');
        $fee_rs = $fee->field('s15')->find();
        $s15 = $fee_rs['s15'];

        $where = array();
        $where['b0'] = array('gt', 0);
        $where['_string'] = 'b0+zjj>' . $s15;
        $mrs = $this->where($where)->field('id,b0,zjj')->select();
        foreach ($mrs as $vo) {
            $zjj = $vo['zjj'];
            $bbb = $vo['b0'];
            $get_money = $s15 - $zjj;

            if ($get_money > 0) {
                $this->query("UPDATE __TABLE__ SET `b0`=" . $get_money . " where `id`=" . $vo['id']);
            }
        }
        unset($mrs);
    }

    //电子钱包
    public function dzqb() {
        $fee = M('fee');
        $fee_rs = $fee->field('s13,s6')->find();
        $s13 = $fee_rs['s13'] / 100; //扣除比例
        $s6 = $fee_rs['s6']; //上限

        $fck_rs = $this->where("b0>0")->select();
        foreach ($fck_rs as $rs) {
            $b0 = $rs['b0'];
            $agent_qb = $rs['agent_qb'];
            $end_b0 = $b0 * $s13;
            if ($agent_qb < $s6) {
                if ($agent_qb + $end_b0 > $s6) {
                    $end_b0 = $s6 - $agent_qb;
                }
                $this->query("UPDATE __TABLE__ SET `b7`=b7-" . $end_b0 . ",agent_qb=agent_qb+{$end_b0} where `id`=" . $rs['id']);
                $this->addencAdd($rs['id'], $rs['user_id'], -$end_b0, 7);
            }
        }
    }

    //奖金大汇总（包括扣税等）
    public function quanhuizong() {
        $fee = M('fee');
        $fee_rs = $fee->field('s13')->find();
        $s13 = $fee_rs['s13'];
        $this->execute('UPDATE __TABLE__ SET `b0`=b1+b2+b3+b4+b6+b7+b8');
        $this->execute('UPDATE __TABLE__ SET `b0`=0,b1=0,b2=0,b3=0,b4=0,b5=0,b6=0,b7=0,b8=0,b9=0,b10=0 where is_fenh=1');
        $this->query("update __TABLE__ set agent_use_mr=agent_use_mr+b0,agent_zz_mr=agent_zz_mr+b5,agent_zz=agent_zz+b5,b5=0 where b5!=0");
        $fck_rs = $this->where('agent_zz>=' . $s13)->field('id')->select();
        foreach ($fck_rs as $rs) { //增位
            $this->xinzeng($rs['id']);
        }
        $this->execute("UPDATE __TABLE__ SET `b0`=b1+b2+b3+b4+b5+b6+b7");
//        $this->ap_rifengding();
//        $this->fuli();
//        $this->execute('UPDATE __TABLE__ SET `b0`=b1+b2+b3+b4+b5');
//        $this->dzqb();
//        $this->wangluo();
//        $this->execute('UPDATE __TABLE__ SET `b0`=b1+b2+b3+b4+b5+b6+b7');
    }

    //清空时间
    public function emptyTime() {

        $nowdate = strtotime(date('Y-m-d'));

        $this->query("UPDATE `xt_fck` SET `day_feng`=0,_times=" . $nowdate . " WHERE _times !=" . $nowdate . "");
    }

    public function bobifengding() {

        $fee = M('fee');
        $bonus = M('bonus');
        $fee_rs = M('fee')->find();
        $table = $this->tablePrefix . 'fck';
        $z_money = 0; //总支出
        $z_money = $this->where('is_pay = 1')->sum('b2');
        $times = M('times');
        $trs = $times->order('id desc')->field('shangqi')->find();
        if ($trs) {
            $benqi = $trs['shangqi'];
        } else {
            $benqi = strtotime(date('Y-m-d'));
        }
        $zsr_money = 0; //总收入
        $zsr_money = $this->where('pdt>=' . $benqi . ' and is_pay=1')->sum('cpzj');
        $bl = $z_money / $zsr_money;
        $fbl = $fee_rs['s11'] / 100;
        if ($bl > $fbl) {
            //$bl = $fbl;
            //$xbl = $bl - $fbl;
            $z_o1 = $zsr_money * $fbl;
            $z_o2 = $z_o1 / $z_money;
            $this->query("UPDATE " . $table . " SET `b2`=b2*{$z_o2} where `is_pay`>=1 ");
        }
    }

    /*
      奖金开始=======================================================================
      ===============================================================================
     */

    public function clearing($type1 = 0, $type2 = 0, $type3 = 0) {
        //========================奖金结算
        $times = M('times');
        $bonus = M('bonus');
        $nowdate = strtotime(date('Y-m-d'));
        $settime_two['benqi'] = $nowdate;
        $settime_two['type'] = 0;
        $trs = $times->where($settime_two)->find();
        if (!$trs) {
            $rs3 = $times->where('type=0')->order('id desc')->find();
            if ($rs3) {
                $data['shangqi'] = $rs3['benqi'];
                $data['benqi'] = $nowdate;
                $data['is_count'] = 0;
                $data['type'] = 0;
            } else {
                $data['shangqi'] = strtotime('2010-01-01');
                $data['benqi'] = $nowdate;
                $data['is_count'] = 0;
                $data['type'] = 0;
            }
            unset($rs3);
            $times->add($data);
        } else {
            $data['shangqi'] = $trs['shangqi'];
            $data['benqi'] = $trs['benqi'];
        }
        $this->bobifengding(); //奖金汇总
        $twhere = array();
        $twhere['type'] = 0;
        $trs_two = $times->where($twhere)->order('id desc')->field('id')->find();
        $where_two = array();
        $data2 = array();
        $where_two['did'] = $trs_two['id'];
        $fwhere = array();
        $fwhere['b0'] = array('neq', 0);
        $fwhere['is_pay'] = array('gt', 0);
        $rs = $this->where('is_pay>=1 AND (b0<>0 OR b6<>0)')->field('*')->order('id asc')->select();
        foreach ($rs as $rss) {
            $where_two['uid'] = $rss['id'];
            $bonus_rs = $bonus->where($where_two)->find();
            if (!$bonus_rs) {
                $data2['e_date'] = $data['benqi'];
                $data2['s_date'] = $data['shangqi'];
                $data2['user_id'] = $rss['user_id'];
                $data2['nickname'] = $rss['nickname'];
                $data2['did'] = $trs_two['id'];
                $data2['uid'] = $rss['id'];
                $data2['b0'] = $rss['b0'];
                $data2['b1'] = $rss['b1'];
                $data2['b2'] = $rss['b2'];
                $data2['b3'] = $rss['b3'];
                $data2['b4'] = $rss['b4'];
                $data2['b5'] = $rss['b5'];
                $data2['b6'] = $rss['b6'];
                $data2['b7'] = $rss['b7'];
                $data2['b8'] = $rss['b8'];
                $bonus->add($data2);
            } else {
                $sql = "`b0`=b0+{$rss['b0']},`b1`=b1+{$rss['b1']}";
                $sql .= ",`b2`=b2+{$rss['b2']},`b3`=b3+{$rss['b3']}";
                $sql .= ",`b4`=b4+{$rss['b4']},`b5`=b5+{$rss['b5']}";
                $sql .= ",`b6`=b6+{$rss['b6']},`b7`=b7+{$rss['b7']}";
                $sql .= ",`b8`=b8+{$rss['b8']}";
                $bonus->execute("UPDATE __TABLE__ SET " . $sql . " where `id`=" . $bonus_rs['id']);
            }
            $fck_sql = "`agent_use`=agent_use+b0,`zjj`=zjj+b0";
            $fck_sql .= ",`b0`=0,`b1`=0,`b2`=0,`b3`=0,`b4`=0,`b5`=0,`b6`=0,`b7`=0,`b8`=0";
            $this->execute("UPDATE `xt_fck` SET $fck_sql where `id`=" . $rss['id']);
        }
        unset($times, $trs, $settime_two, $bonus, $twhere, $data2, $fwhere, $rs, $data);
        $this->_addBonus($trs_two['id']);
    }

    public function _addBonus($DID = 0) {
        //统计总奖金 到 xt_times_bonus 表   奖金结算完后调用
        $times_bonus = M('times_bonus');
        $fee = M('fee');
        $rs = $fee->field('b0,b1,b2,b3,b4,b5,b6,b7,b8,b9,b10')->find();
        $times = M('times');
        $bonus = M('bonus');
        $trs = $times->field('*')->order('id desc')->find();
        $data = array();
        if ($trs) {
            $b0 = 0;
            $b1 = 0;
            $b2 = 0;
            $b3 = 0;
            $b4 = 0;
            $where['did'] = $trs['id'];
            $b0 = $bonus->where($where)->sum('b0');
            $b1 = $bonus->where($where)->sum('b1');
            $b2 = $bonus->where($where)->sum('b2');
            $b3 = $bonus->where($where)->sum('b3');
            $b4 = $bonus->where($where)->sum('b4');
            $b5 = $bonus->where($where)->sum('b5');
            $b6 = $bonus->where($where)->sum('b6');
            $b7 = $bonus->where($where)->sum('b7');
            $b8 = $bonus->where($where)->sum('b8');
            //=======汇总结束============
            $s_date = 0;
            $e_date = 0;
            $s_date = $trs['shangqi'];
            $e_date = $trs['benqi'];
            $data['b0'] = $b0;
            $data['b1'] = $b1;
            $data['b2'] = $b2;
            $data['b3'] = $b3;
            $data['b4'] = $b4;
            $data['b5'] = $b5;
            $data['b6'] = $b6;
            $data['b7'] = $b7;
            $data['b8'] = $b8;
            $data['did'] = $trs['id'];
            $data['s_date'] = $s_date;
            $data['e_date'] = $e_date;
            $times_bonus_rs = $times_bonus->where("did={$DID}")->find();
            if ($times_bonus_rs) {
                $data['id'] = $times_bonus_rs['id'];
                $times_bonus->save($data);
            } else {
                $times_bonus->add($data);
            }
        }
        unset($times_bonus, $fee, $rs, $times, $bonus, $trs, $data);
    }

}

?>