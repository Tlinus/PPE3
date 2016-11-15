<?php


class Users extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        //models
        $this->load->model('role');
        $this->load->model('project');
        $this->load->model('task');
        $this->load->model('user');
        $this->load->model('conversation');

        $sessiondata = $this->session->userdata('logged_in');
        if( $sessiondata['loginuser'] && !($sessiondata['type'] === '0'))
        {
            redirect('logout');
        }
    }

    public function index ()
    {
        //Get User ID
        $sessiondata = $this->session->userdata('logged_in');
        $id_user = $sessiondata['id'];

        //Get User info
        $data['user'] = $this->user->get_user($id_user);

        //Check For Projects
        $projects = $this->role->get_role(false, $id_user);
        
        if( ! (empty($projects)))
        {
            //List Project
            $data['projects'] = $this->role->get_role(false, $id_user);

            //Get 1st Project ID
            $project = $this->role->get_id_project($id_user);
            $id_project = $project->id_projet;
            $this->session->set_userdata('id_project', $id_project);

            //Get Current Project
            $data['current_project'] = $this->project->get_project($id_project);

            //Get Main Tasks
            $tasks = $this->task->get_task(false, $id_project);
            $data['tasks'] = $tasks;

            //Get Mini Tasks
            $data['mini_tasks'] = $this->task->get_mini_task(false, $id_project);

            //Get Percentage
            $all_tasks = $this->task->get_all_task($id_project);
            $count = count($all_tasks);

            $all_tasks_done = $this->task->get_all_task_done($id_project);
            $count_done = count($all_tasks_done);

            $percentage = (100 * $count_done) / $count;

            $data['percent'] = $percentage;


            $this->load->view('templates/header');
            $this->load->view('user/user', $data);
             $this->load->view('modals/popup_addDirectory'); 
             $this->load->view('modals/popup_deleteSelection'); 
             $this->load->view('modals/popup_displayFile'); 
             $this->load->view('modals/popup_moveFile'); 
             $this->load->view('modals/popup_uploadFile');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->view('templates/header');
            $this->load->view('user/user_no', $data);
            $this->load->view('templates/footer');
        }


    }

    public function get_project($id_project)
    {
        //Get User ID
        $sessiondata = $this->session->userdata('logged_in');
        $id_user = $sessiondata['id'];

        //Get User info
        $data['user'] = $this->user->get_user($id_user);

        //List Project
        $data['projects'] = $this->role->get_role(false, $id_user);

        //Get Current Project
        $data['current_project'] = $this->project->get_project($id_project);

        //Get Main Tasks
        $data['tasks'] = $this->task->get_task(false, $id_project);

        //Get Mini Tasks
        $data['mini_tasks'] = $this->task->get_mini_task(false, $id_project);

        //Get Percentage
        $all_tasks = $this->task->get_all_task($id_project);
        $count = count($all_tasks);

        $all_tasks_done = $this->task->get_all_task_done($id_project);
        $count_done = count($all_tasks_done);

        $percentage = (100 * $count_done) / $count;

        $data['percent'] = $percentage;

        $this->load->view('templates/header');
        $this->load->view('user/user', $data);
        $this->load->view('modals/popup_addDirectory'); 
         $this->load->view('modals/popup_deleteSelection'); 
         $this->load->view('modals/popup_displayFile'); 
         $this->load->view('modals/popup_moveFile'); 
         $this->load->view('modals/popup_uploadFile');
        $this->load->view('templates/footer');
    }

    

}