<?php

class TestAction extends CommonAction {

    public function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
    }

    public function xxx() {
        $fck=D('Fck');
        $fck->rifenhong();
        $this->_clearing();
        echo "分红成功!<br><a href='".__APP__."/YouZi/cody/c_id/18' style='color:blue'>[货币流向]</a>";
    }

}

?>