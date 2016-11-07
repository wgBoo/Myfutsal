<?php
session_start();

class Team extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->database();
        $this->load->model('TeamModel');


    }

    public function index()
    {
        $this->getTeamList();
    }

    public function getTeamList()
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

        $team['teamList'] = $this->TeamModel->getTeamList($user_id);


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/home', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function makeV()
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $team['team_check'] = $this->TeamModel->teamCheck($user_id);
        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/makev', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function make()
    {
        if (isset($_POST["submit_make_team"])) {
            if ($_POST['home'])
                $team_home = implode("-", $_POST['home']);

            $main_team_check = isset($_REQUEST['main_team_check']) ? ($_REQUEST['main_team_check']) : 1;
            $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
            $team_ability = isset($_REQUEST['team_ability']) ? ($_REQUEST['team_ability']) : null;
            $team_produce = isset($_REQUEST['team_produce']) ? ($_REQUEST['team_produce']) : null;
            $team_leader = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

            $this->TeamModel->makeTeam($team_name, $team_ability, $team_produce, $team_leader, $team_home, $main_team_check);

            $memberImgSavePath = "public/img/team/";
            $thumbnailImgSavePath = "public/img/team_s/";
            $fileMaxSize = 2000000;

            $upImgFileInfo['name'] = isset($_FILES['pfimage']['name']) ? $_FILES['pfimage']['name'] : null;
            $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name']) ? $_FILES['pfimage']['tmp_name'] : null; //임시저장소
            $upImgFileInfo['type'] = isset($_FILES['pfimage']['type']) ? $_FILES['pfimage']['type'] : null;
            $upImgFileInfo['size'] = isset($_FILES['pfimage']['size']) ? $_FILES['pfimage']['size'] : null;
            $upImgFileInfo['error'] = isset($_FILES['pfimage']['error']) ? $_FILES['pfimage']['error'] : null;

            if ($upImgFileInfo['name'] && $upImgFileInfo['error'] == 0) { //값을 잘 받았고 에러가 없으면

                $imgFileType = pathinfo($upImgFileInfo['name'], PATHINFO_EXTENSION); //확장자 추출

                $saveFileName = str_replace('%', '', urlencode($team_name)); //id로 파일이름을생성! 한글인코드함수 ex)%EB$BC%

                $saveFileNameWithExt = $saveFileName . "." . strval($imgFileType); // Cds12.jpg같은 완전한 파일이름 생성!
                $thumbnailFileNameWithExt = $saveFileName . "_S" . "." . strval($imgFileType); //썸네일 파일이름 생성!

                $retArr2 = $this->singleFileUpload($upImgFileInfo, $memberImgSavePath, $saveFileNameWithExt, $fileMaxSize);

                //$reArr2 업로드한 메세값을 담고있다.
                if ($retArr2['uploadOk']) { //큰그림파일 올리는것 이상이없으면.
                    $pfimage = $saveFileNameWithExt; //Cds12.jpg같은 파일이름을 저장한다.

                    if ($imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif") {
                        $src = $memberImgSavePath . strval($saveFileNameWithExt); //이미지저장경로와 파일이름을 붙여 변수에 저장.
                        $dest = $thumbnailImgSavePath . strval($thumbnailFileNameWithExt); //썸네일이미지경로와 썸네일 파일이름을 붙여 변수에 저장.
                        $this->makeThumbnailImage($src, $dest, $imgFileType); //썸네일이미지 생성.
                        $this->makeSingleImage($src, $imgFileType); //싱글이미지생성
                        $psimage = $thumbnailFileNameWithExt;// Cds12_s.jpg같은 파일이름 저장.
                    }
                }
            }

            $this->TeamModel->updateTeamimg($pfimage, $psimage, $team_name);
        }
        header('location: /team');
    }

    public function page()
    {
        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
        if ($team_name) {
            $_SESSION['team_name'] = $team_name;
        } else {
            $team_name = isset($_SESSION['team_name']) ? ($_SESSION['team_name']) : null;
        }

        $team['teamMember'] = $this->TeamModel->teamMemberCheck($_SESSION['loginID'], $team_name);
        $config = array();

        $config["base_url"] = "/team/page/";
        $config['total_rows'] = $this->TeamModel->teamBoard_count($team_name);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["first_link"] = '&lsaquo;처음';
        $config["next_link"] = '다음 &rsaquo;';
        $config["prev_link"] = '&lsaquo; 이전';
        $config["last_link"] = '마지막 &rsaquo;';
        // $config['num_links'] = $config['total_rows']/$config['per_page'];
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = ' ';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = ' ';
        $config['cur_tag_open'] = " ";
        $config['cur_tag_close'] = " ";

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $team["team_board"] = $this->TeamModel->fetch_boardList($team_name, $config["per_page"], $page);

        $team["links"] = $this->pagination->create_links();

        $team['team_page'] = $this->TeamModel->getTeam($team_name);


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/board', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function delete($teampage_num)
    {
        $team['team_page'] = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);
        $team_name = $team['team_page']->team_name;
        $this->TeamModel->teampageDelete($teampage_num);
        $team['teamMember'] = $this->TeamModel->teamMemberCheck($_SESSION['loginID'], $team_name);
        $config = array();

        $config["base_url"] = "/team/page/";
        $config['total_rows'] = $this->TeamModel->teamBoard_count($team_name);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["first_link"] = '&lsaquo;처음';
        $config["next_link"] = '다음 &rsaquo;';
        $config["prev_link"] = '&lsaquo; 이전';
        $config["last_link"] = '마지막 &rsaquo;';
        // $config['num_links'] = $config['total_rows']/$config['per_page'];
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = ' ';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = ' ';
        $config['cur_tag_open'] = " ";
        $config['cur_tag_close'] = " ";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $team["team_board"] = $this->TeamModel->fetch_boardList($team_name, $config["per_page"], $page);
        $team["links"] = $this->pagination->create_links();

        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/board', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);

    }

    public function repage($teampage_num)
    {

        $team['team_page'] = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);
        $team_name = $team['team_page']->team_name;
        $team['teamMember'] = $this->TeamModel->teamMemberCheck($_SESSION['loginID'], $team_name);
        $config = array();

        $config["base_url"] = "/team/page/";
        $config['total_rows'] = $this->TeamModel->teamBoard_count($team_name);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["first_link"] = '&lsaquo;처음';
        $config["next_link"] = '다음 &rsaquo;';
        $config["prev_link"] = '&lsaquo; 이전';
        $config["last_link"] = '마지막 &rsaquo;';
        // $config['num_links'] = $config['total_rows']/$config['per_page'];
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = ' ';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = ' ';
        $config['cur_tag_open'] = " ";
        $config['cur_tag_close'] = " ";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $team["team_board"] = $this->TeamModel->fetch_boardList($team_name, $config["per_page"], $page);
        $team["links"] = $this->pagination->create_links();


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/board', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function writev()
    {
        $team['teampage_num'] = isset($_REQUEST['teampage_num']) ? ($_REQUEST['teampage_num']) : null;


        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;

        $team['team_page'] = $this->TeamModel->getTeam($team_name);


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/writev', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function write()
    {


        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        if (isset($_POST['submit_teampage_write'])) {
            $teampage_num = isset($_REQUEST['teampage_num']) ? ($_REQUEST['teampage_num']) : null;
            $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
            $teampage_category = isset($_REQUEST['teampage_category']) ? ($_REQUEST['teampage_category']) : null;
            $teampage_title = isset($_REQUEST['teampage_title']) ? ($_REQUEST['teampage_title']) : null;
            $teampage_content = isset($_REQUEST['teampage_content']) ? ($_REQUEST['teampage_content']) : null;
        }
        if (!$teampage_num) {         //일반글
            $autoTeampage_num = $this->TeamModel->teampageWrite($team_name, $user_id, $teampage_category, $teampage_title, $teampage_content);
            $teampage_group_num = $autoTeampage_num;
            $teampage_depth = 0;
            $teampage_ord = 0;
            $teampage_num = $autoTeampage_num;
            $this->TeamModel->updateTeampageResponse($teampage_group_num, $teampage_depth, $teampage_ord, $teampage_num);
        } else {                      //답글
            $teampage = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);

            $teampage_group_num = $teampage->teampage_group_num;
            $teampage_depth = $teampage->teampage_depth + 1;
            $this->TeamModel->updateTeampageOrd($teampage_group_num, $teampage->teampage_ord);
            $teampage_ord = $teampage->teampage_ord + 1;
            $this->TeamModel->insertResponseBoard($team_name, $user_id, $teampage_category, $teampage_title, $teampage_content, $teampage_group_num, $teampage_depth, $teampage_ord);

        }

        $team['teamMember'] = $this->TeamModel->teamMemberCheck($_SESSION['loginID'], $team_name);
        $team['team_page'] = $this->TeamModel->getTeam($team_name);
        $config = array();

        $config["base_url"] = "/team/page";
        $config["total_rows"] = $this->TeamModel->teamBoard_count($team_name);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["first_link"] = '&lsaquo;처음';
        $config["next_link"] = '다음 &rsaquo;';
        $config["prev_link"] = '&lsaquo; 이전';
        $config["last_link"] = '마지막 &rsaquo;';
        // $config['num_links'] = $config['total_rows']/$config['per_page'];
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = ' ';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = ' ';
        $config['cur_tag_open'] = " ";
        $config['cur_tag_close'] = " ";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(0)) ? $this->uri->segment(0) : 0;
        $team["team_board"] = $this->TeamModel->fetch_boardList($team_name, $config["per_page"], $page);
        $team["links"] = $this->pagination->create_links();

        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/board', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);

    }

    public function view($teampage_num)
    {

        $team['team_page'] = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);

        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/view', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }


    public function modifyv($teampage_num)
    {
        $team['team_page'] = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/modifyv', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);

    }

    public function modify()
    {
        if (isset($_POST['submit_teampage_modify'])) {
            $teampage_num = isset($_REQUEST['teampage_num']) ? ($_REQUEST['teampage_num']) : null;
            $teampage_title = isset($_REQUEST['teampage_title']) ? ($_REQUEST['teampage_title']) : null;
            $teampage_content = isset($_REQUEST['teampage_content']) ? ($_REQUEST['teampage_content']) : null;
            $this->TeamModel->teampageModify($teampage_num, $teampage_title, $teampage_content);
        }
        $team['team_page'] = $this->TeamModel->teampageViewByTeampgeNum($teampage_num);
        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/view', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }


    public function memberlist()
    {
        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
        $team['team_page'] = $this->TeamModel->getTeam($team_name);
        $team['team_memberlist'] = $this->TeamModel->memberList($team_name);
        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/memberlist', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);
    }

    public function repagewrite()
    {
        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
        $team['team_page'] = $this->TeamModel->getTeam($team_name);
        $config = array();
        $team['teamMember'] = $this->TeamModel->teamMemberCheck($_SESSION['loginID'], $team_name);
        $config["base_url"] = "/team/page/";
        $config["total_rows"] = $this->TeamModel->teamBoard_count($team_name);
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $team["team_board"] = $this->TeamModel->fetch_boardList($team_name, $config["per_page"], $page);
        $team["links"] = $this->pagination->create_links();


        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/page', $team);
        $this->load->view('team/board', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);

    }

    public function teammodifyv()
    {
        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;

        $team['team_page'] = $this->TeamModel->getTeam($team_name);
        $team['team_home'] = explode("-", $team['team_page']->team_home);

        $this->load->view('./_templates/header.php', $this->data);
        $this->load->view('./_templates/Laside.php', $this->data);
        $this->load->view('team/teammodifyv', $team);
        $this->load->view('./_templates/Raside.php', $this->data);
        $this->load->view('./_templates/footer.php', $this->data);

    }

    public function teammodify()
    {

        if ($_POST['home'])
            $team_home = implode("-", $_POST['home']);

        $team_name = isset($_REQUEST['team_name']) ? ($_REQUEST['team_name']) : null;
        $team_ability = isset($_REQUEST['team_ability']) ? ($_REQUEST['team_ability']) : null;

        $this->TeamModel->updateTeam($team_name, $team_ability,$team_home);
        if ($_FILES['pfimage']['name']) {
            $team_pfiamge = isset($_REQUEST['team_pfimage']) ? ($_REQUEST['team_pfimage']) : null;
            $teamImgSavePath = "public/img/team/";
            $thumbnailImgSavePath = "public/img/team_s/";
            $fileMaxSize = 2000000;

            if ($team_name)
                unlink($teamImgSavePath . $team_pfiamge);

            $upImgFileInfo['name'] = isset($_FILES['pfimage']['name']) ? $_FILES['pfimage']['name'] : null;
            $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name']) ? $_FILES['pfimage']['tmp_name'] : null; //임시저장소
            $upImgFileInfo['type'] = isset($_FILES['pfimage']['type']) ? $_FILES['pfimage']['type'] : null;
            $upImgFileInfo['size'] = isset($_FILES['pfimage']['size']) ? $_FILES['pfimage']['size'] : null;
            $upImgFileInfo['error'] = isset($_FILES['pfimage']['error']) ? $_FILES['pfimage']['error'] : null;

            if ($upImgFileInfo['name'] && $upImgFileInfo['error'] == 0) { //값을 잘 받았고 에러가 없으면

                $imgFileType = pathinfo($upImgFileInfo['name'], PATHINFO_EXTENSION); //확장자 추출

                $saveFileName = str_replace('%', '', urlencode($team_name)); //id로 파일이름을생성! 한글인코드함수 ex)%EB$BC%

                $saveFileNameWithExt = $saveFileName . "." . strval($imgFileType); // Cds12.jpg같은 완전한 파일이름 생성!
                $thumbnailFileNameWithExt = $saveFileName . "_S" . "." . strval($imgFileType); //썸네일 파일이름 생성!

                $retArr2 = $this->singleFileUpload($upImgFileInfo, $teamImgSavePath, $saveFileNameWithExt, $fileMaxSize);
                if ($retArr2['uploadOk']) { //큰그림파일 올리는것 이상이없으면.
                    $pfimage = $saveFileNameWithExt; //Cds12.jpg같은 파일이름을 저장한다.

                    if ($imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif") {
                        $src = $teamImgSavePath . strval($saveFileNameWithExt); //이미지저장경로와 파일이름을 붙여 변수에 저장.
                        $dest = $thumbnailImgSavePath . strval($thumbnailFileNameWithExt); //썸네일이미지경로와 썸네일 파일이름을 붙여 변수에 저장.
                        $this->makeThumbnailImage($src, $dest, $imgFileType); //썸네일이미지 생성.
                        $this->makeSingleImage($src, $imgFileType); //싱글이미지생성
                        $psimage = $thumbnailFileNameWithExt;// Cds12_s.jpg같은 파일이름 저장.
                    }
                }
            }
            $this->TeamModel->updateTeamimg($pfimage, $psimage, $team_name);
        }
        header('location: /team');
    }


    public function hello()
    {
        $username = $this->input->post('username');
        $query = $this->TeamModel->is_username_exist($username);
        if ($query) {
            echo "success";
        } else {
            echo "fail";
        }
    }


}