<?php

class CalendarModel extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    function schedule($id) {
        $sql = "
                    SELECT  spt_address, spt_date, spt_starttime, spt_endtime
                    FROM    supporter_board
                    WHERE   spt_num IN (
                                          SELECT  spt_num
                                          FROM    supporter_request
                                          WHERE   sptr_user = '$id'
                                          AND     sptr_status = 1
                                      )
                    OR      spt_writer = '$id'
                    AND      spt_status = 1
                    ORDER BY spt_date asc, spt_starttime desc;
        ";
        $query = $this->db->query($sql);

        $arr = $query->result();
        /*var_dump($arr);*/

        for($iCount = 0 ; $iCount < count($arr) ; $iCount++) {


            $result[$iCount]['title'] = $arr[$iCount] -> spt_address;
            $result[$iCount]['spt_date'] = $arr[$iCount] -> spt_date;
            $result[$iCount]['spt_starttime'] = $arr[$iCount] -> spt_starttime;
            $result[$iCount]['spt_endtime'] = $arr[$iCount] -> spt_endtime;
            $result[$iCount]['start'] = $result[$iCount]['spt_date']." ". $result[$iCount]['spt_starttime'];
            $result[$iCount]['end'] = $result[$iCount]['spt_date']." ". $result[$iCount]['spt_endtime'];

            unset($result[$iCount]['spt_date']);
            unset($result[$iCount]['spt_starttime']);
            unset($result[$iCount]['spt_endtime']);
        }


        return $result;
    }



}