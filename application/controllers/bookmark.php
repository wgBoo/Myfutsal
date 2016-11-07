<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookmark extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this -> load -> database();
        $this -> load -> model('BookmarkModel');
    }

    // 즐겨찾기 추가 삭제 구분
    public function index()
    {
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
        $check = $_REQUEST['check'];



        // 즐겨찾기 삭제
        if($check == "delete") {
            $bookmark_check = $this -> BookmarkModel -> delete_start($user_id, $loginID);
            //echo "$bookmark_check";
        }

        // 즐겨찾기 추가
        elseif($check == "insert"){
            $bookmark_check = $this -> BookmarkModel -> insert_start($user_id, $loginID);
        }
    }

}