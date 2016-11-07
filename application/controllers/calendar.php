<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this -> load -> database();
        $this -> load -> model('CalendarModel');
    }

    public function index()
    {
        $calendar_model = $this->CalendarModel;
        $schedule = $calendar_model->schedule($this -> data['user_id']);

        $calendar['result_schedule'] = json_encode($schedule, JSON_UNESCAPED_UNICODE );



        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./calendar/schedule.php', $calendar);
        $this->load->view('./_templates/Raside.php', $this -> data);

    }


}
