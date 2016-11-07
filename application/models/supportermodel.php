<?php
class SupporterModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function writeSupporterBoard($spt_writer, $spt_date, $spt_starttime, $spt_endtime, $spt_number, $spt_content, $spt_address)
    { // supporter menu write add 서포터 메뉴 글쓰기


        $sql = "INSERT INTO supporter_board (spt_writer, spt_date, spt_starttime, spt_endtime, spt_number, spt_content, spt_address)
                VALUES ('$spt_writer', '$spt_date', '$spt_starttime', '$spt_endtime', '$spt_number', '$spt_content', '$spt_address');";

        return $this->db->query($sql);
    }

    function getListSupporterBoard($last_num, $limit)
    { // supporter menu get list 서포터 메뉴 리스트 뽑기

        $sql = "SELECT m.user_pfimage, m.user_id, sb.*
                FROM   member m, supporter_board sb
                WHERE  m.user_id = sb.spt_writer
                AND    sb.spt_num > $last_num
                ORDER BY sb.spt_num DESC
                LIMIT  0, $limit;";
        $query = $this->db->query($sql);


        return $query->result();
    }
    function getListSupporterBoard_Scroll($last_num, $limit) {
        $sql = "SELECT m.user_psimage, m.user_pfimage, sb.*
                FROM   member m, supporter_board sb
                WHERE  m.user_id = sb.spt_writer
                AND    sb.spt_num < $last_num
                ORDER BY sb.spt_num DESC
                LIMIT  0, $limit;";
        $query = $this->db->query($sql);


        return $query->result();
    }
    function getModifySurpporterBoard($spt_num)
    { // supporter menu modifyView print 서포터 메뉴의 글 수정을 위해 원글 출력
        $spt_num = (int)$spt_num;
        $sql = "SELECT * FROM supporter_board where spt_num={$spt_num}";
        $query = $this -> db -> query($sql);

        return $query->result();
    }
    function modifySurpporterBoard($spt_num, $spt_date, $spt_starttime, $spt_endtime, $spt_number, $spt_content, $spt_address)
    { // supporter menu modify 서포터 메뉴 글 수정
        $spt_num = (int)$spt_num;
        $sql = "UPDATE supporter_board
                SET spt_date = '$spt_date', spt_starttime = '$spt_starttime', spt_endtime = '$spt_endtime', spt_number = '$spt_number', spt_content = '$spt_content', spt_address = '$spt_address'
                where spt_num = $spt_num";

        return $this -> db -> query($sql);

    }

    function delSurpporterBoard($spt_num)
    { // supporter menu delete 서포터 메뉴 글 삭제
        $spt_num = (int)$spt_num;
        $sql = "DELETE FROM supporter_board where spt_num = $spt_num";
        return $this->db->query($sql);

    }
    function viewSupporterBoardInfo($spt_num)
    { // supporter menu member and board info 서포터 메뉴 글 자세히보기 - 글쓴이 정보와 글 정보
        $sql = "SELECT m.*, sb.*
                FROM member m, supporter_board sb
                where m.user_id = sb.spt_writer
                and sb.spt_num = $spt_num";
        $query = $this->db->query($sql);

        return $query->result();
    }
    function viewSupporterBoardTeamInfo($spt_num)
    { // supporter menu main_team name 서포터 메뉴 글 자세히보기 - 글쓴이 대표팀 이름
        $sql = "SELECT at.team_name
                FROM member m, attach_team at, supporter_board sb
                where m.user_id = at.user_id
                and m.user_id = sb.spt_writer
                and at.main_team_check = 1
                and sb.spt_num = $spt_num";

        $query = $this->db->query($sql);

        return $query->result();
    }
    function viewSupporterBoardRequestInfo($spt_num)
    { // supporter menu request member info 서포터 메뉴 글 자세히보기 - 신청자 목록
        $sql = "SELECT sr.*, m.*
                FROM supporter_request sr, member m
                WHERE m.user_id = sr.sptr_user
                and sr.spt_num = $spt_num;
               ";
        $query = $this->db->query($sql);

        return $query->result();
    }
    function requestSupporterBoard($spt_num, $user_id, $request_num)
    { // supporter menu request 서포터 메뉴 글 자세히보기 - 용병 참가 신청
        $sql = "INSERT INTO supporter_request(spt_num, sptr_user, sptr_number)
                VALUES ('$spt_num', '$user_id', '$request_num');";

        return  $this->db->query($sql);

    }
    function gameJoinSupporterBoard($sptr_user, $spt_num, $sptr_number)
    { // supporter menu request game join 서포터 메뉴 글 자세히보기 - 참가 수락

        $sql = "UPDATE supporter_request SET sptr_status = 1 where spt_num = $spt_num and sptr_user = '$sptr_user'";
        $this->db->query($sql);

        $sql = "UPDATE supporter_board SET spt_number = spt_number - $sptr_number where spt_num = $spt_num";
        $query = $this->db->query($sql);

    }

    function gameRefusalSupporterBoard($user_id, $spt_num)
    { // supporter menu request game refusal 서포터 메뉴 글 자세히보기 - 참가 거절

        $sql = "UPDATE supporter_request SET sptr_status = 2 where spt_num = $spt_num and sptr_user = '$user_id';";
        $query = $this->db->query($sql);

    }

    function gameCancelSupporterBoard($sptr_num, $spt_num, $sptr_number){


        $sql = "DELETE FROM supporter_request WHERE sptr_num = $sptr_num";
        return $this->db->query($sql);


        /*$sql = "UPDATE supporter_board SET spt_number = spt_number + :sptr_number WHERE spt_num = :spt_num";
        $query = $this->db->prepare($sql);
        $query->execute(array(':sptr_number' => $sptr_number, 'spt_num' => $spt_num));*/
    }
}