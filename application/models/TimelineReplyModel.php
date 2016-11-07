<?php
class TimelineReplyModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // 댓글 쓰기
    function timeline_reply_write($time_num, $content, $reply_user, $reply_date){

        $sql = "INSERT INTO timeline_reply(reply_num, time_num, user_id, reply_content, reply_date)
                VALUES ('', '$time_num', '$reply_user', '$content', '$reply_date');";

        return  $this->db->query($sql);
    }

    function getList($timelineList){


        for( $cnt = 0 ; $cnt < count($timelineList) ; $cnt++ ) {
            $time_num = $timelineList[$cnt] -> time_num;

            $sql = "SELECT t.*, m.*
                    FROM timeline_reply t, member m
                    WHERE t.user_id = m.user_id
                    AND time_num = '$time_num'";
            $query = $this->db->query($sql);
            $data[$cnt] = $query -> result();
        }

        return $data;
    }

}