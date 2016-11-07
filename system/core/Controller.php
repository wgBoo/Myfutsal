<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{

		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');



		/************* 왼쪽메뉴를 위해 *****************/
		$this -> data['user_id'] = $this -> user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
		$this -> data['timeline_user'] = $this -> timeline_user = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : $this -> user_id;

		$this->load->database();
		$this->load->model('TimelineModel');

		// 왼쪽 메뉴 사진을 위해(나를 포함한 다른사람 타임라인)
		$this -> data['leftImg'] = $this -> leftImg = $this -> TimelineModel -> leftTimeline($this -> timeline_user);
		/********************** *****************/


		/*************** 오른쪽 즐겨찾기 메뉴 ***************************/
		$this -> data['$favorites'] = $favorites = $this -> rightMenuStart();
		// 즐겨찾기 한 유저를 구한다.
		$this -> data['favorites_User'] = $this -> favorites_User = $favorites['favorites_User'];
		// 즐겨찾기 팀 목록을 구한다.
		$this -> data['own_Team'] = $this -> own_Team = $favorites['own_Team'];
		/************************* ***********************************/



		/*************** header부분의 로그인한 사용자 사진을 들고 오기 위해 *******/
		$this->load->database();
		$this->load->model('DetailModel');
		$this -> data['myInfoList'] = $this -> myInfoList = $this -> DetailModel -> find_user($this -> user_id);
		/*************** *****************************************************/







	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}


	// 오른쪽 즐겨찾기 메뉴
	public function rightMenuStart(){

		$this->load->database();
		$this->load->model('RightMenuModel');


		// 일단 id는 kite3305라고 한다.
		@$id = $_SESSION['loginID'];

		// 즐겨찾기 한 유저를 구한다.
		$favorites_User = $this -> RightMenuModel -> favoriteUser($id);

		// 즐겨찾기 팀 목록을 구한다.
		$own_Team = $this -> RightMenuModel -> favoriteOwnTeam($id);

		$rightMenu['favorites_User'] = $favorites_User;
		$rightMenu['own_Team'] = $own_Team;

		return $rightMenu;
	}



	public function singleFileUpload($uploadFileInfo, $uploadPath, $saveFileName, $fileMaxSize){

		$targetDir = $uploadPath; //이미지 저장경로
		$targetFile = $targetDir.basename($saveFileName); //경로와 파일을붙여준다!!
		$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);//확장자를 때준다.

		$check = getimagesize($uploadFileInfo["tmp_name"]); //이미지 크기를 가져오는 내장함수
		if($check != false) { //파일 이미지크기가 있을때!
			$returnArr['msg'][0] = "File is an image - " . $check["mime"] . ".";
			$returnArr['uploadOk'] = 1;
		} else {
			$returnArr['msg'][0] = "File is not an image.";
			$returnArr['uploadOk'] = 0;
		}


		if (file_exists($targetFile)) { //파일이나 디렉토리가 존재하는지 여부 판별, 존재하면 true반환
			$returnArr['msg'][1] = "Sorry, file already exists.";
			$returnArr['uploadOk'] = 0;
		}


		if ($uploadFileInfo["size"] > $fileMaxSize) { //업로드한 파일사이즈가 최대사이즈보다 클때
			$returnArr['msg'][2] = "Sorry, your file is too large.";
			$returnArr['uploadOk'] = 0;
		}


		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" //이미지확장자가 아닐때
			&& $imageFileType != "gif" ) {
			$returnArr['msg'][3] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$returnArr['uploadOk'] = 0;
		}


		if ($returnArr['uploadOk'] == 0) {
			$returnArr['msg'][4] = "Sorry, your file was not uploaded."; //위에중에 하나라도 0이있으면 파일없로드실패!
		} else { //임시저장소에 파일주소와 파일이름을붙인 경로를 옮긴다
			if (move_uploaded_file($uploadFileInfo["tmp_name"], $targetFile)) {//업로드 파일을 새로운위치로 옮긴다
				$returnArr['msg'][5] = "The file ". basename( $uploadFileInfo["name"]). " has been uploaded.";
			} else {
				$returnArr['msg'][5] = "Sorry, there was an error uploading your file.";
			}
		}

		return $returnArr;
	}

	public function makeThumbnailImage($src, $dest, $imgFileType) {

		if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
			$sourceImage = imagecreatefromjpeg($src); //파일이나 URL에서 새이미지 생성. 원본이미지!
		}elseif ( $imgFileType == "png") {
			$sourceImage = imagecreatefrompng($src);
		}else{
			$sourceImage = imagecreatefromgif($src);
		}

		$width = imagesx($sourceImage); //이미지 가로를 얻어온다.
		$height = imagesy($sourceImage); //이미지 세로를 얻어온다.

		$desiredWidth = 40;
		$desiredHeight = 40;

		$virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight); //새로운 트루컬러이미지를 만든다.

		imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
		//리샘플링과함께 복사해서 사이즈를 조절한다.

		if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
			imagejpeg($virtualImage, $dest); //파일또는 브라우져로 이미지를 출력한다. 썸네일이미지를!
		}elseif ( $imgFileType == "png") {
			imagepng($virtualImage, $dest);
		}else{
			imagegif($virtualImage, $dest);
		}

	}

	public function makeSingleImage($src, $imgFileType) {


		if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
			$sourceImage = imagecreatefromjpeg($src); //파일이나 URL에서 새이미지 생성. 원본이미지!
		}elseif ( $imgFileType == "png") {
			$sourceImage = imagecreatefrompng($src);
		}else{
			$sourceImage = imagecreatefromgif($src);
		}

		$width = imagesx($sourceImage); //이미지 가로를 얻어온다.
		$height = imagesy($sourceImage); //이미지 세로를 얻어온다.

		$desiredWidth = 133;
		$desiredHeight = 133;

		$virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight); //새로운 트루컬러이미지를 만든다.

		imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
		//리샘플링과함께 복사해서 사이즈를 조절한다.

		unlink($src);//원본이미지를 삭제한다.

		if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
			imagejpeg($virtualImage, $src); //파일또는 브라우져로 이미지를 출력한다. 썸네일이미지를!
		}elseif ( $imgFileType == "png") {
			imagepng($virtualImage, $src);
		}else{
			imagegif($virtualImage, $src);
		}

	}
}
