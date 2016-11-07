<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('topic_model');
    }
    function index(){

        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
        $this->load->view('main');
    }

    function get($id){
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
        $topic = $this->topic_model->get($id);
        $this->load->view('get', array('topic'=>$topic));
    }
}
?>