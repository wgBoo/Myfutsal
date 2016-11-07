<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Supporter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('SupporterModel');
    }

    public function index()
    {

        $this->getList();
    }
    public function getList() // 용병 리스트를 출력
    {


        $last_num = isset($_REQUEST['last_num']) ? $_REQUEST['last_num'] : 0 ;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
        $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

        $supporter['supporter_getList'] = $this -> SupporterModel -> getListSupporterBoard($last_num, $limit);

        if($is_loading) {
            $supporter['supporter_getList'] = $this -> SupporterModel ->getListSupporterBoard_Scroll($last_num, $limit);
            for($iCount = 0 ; $iCount < count($supporter['supporter_getList']) ; $iCount++ ){

                echo "<table class='table table-bordered'>";
                echo "    <tr align=center>";
                echo "        <td width='15%'>";
                echo $supporter['supporter_getList'][$iCount]->spt_starttime; echo"~"; echo $supporter['supporter_getList'][$iCount]->spt_endtime;
                echo "        </td>";
                echo "        <td>";
                echo "              <button class='btn btn-warning' onclick='location.href=/supporter/view/'".$supporter['supporter_getList'][$iCount]->spt_num.">"."자세히보기"."</button>";
                echo "        </td>";
                echo "        <td rowspan=4>";
                                    if($supporter['supporter_getList'][$iCount]->spt_status == 0 ) {
                                        echo "모집중";
                                    }
                                    else {
                                        echo "모집완료";
                                    }
                echo "        </td>";
                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td rowspan='3'>";
                $image = "<img src=../../../public/img/member/".$supporter['supporter_getList'][$iCount]->user_pfimage.">";

                echo "$image";
                echo "          </td>";
                echo "          <td>".$supporter['supporter_getList'][$iCount]->spt_writer."</td>";
                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$supporter['supporter_getList'][$iCount]->spt_number."</td>";
                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$supporter['supporter_getList'][$iCount]->spt_address."</td>";
                echo "    </tr>";

            }
            echo "<script type='text/javascript'>var last_num = $last_num;</script>";
        }else{


            $this->load->view('./_templates/header.php', $this -> data);
            $this->load->view('./_templates/Laside.php', $this -> data);
            $this->load->view('./supporter/getlist.php', $supporter);
            $this->load->view('./_templates/Raside.php', $this -> data);
            $this->load->view('./_templates/footer.php', $this -> data);
        }
    }
    public function writeV() // 글쓰기 뷰
    {


        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('supporter/writev.php');
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);

    }
    public function write() // 글쓰기
    {

        if (isset($_POST["submit_write_supporter"])) {

            $spt_writer = isset($_REQUEST['spt_writer']) ? $_REQUEST['spt_writer'] : '못받나요??';
            $spt_date = isset($_REQUEST['spt_date']) ? $_REQUEST['spt_date'] : null;
            $spt_starttime = isset($_REQUEST['spt_starttime']) ? $_REQUEST['spt_starttime'] : null;
            $spt_endtime = isset($_REQUEST['spt_endtime']) ? $_REQUEST['spt_endtime'] : null;

            $spt_number = isset($_REQUEST['spt_number']) ? $_REQUEST['spt_number'] : null;
            $spt_content = isset($_REQUEST['spt_content']) ? $_REQUEST['spt_content'] : null;
            $spt_address = isset($_REQUEST['spt_address']) ? $_REQUEST['spt_address'] : null;

            $this -> SupporterModel->writeSupporterBoard($spt_writer, $spt_date, $spt_starttime, $spt_endtime, $spt_number, $spt_content, $spt_address);
        }

        $this -> index();
    }

    public function view($spt_num) // 용병글 자세히 보기
    {

        $supporter['supporter_writer_and_board'] = $this -> SupporterModel ->viewSupporterBoardInfo($spt_num);
        $supporter['supporter_team'] = $this -> SupporterModel ->viewSupporterBoardTeamInfo($spt_num);
        $supporter['supporter_request'] = $this -> SupporterModel ->viewSupporterBoardRequestInfo($spt_num);



        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('supporter/view.php', $supporter);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }


    public function request() // 용병 신청
    {
        $spt_num = isset($_REQUEST['spt_num']) ? $_REQUEST['spt_num'] : null;
        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
        $request_num = isset($_REQUEST['request_num']) ? $_REQUEST['request_num'] : null;


        $supporter_request = $this -> SupporterModel -> requestSupporterBoard($spt_num, $user_id, $request_num);

        //header('location: ' . BASEPATH . 'supporter/view/'.$spt_num.'');
        header('location: /supporter/view/'.$spt_num);
    }


    public function gameJoin($user_id, $spt_num, $sptr_number) // 신청 승인
    {

        $supporter_model = $this -> SupporterModel;
        $supporter_writer_and_board = $supporter_model->gameJoinSupporterBoard($user_id, $spt_num, $sptr_number);
        header('location: /supporter/view/'.$spt_num);
    }


    public function gameRefusal() // 신청 거절
    {

        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
        $spt_num = isset($_REQUEST['spt_num']) ? $_REQUEST['spt_num'] : null;

        $supporter_model = $this -> SupporterModel;
        $supporter_writer_and_board = $supporter_model->gameRefusalSupporterBoard($user_id, $spt_num);

        header('location: /supporter/view/'.$spt_num);

    }

    public function gameCancel() // 신청 취소
    {
        $sptr_num = isset($_REQUEST['sptr_num']) ? $_REQUEST['sptr_num'] : null;
        $spt_num = isset($_REQUEST['spt_num']) ? $_REQUEST['spt_num'] : null;
        $sptr_number = isset($_REQUEST['sptr_number']) ? $_REQUEST['sptr_number'] : null;

        $supporter_model = $this -> SupporterModel;
        $supporter_writer_and_board = $supporter_model->gameCancelSupporterBoard($sptr_num, $spt_num, $sptr_number);

        header('location: /supporter/view/'.$spt_num);

    }

    // 여기 수정
    public function modifyV($spt_num) // 용병 글 수정 뷰
    {

        $supporter_model = $this -> SupporterModel;
        $supporter['supporter_modify'] = $supporter_model->getModifySurpporterBoard($spt_num);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('supporter/modifyv.php',$supporter);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }

    public function modify($spt_num) // 용병글 수정
    {
        $spt_date = isset($_REQUEST['spt_date']) ? $_REQUEST['spt_date'] : null;
        $spt_starttime = isset($_REQUEST['spt_starttime']) ? $_REQUEST['spt_starttime'] : null;
        $spt_endtime = isset($_REQUEST['spt_endtime']) ? $_REQUEST['spt_endtime'] : null;
        $spt_number = isset($_REQUEST['spt_number']) ? $_REQUEST['spt_number'] : null;
        $spt_content = isset($_REQUEST['spt_content']) ? $_REQUEST['spt_content'] : null;
        $spt_address = isset($_REQUEST['spt_address']) ? $_REQUEST['spt_address'] : null;

        //echo "왔니?";
        if (isset($_POST["submit_modify_supporter"])) {

            $this -> SupporterModel -> modifySurpporterBoard($spt_num, $spt_date, $spt_starttime, $spt_endtime, $spt_number, $spt_content, $spt_address);

        }
        header('location: /supporter/view/'.$spt_num);
    }

    public function del($spt_num) // 용병글 삭제
    {

        $supporter_model = $this -> SupporterModel;
        $supporter_model->delSurpporterBoard($spt_num);

        $this -> index();
    }
}