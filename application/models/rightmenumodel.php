<?php

class RightMenuModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // 사용자 id 받고 검색한다.
    function favoriteUser($id) {

        $sql = "SELECT *
                FROM member
                WHERE user_id IN (SELECT favorite_user
                                 FROM favorite_people
                                 WHERE user_id = '$id');
                                 ";

        $query = $this -> db -> query($sql);

        $result = $query -> result();

        return $result;
    }

    // 사용자 id로 소속팀 찾는다.
    public function favoriteOwnTeam($user_id)
    {
        $sql = "SELECT t.*, a.main_team_check
                 FROM team t, attach_team a
                 WHERE t.team_name = a.team_name
                 AND   a.user_id = '$user_id';
                 ";
        $query = $this -> db -> query($sql);

        $result = $query -> result();

        return $result;
    }
}