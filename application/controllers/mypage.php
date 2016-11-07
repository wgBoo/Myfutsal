<?php

session_start();

defined('BASEPATH') OR exit('No direct script access allowed');
class Mypage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function index()
    {


        // 내 타임라인
        if(($this -> data['timeline_user'] == $this -> data['user_id']) ){

            $last_notice_num = isset($_REQUEST['last_notice_num']) ? $_REQUEST['last_notice_num'] : 0 ;
            $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
            $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

            $this->load->model('TimelineModel');
            $timeline = $this -> TimelineModel;

            if($last_notice_num == 0 ) {
                $this -> data['timelineList'] =  $timeline -> timelineList_01($this -> data['timeline_user'], $limit);
            }
            else {
                $this -> data['timelineList'] = $timeline -> timelineList_02($this -> data['timeline_user'], $last_notice_num, $limit);
            }

            // 리플 목록
            $this->load->model('TimelineReplyModel');
            $this -> data['timeline_reply'] = $this -> TimelineReplyModel -> getList($this -> data['timelineList']);

            /************ 변수 설정 *************************************/
            /*
            // 오른쪽
            $data['favorites_User'] = $this -> favorites_User;
            $data['own_Team'] = $this -> own_Team;

            // header부분의 로그인한 사용자 사진을 들고 오기 위해
            $this->load->model('DetailModel');
            $data['myInfoList'] = $this -> DetailModel -> find_user($this -> user_id);

            // 왼쪽
            $data['user_id'] = $this -> user_id;
            $data['timeline_user'] = $this -> timeline_user;

            // 왼쪽 메뉴 사진을 위해(나를 포함한 다른사람 타임라인)
            $this->load->model('TimelineModel');
            $data['leftImg'] = $this -> TimelineModel -> leftTimeline($this -> timeline_user);

            // 타임라인 글
            $data['timelineList'] = $this -> timelineList;
            */
            /************ **********************************************/


            // 스크롤 요청 들어왔나???
            if($is_loading){
                for($iCount = 0 ; $iCount < count($this -> data['timelineList']) ; $iCount++ ) {

                        echo "<li>";
                        echo "    <div class='timeline-badge up'><i class='fa fa-thumbs-up'></i></div>";

                        echo "         <div class='timeline-panel' style='background-color:white; min-height: 30em;'>";

                        echo "            <div class='timeline-heading'>";

                        $param = $this -> data['timelineList'][$iCount]->user_id;
                        echo "                  <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$param'>";
                        echo "                        <div class='thumb'>";

                        $img = $this -> data['timelineList'][$iCount]->user_psimage;
                        echo "                              <img class='img-circle' src='../../../public/img/member_s/$img' align='left'>";
                        echo "                        </div>";
                        echo "                  </div>";


                        echo "            <h4 class='timelind-tilte'>"; echo $this -> data['timelineList'][$iCount]->user_id; echo "</h4>";

                        echo "            <h5>"; echo $this -> data['timelineList'][$iCount]->time_date; echo "</h5>";

                        echo "    </div>";


                        echo "    <div class='timeline-body'>";

                        $content = $this -> data['timelineList'][$iCount]->time_content;
                        echo "        <p style=' font-size: large'>$content</p>";
                        echo "         <span>댓글 쓰기</span>";
                        echo "    </div>";
                        $last = $this -> data['timelineList'][$iCount] -> time_num;
                        echo "</li>";
                        echo "<script type='text/javascript'>var last_notice_num = $last </script>";
                }
            }
            else {

                $this->load->view('./_templates/header.php', $this -> data);
                $this->load->view('./_templates/Laside.php', $this -> data);
                $this->load->view('./mypage/index.php', $this -> data);
                $this->load->view('./_templates/Raside.php', $this -> data);
                $this->load->view('./_templates/footer.php', $this -> data);

            }
        }

        // 다른 사람 타임라인
        else {



            $last_notice_num = isset($_REQUEST['last_notice_num']) ? $_REQUEST['last_notice_num'] : 0;
            $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
            $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

            $this->load->model('TimelineModel');
            $timeline = $this -> TimelineModel;

            if($last_notice_num == 0 ) {
                $this -> data['timelineList'] = $timeline -> otherTimelineList_01($this -> data['timeline_user'], $limit);
            }
            else {
                $this -> data['timelineList'] = $timeline -> otherTimelineList_02($this -> data['timeline_user'], $last_notice_num, $limit);
            }

            // 리플 목록
            $this->load->model('TimelineReplyModel');
            $this -> data['timeline_reply'] = $this -> TimelineReplyModel -> getList($this -> data['timelineList']);

            /************ 변수 설정 *************************************/
            /*
            // 오른쪽
            $data['favorites_User'] = $this -> favorites_User;
            $data['own_Team'] = $this -> own_Team;

            // header부분의 로그인한 사용자 사진을 들고 오기 위해
            $this->load->model('DetailModel');
            $data['myInfoList'] = $this -> DetailModel -> find_user($this -> user_id);

            // 왼쪽
            $data['user_id'] = $this -> user_id;
            $data['timeline_user'] = $this -> timeline_user;

            // 왼쪽 메뉴 사진을 위해(나를 포함한 다른사람 타임라인)
            $this->load->model('TimelineModel');
            $data['leftImg'] = $this -> TimelineModel -> leftTimeline($this -> timeline_user);

            // 타임라인 글
            $data['timelineList'] = $this -> timelineList;
            */
            /************ **********************************************/


            // 스크롤 요청 있었나?
            if($is_loading) {
                for($iCount = 0 ; $iCount < count($this -> data['timelineList']) ; $iCount++ ) {

                    echo "<li>";
                    echo "    <div class='timeline-badge up'><i class='fa fa-thumbs-up'></i></div>";

                    echo "         <div class='timeline-panel' style='background-color:white; min-height: 30em;'>";

                    echo "            <div class='timeline-heading'>";

                    $param = $this -> data['timelineList'][$iCount]->user_id;
                    echo "                  <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$param'>";
                    echo "                        <div class='thumb'>";

                    $img = $this -> data['timelineList'][$iCount]->user_psimage;
                    echo "                              <img class='img-circle' src='../../../public/img/member_s/$img' align='left'>";
                    echo "                        </div>";
                    echo "                  </div>";


                    echo "            <h4 class='timelind-tilte'>"; echo $this -> data['timelineList'][$iCount]->user_id; echo "</h4>";

                    echo "            <h5>"; echo $this -> data['timelineList'][$iCount]->time_date; echo "</h5>";

                    echo "    </div>";


                    echo "    <div class='timeline-body' style='font-size: large'>";

                    $content = $this -> data['timelineList'][$iCount]->time_content;
                    echo "        <p>$content</p>";
                    echo "    </div>";
                    $last = $this -> data['timelineList'][$iCount] -> time_num;
                    echo "</li>";
                    echo "<script type='text/javascript'>var last_notice_num = $last </script>";
                }
            }
            else {
                $this->load->view('./_templates/header.php', $this -> data);
                $this->load->view('./_templates/Laside.php', $this -> data);
                $this->load->view('./mypage/index.php', $this -> data);
                $this->load->view('./_templates/Raside.php', $this -> data);
                $this->load->view('./_templates/footer.php', $this -> data);
            }

        }
    }

    public function mypageWrite()
    {


        $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : null;


        $this->load->model('TimelineModel');
        $timeline = $this -> TimelineModel;

        $writeCheck = $timeline -> writeStart($content, $this->data['user_id']);

        if($writeCheck == true) {
            $this -> index();
        }
        else {
            echo "<script>alert('글 쓰기 실패하였습니다.'); history.back(-1);</script>";
        }
/*
        // 타임라인
        $limit = 5;
        if($this -> data['timeline_user'] == $this -> data['user_id']){
            $this -> data['timelineList'] = $timeline -> timelineList_01($this -> data['timeline_user'], $limit);
        }
        else {
            // 다른 사용자 ID가 들어와야한다.
            $this -> data['timelineList'] = $timeline -> otherTimelineList($this -> data['timeline_user'], $limit);
        }


        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./mypage/index.php', $this -> data);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
*/
    }

}