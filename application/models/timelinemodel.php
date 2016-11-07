<?php
class TimelineModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    // 타임라인 리스트를 구한다.
    function timelineList($id)
    {
        $sql = "    SELECT  t.user_id, t.time_content, t.time_date
                    FROM    timeline t
                    WHERE   t.user_id = '$id'
                    OR      t.user_id IN (
                                            SELECT  f.favorite_user
                                            FROM    favorite_people f
                                            WHERE   f.user_id = '$id'
                                          )
                    ORDER BY t.time_date DESC;";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // 다른 사용자 ID가 들어와야한다.
    function otherTimelineList_01($id, $limit)
    {
        $sql = "    SELECT  t.time_num, t.user_id, t.time_content, t.time_date, m.user_psimage
                    FROM    timeline t, member m
                    WHERE   t.user_id = '$id'
                    AND     m.user_id = t.user_id
                    ORDER BY t.time_date DESC
                    LIMIT 0, $limit;
                    ";


        $query = $this->db->query($sql);
        //$query->execute();

        return $query->result();
    }

    // 다른 사용자 ID가 들어와야한다.
    function otherTimelineList_02($id, $last_notice_num, $limit)
    {
        $sql = "    SELECT  t.time_num, t.user_id, t.time_content, t.time_date, m.user_psimage
                    FROM    timeline t, member m
                    WHERE   t.user_id = '$id'
                    AND     t.time_num < $last_notice_num
                    AND     m.user_id = t.user_id
                    ORDER BY t.time_date DESC
                    LIMIT 0, $limit;

                    ";


        $query = $this->db->query($sql);
        //$query->execute();

        return $query->result();
    }



    // 내 타임라인(처음나오는 부분)
    function timelineList_01($id, $limit)
    {


        $sql = "
                    SELECT  t.time_num, t.user_id, t.time_content, t.time_date, m.user_psimage
                    FROM    timeline t, member m
                    WHERE   t.user_id = m.user_id
                    AND     ((t.user_id, m.user_psimage) IN (
                                            SELECT  f.favorite_user, m.user_psimage
                                            FROM    favorite_people f, member m
                                            WHERE   f.favorite_user = m.user_id
                                            AND     f.user_id = '$id'
                                          )
                                            OR      (t.user_id, m.user_psimage) IN (
                                                                    SELECT  f.user_id, m.user_psimage
                                                                    FROM    favorite_people f, member m
                                                                    WHERE   f.user_id = m.user_id
                                                                    AND     f.user_id = '$id'
                                                                  ))

                    ORDER BY t.time_date DESC
                    LIMIT 0, $limit;
                    ";
        $query = $this->db->query($sql);
        //$query->execute();

        return $query->result();
    }

    function timelineList_02($id, $last_notice_num, $limit)
    {


        $sql = "
                    SELECT  t.time_num, t.user_id, t.time_content, t.time_date, m.user_psimage
                    FROM    timeline t, member m
                    WHERE   t.user_id = m.user_id
                    AND     t.time_num < $last_notice_num
                    AND     ((t.user_id, m.user_psimage) IN (
                                            SELECT  f.favorite_user, m.user_psimage
                                            FROM    favorite_people f, member m
                                            WHERE   f.favorite_user = m.user_id
                                            AND     f.user_id = '$id'
                                          )
                                          OR      (t.user_id, m.user_psimage) IN (
                                                                                    SELECT  f.user_id, m.user_psimage
                                                                                    FROM    favorite_people f, member m
                                                                                    WHERE   f.user_id = m.user_id
                                                                                    AND     f.user_id = '$id'
                                                                                  )
                            )

                    ORDER BY t.time_date DESC
                    LIMIT 0, $limit;

                    ";
        $query = $this->db->query($sql);
        //$query->execute();

        return $query->result();
    }

    // 왼쪽 메뉴 사진을 위해(나를 포함한 다른사람 타임라인)
    function leftTimeline($id)
    {

        $sql = "SELECT  *
                FROM    member
                WHERE   user_id = '$id';";

        $query = $this->db->query($sql);
        //$query->execute();

        return $query->result();
    }

    // 타임라인에 글 쓴다.
    function writeStart($content, $writer){


        $sql = "INSERT INTO timeline (user_id, time_content)
                VALUES ('$writer', '$content')";


        return $this->db->query($sql);
    }
}