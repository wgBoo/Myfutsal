<?php
class Member_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function findid($email, $phone)
    {
        return $this->db->get_where('member', array('user_email' => $email, 'user_phone' => $phone))->row()->user_id;
    }

    function findpw($id, $email, $phone)
    {
        return $this->db->get_where('member', array('user_id' => $id, 'user_email' => $email, 'user_phone' => $phone))->row()->user_pass;
    }

    function loginCheck($id, $pass)
    {
        $row = $this->db->get_where('member', array('user_id' => $id, 'user_pass' => $pass))->row();
        if ($row) {
            $returnArr['alertCode'] = 1; // 로그인 성공 코드 리턴
            $returnArr['loginID'] = $id;
        } else {
             $row = $this->db->get_where('member', array('user_id' => $id))->row();
            if($row){
                $returnArr['alertCode']  = -1; // 비밀번호 입력 오류 코드 리턴
            }
            else
                $returnArr['alertCode']  = -2; // 등록되지 않은 아이디 오류 코드 리턴
        }
        return $returnArr;
    }

}
