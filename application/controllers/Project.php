<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Project extends REST_Controller {

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get(){
        $id = $this->get('Id');
        if ($id == '') {
            $project = $this->db->get('tbl_student')->result();
        } else {
            $this->db->where('Id',$id);
            $project = $this->db->get('tbl_student')->result();
        }
        $this->response($project,200);
        
    }

    function index_post(){
        $data = array (
            'reg_number' => $this->post('reg_number'),
            'name' => $this->post('name'),
            'class' => $this->post('class'),
            'major' => $this->post('major')
        );
        $insert = $this->db->insert('tbl_student',$data);
        if ($insert) {
            $this->response($data,200);
        } else {
            $this->response(array('status' => 'fail',502));
        }
        
    }

    function index_put(){
        $id = $this->put('Id');
        $data = array (
            'reg_number' => $this->put('reg_number'),
            'name' => $this->put('name'),
            'class' => $this->put('class'),
            'major' => $this->put('major')
        );
        $this->db->where('Id',$id);
        $update = $this->db->update('tbl_student',$data);
        if ($update) {
            $this->response($data,200);
        } else {
            $this->response(array('status'=> 'fail', 502));
        }
        
    }

    function index_delete(){
        $id = $this->delete('Id');
        $this->db->where('Id',$id);
        $delete = $this->db->delete('tbl_student');
        if ($delete) {
            $this->response(array('status'=> 'success',201));
        } else {
            $this->response(array('status'=> 'fail',502));
        }
        
    }
}