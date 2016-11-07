<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline_reply extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('TimelineReplyModel');
    }



    public function write($time_num)
    {
        $time_num = $time_num;
        $content = $_REQUEST['reply_content'];
        $reply_user = $_REQUEST['reply_user'];
        $reply_date = date("Y-m-d H:i:s",time());



        //$this -> TimelineReplyModel -> timeline_reply_write($time_num, $content, $reply_user, $reply_date);

        $user = $this -> data['timeline_user'];

        var_dump($user);

        echo "  <form name='frm' action='/mypage' method='POST'>";
        echo "      <input type='hidden' name='user_id' value=$user>";
        echo "  </form>";

        echo "<script>document.frm.submit()</script>";

    }


}