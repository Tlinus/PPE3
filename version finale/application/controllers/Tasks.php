<?php


class Tasks extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        //models
        $this->load->model('project');
        $this->load->model('task');
    }

    public function done_task()
    {
        $id_tasks = $this->input->post('done');
        $id_project = $this->input->post('id_project');

        //Get Percent
        $all_tasks = $this->task->get_all_task($id_project);
        $count = count($all_tasks);

        $all_tasks_done = $this->task->get_all_task_done($id_project);
        $count_done = count($all_tasks_done);

        $percentage = (100 * $count_done) / $count;

        foreach ($id_tasks as $id => $done)
        {
            $done = $this->task->done_task($id);
        }

        if($done)
        {
            $this->session->set_flashdata('success', 'task done!');
        }
        else if ($percentage == 100){
            $this->session->set_flashdata('primary', 'All Task are done!');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        $sessiondata = $this->session->userdata('logged_in');

        if ($sessiondata['type'] == 2)
        {
            redirect('admin/project/'. $id_project .'');
        }
        if ($sessiondata['type'] == 0)
        {
            redirect('user');
        }

    }

    public function get_task_group($id)
    {
        $id_project = $this->session->userdata('id_project');
        echo json_encode(array($this->task->get_task($id, $id_project), $this->task->get_mini_task($id, $id_project)));
    }
    
}