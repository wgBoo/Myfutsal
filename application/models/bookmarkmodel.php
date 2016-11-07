<?php


class BookmarkModel extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    function delete_start($id, $loginID) {

        $sql = "DELETE FROM favorite_people
                WHERE user_id = '$loginID'
                AND favorite_user = '$id';";

        return $this->db->query($sql);
    }

    function insert_start($id, $loginID) {

        $sql = "INSERT INTO favorite_people (favorite_user, user_id)
                VALUES ('$id', '$loginID');";

        return $this->db->query($sql);

    }
}