<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this -> load->database();
        $this -> load->model('DetailModel');
    }

    public function index()
    {

        $param = $_REQUEST['param'];
        $category = explode("/", $param);

        // 사람
        if($category[0] == "people") {
            $this -> people($category[1]);
        }

        // 소속팀
        elseif($category[0] == "ownTeam") {
            $this -> ownTeam($category[1]);
        }

    }


    // ajax로 상세보기 모달창 사람 정보 들고온다.
    public function people($user_id)
    {

        // 받은 user_id로 사용자 정보를 구한다.
        $detail_list = $this -> DetailModel -> find_user($user_id);


        $pfimage = $detail_list[0] -> user_pfimage;

        $home =  $detail_list[0] -> user_home;
        $phone =  $detail_list[0] -> user_phone;
        $email =  $detail_list[0] -> user_email;
        $ability =  $detail_list[0] -> user_ability;

        // 즐겨찾기 된 유저인지 구한다(버튼표시 위해)
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $favorite_people_list = $this-> DetailModel -> favorite_people_check($user_id, $loginID);

        if(($favorite_people_list)){
            $star = "YES";

        }
        else{
            $star = "NO";
        }

        for( $iCount = 0 ; $iCount < count($detail_list) ; $iCount++ ) {
            echo "
                <img src='../../../public/img/member/$pfimage' align='middle'>
                <br/>
                <br/>
                <table class='table table-striped'>
                    <tr>
                        <td>휴대폰</td><td>$phone</td>
                    </tr>
                    <tr>
                        <td>email</td><td>$email</td>
                    </tr>
                    <tr>
                        <td>홈그라운드</td><td>$home</td>
                    </tr>
                    <tr>
                        <td>능력</td><td>$ability</td>
                    </tr>
                </table>
                <span id='star'>$star</span>

            ";
        }
    }

    public function ownTeam($team_name) {

        echo "$team_name";
        // 받은 user_id로 소속 팀을 구한다.

        $detail_list = $this -> DetailModel -> find_ownTeam($team_name);

        $name =  $detail_list[0] -> team_name;
        $leader =  $detail_list[0] -> team_leader;
        $produce =  $detail_list[0] -> team_produce;

        for( $iCount = 0 ; $iCount < count($detail_list) ; $iCount++ ) {


                echo "
                    <ul>
                        <li>$name</li>
                        <li>$leader</li>
                        <li>$produce</li>

                    </ul>
                ";
        }

    }

}