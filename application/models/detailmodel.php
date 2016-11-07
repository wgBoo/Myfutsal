<?php

class DetailModel extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    // 사용자 정보 들고온다.
    function find_user($id) {

        $sql = "SELECT *
                FROM member
                WHERE user_id = '$id'";

        $query = $this -> db -> query($sql);

        /*$row = $query->result();*/

        return $query -> result();
    }

    function find_ownTeam($team_name) {

        // team으로 찾아야한다.

        $sql = "SELECT *
                FROM   team
                WHERE  team_name = '$team_name';
                 ";

        $query = $this -> db -> query($sql);
        //$query -> execute();

        return $query -> result();
    }


    // 즐겨찾기 유저인지 구한다.
    function favorite_people_check($user_id, $loginID){

        $sql ="SELECT *
               FROM   favorite_people
               WHERE  favorite_user = '$user_id'
               AND    user_id = '$loginID';";

        $query = $this -> db -> query($sql);
        //$query -> execute();

        return $query -> result();
    }
}