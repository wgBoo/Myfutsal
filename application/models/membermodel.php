<?php
class MemberModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function insertMember( $data, $home ){
        $id = strip_tags($data['id']);
        $pass = strip_tags($data['pass']);
        $email = strip_tags($data['email']);
        $phone = strip_tags($data['phone']);
        $ability = strip_tags($data['ability']);


        $sql = "INSERT INTO member (user_id, user_pass, user_email, user_phone, user_ability, user_home) VALUES ('$id', '$pass', '$email', '$phone', '$ability', '$home')"; //:의미는 집어넣기위한 공간만만들어놓는것이다. 실제로값을매칭하는것은 exqute에서하는것이다.
        $query = $this->db->query($sql);

    }

    function updateMember( $data ){
        $sql = "UPDATE member SET user_pfimage = '{$data['pfimage']}', user_psimage = '{$data['psimage']}' WHERE user_id = '{$data['id']}'";
        $query = $this->db->query($sql);

    }

    function loginCheck($id,$pass){

        $sql  = "SELECT * FROM member where user_id='{$id}' AND user_pass='{$pass}'";
        $sql2 = "SELECT * FROM member where user_id='{$id}'";
        $query = $this->db->query($sql);
        $row = $query->result();

        if($row){
                $returnArr['alertCode'] = 1; // 로그인 성공 코드 리턴
                $returnArr['loginID'] = $id ;
            }else {
                $query = $this->db->query($sql2);
                $row = $query->result();
                if($row) {
                    $returnArr['alertCode']  = -1; // 비밀번호 입력 오류 코드 리턴
                } else
                    $returnArr['alertCode']  = -2; // 등록되지 않은 아이디 오류 코드 리턴
            }

            return $returnArr ;
        }
    function findId($email,$phone){
        $sql = "SELECT * FROM member WHERE user_email='{$email}' AND user_phone='{$phone}'";
        $query = $this->db->query($sql);

        $row = $query->result();
        if($row) {
            $member_id = $row->user_id;
        }else{
            $member_id = "";
        }
        return $member_id;
    }

    function findPw($id,$email,$phone){
        $sql = "SELECT * FROM member WHERE user_id='{$id}' AND user_email='{$email}' AND user_phone='{$phone}'";
        $query = $this->db->query($sql);

        $row = $query->result();
        if($row){
            $member_pw =  $row->user_pass;
        }else{
            $member_pw = "";
        }
        return $member_pw;
    }
}