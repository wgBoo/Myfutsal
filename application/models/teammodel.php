<?php

class Teammodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function getTeamList($user_id)
    {
        $this->db->select('t.*,a.main_team_check');
        $this->db->from('team t');
        $this->db->join('attach_team a', 'a.team_name = t.team_name', 'left');
        $this->db->where(array('a.user_id' => $user_id));

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function teamCheck($user_id)
    {
        return $this->db->get_where('team', array('team_leader' => $user_id))->row();
    }

    function makeTeam($team_name, $team_ability, $team_produce, $team_leader, $team_home, $main_team_check)
    {
        $data = array(
            'team_name' => $team_name,
            'team_ability' => $team_ability,
            'team_produce' => $team_produce,
            'team_leader' => $team_leader,
            'team_home' => $team_home,
        );
        $this->db->insert('team', $data);

        $data = array(
            'team_name' => $team_name,
            'user_id' => $team_leader,
            'main_team_check' => $main_team_check
        );
        $this->db->insert('attach_team', $data);
    }

    function updateTeamimg($pfimage, $psimage, $team_name)
    {
        $data = array(
            'team_pfimage' => $pfimage,
            'team_psimage' => $psimage,
        );
        $this->db->where('team_name', $team_name);
        $this->db->update('team', $data);
    }
    function teamBoard_count($team_name)
    {
        $this->db->where("team_name",$team_name);
        $query = $this->db->count_all_results('teampage');
        return $query;
    }

    function fetch_boardList($team_name, $limit, $start)
    {
        $this->db->where("team_name", $team_name);
        $this->db->order_by("teampage_group_num", "desc");
        $this->db->order_by("teampage_ord", "asc");
        $this->db->limit($limit,$start);
        $query = $this->db->get("teampage");

        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    function getTeam($team_name)
    {
        return $this->db->get_where('team', array('team_name' => $team_name))->row();
    }

    function teampageWrite($team_name, $user_id, $teampage_category, $teampage_title, $teampage_content)
    {
        $data = array(
            'team_name' => $team_name,
            'user_id' => $user_id,
            'teampage_category' => $teampage_category,
            'teampage_title' => $teampage_title,
            'teampage_content' => $teampage_content,
            'teampage_date' => date("Y-m-d H:i:s")
        );
        $this->db->insert('teampage', $data);
        $autoTeampage_num = $this->db->insert_id();
        return $autoTeampage_num;
    }

    function teampageViewByTeampgeNum($teampage_num)
    {
        $this->db->select('t.*,p.*');
        $this->db->from('team t');
        $this->db->join('teampage p', 'p.team_name = t.team_name', 'left');
        $this->db->where(array('p.teampage_num' => $teampage_num));

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function teampageDelete($teampage_num)
    {
        $this->db->delete('teampage', array('teampage_num' => $teampage_num));
    }

    function teampageModify($teampage_num, $teampage_title, $teampage_content)
    {
        $data = array(
            'teampage_title' => $teampage_title,
            'teampage_content' => $teampage_content
        );
        $this->db->where('teampage_num', $teampage_num);
        $this->db->update('teampage', $data);
    }

    function memberList($team_name)
    {
        $this->db->select('a.main_team_check,m.*');
        $this->db->from('attach_team a');
        $this->db->join('member m', 'm.user_id = a.user_id');
        $this->db->where(array('a.team_name' => $team_name));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function updateTeampageResponse($teampage_group_num, $teampage_depth, $teampage_ord, $teampage_num)
    {
        $data = array(
            'teampage_group_num' => $teampage_group_num,
            'teampage_depth' => $teampage_depth,
            'teampage_ord' => $teampage_ord
        );
        $this->db->where('teampage_num', $teampage_num);
        $this->db->update('teampage', $data);
    }

    function updateTeampageOrd($teampage_group_num, $teampage_ord)
    {
        $sql = "UPDATE teampage
                SET teampage_ord = teampage_ord+1
                where teampage_group_num = $teampage_group_num
                AND teampage_ord > $teampage_ord";

        return $this->db->query($sql);

    }

    function insertResponseBoard($team_name, $user_id, $teampage_category, $teampage_title, $teampage_content, $teampage_group_num, $teampage_depth, $teampage_ord)
    {
        $data = array(
            'team_name' => $team_name,
            'user_id' => $user_id,
            'teampage_category' => $teampage_category,
            'teampage_title' => $teampage_title,
            'teampage_content' => $teampage_content,
            'teampage_date' => date("Y-m-d H:i:s"),
            'teampage_group_num' => $teampage_group_num,
            'teampage_depth' => $teampage_depth,
            'teampage_ord' => $teampage_ord
        );
        $this->db->insert('teampage', $data);
    }
    function updateTeam($team_name, $team_ability,$team_home){
        $data = array(
            'team_ability' => $team_ability,
            'team_home' => $team_home
    );
        $this->db->where('team_name', $team_name);
        $this->db->update('team', $data);
    }
    function teamMemberCheck($user_id, $team_name){
        $this->db->where('user_id',$user_id);
        $this->db->where('team_name',$team_name);
        $query = $this->db->get("attach_team");
        return $query->result();
    }
    function is_username_exist($username)
    {

        $this->db->where('user_id', $username);
        $query = $this->db->get('member');

        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }



}

