<?php


class Chef extends CI_Controller{

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
        if($sessiondata['loginuser'] && !($sessiondata['type'] == 1))
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
            $data['projects'] = $projects;

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

            if ($count_done != 0)
            {
                $percentage = (100 * $count_done) / $count;
                $data['percent'] = $percentage;
            }

            //Get User
            $user = $this->role->get_role($id_project, false);
            $data['users'] = $user;


            $this->load->view('templates/header');
            $this->load->view('chef/chef', $data);
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
            $this->load->view('chef/chef_no', $data);
            $this->load->view('templates/footer');
        }
    }

    public function get_project($id_project)
    {
        //Get User ID
        $sessiondata = $this->session->userdata('logged_in');
        $id_user = $sessiondata['id'];

        //Set Project ID To SESSION
        $this->session->set_userdata('id_project', $id_project);

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

        if($count_done != 0)
        {
            $percentage = (100 * $count_done) / $count;
            $data['percent'] = $percentage;
        }

        //Get User
        $user = $this->role->get_role($id_project, false);
        $data['users'] = $user;

        $this->load->view('templates/header');
        $this->load->view('chef/chef', $data);
        $this->load->view('templates/footer');
    }
    
    public function update_task()
    {
        $id_project = $this->session->userdata('id_project');

        $config = array(
            array(
                'field' =>  'title[]',
                'rules' =>  'required'
            ),
            array(
                'field' =>  'deadline[]',
                'rules' =>  'required'
            ),
            array(
                'field' =>  'comment[]',
                'rules' =>  'required'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error', 'wrong information in the form');
            redirect('chef');
        }

        $task = $this->input->post();
        $title = $this->input->post('title');
        $deadline = $this->input->post('deadline');
        $comment = $this->input->post('comment');

        $title_mini = $this->input->post('title[mini]');
        $deadline_mini = $this->input->post('deadline[mini]');
        $comment_mini = $this->input->post('comment[mini]');

        foreach ($task as $k => $item):
                endforeach;
        foreach ($item as $key => $value):
            $id = $key;
            $data = array(
                        'intitule'      =>  $title[$key],
                        'dead_line'     =>  $deadline[$key],
                        'commentaire'   =>  $comment[$key]
            );
            print_r($data);

            if ($key != "mini")
            {
                $query = $this->task->update_task($data, $id);
            }
        endforeach;

        if($title_mini && $deadline_mini && $comment_mini)
        {
            $id = current(array_keys($item));

            foreach ($task as $k => $item):
            endforeach;
            foreach ($item['mini'] as $key => $value):
                $data = array(
                    'intitule'          =>  $title_mini[$key],
                    'dead_line'         =>  $deadline_mini[$key],
                    'commentaire'       =>  $comment_mini[$key],
                    'id_projet'         =>  $id_project,
                    'sous_tache_id'     =>  $id,
                    'is_sstache'        =>  1,
                    'done'              =>  0
                );
                $mini = $this->task->set_task($data, true);
            endforeach;
        }


        if($query OR $mini):

            $this->session->set_flashdata('success', 'task updated');

        else:

            $this->session->set_flashdata('error', 'sorry try again later');

        endif;

        redirect('chef/project/'.$id_project);

    }

    public function set_task()
    {
        $config = array(
            array(
                'field' =>  'title[]',
                'rules' =>  'required'
            ),
            array(
                'field' =>  'deadline[]',
                'rules' =>  'required'
            ),
            array(
                'field' =>  'comment[]',
                'rules' =>  'required'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error', 'wrong information in the form');
            redirect('chef');
        }

        $id_project = $this->session->userdata('id_project');

        $data = array(
            'intitule'          =>  $this->input->post('title[main]'),
            'dead_line'         =>  $this->input->post('deadline[main]'),
            'commentaire'       =>  $this->input->post('comment[main]'),
            'id_projet'         =>  $id_project,
            'sous_tache_id'     =>  0,
            'is_sstache'        =>  0,
            'done'              =>  0
        );

        var_dump($this->input->post());

        $main = $this->task->set_task($data, false);

        $id = $this->task->last_id();
        
        $title_mini = $this->input->post('title[mini]');
        $deadline_mini = $this->input->post('deadline[mini]');
        $comment_mini = $this->input->post('comment[mini]');

        $mini = $this->input->post();

        foreach ($mini as $k => $item):
        endforeach;
        foreach ($item['mini'] as $key => $value):
            $data = array(
                'intitule'          =>  $title_mini[$key],
                'dead_line'         =>  $deadline_mini[$key],
                'commentaire'       =>  $comment_mini[$key],
                'id_projet'         =>  $id_project,
                'sous_tache_id'     =>  $id,
                'is_sstache'        =>  1,
                'done'              =>  0
            );
            $mini = $this->task->set_task($data, true);
            endforeach;


            if($main && $mini)
            {
                $this->session->set_flashdata('success', 'task updated');
            }
            else
            {
                $this->session->set_flashdata('error', 'sorry try again later');
            }

        redirect('chef/project/'.$id_project);
    }

    public function ban_user($id)
    {
        $id_project = $this->session->userdata('id_project');

        if($this->role->delete_role($id, false))
        {
            $this->conversation->removeUser($id_project,$id);
            $this->session->set_flashdata('success', 'user has been ban');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        redirect('chef/project/'.$id_project);
    }
    
    public function add_user($id, $fonction)
    {
        $id_project = $this->session->userdata('id_project');

        if($this->role->set_role($id, $id_project, $fonction))
        {
            $this->conversation->addUser($id_project,$id);
            $this->session->set_flashdata('success', 'user has been added');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        redirect('chef/project/'.$id_project);
    }

    public function set_project()
    {
        $config = array(
            array(
                'field' =>  'title',
                'rules' =>  'required'
            ),
            array(
                'field' =>  'deadline',
                'rules' =>  'required'
            ),
        );

        $this->form_validation->set_rules($config);

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 10240;

        $this->load->library('upload', $config);

        if($this->form_validation->run() == false OR $this->upload->do_upload('userfile'))
        {
            $this->session->set_flashdata('error', 'wrong information in the form');
            redirect('chef');
        }
        $project = $this->project->set_project();
        $id_project = $this->project->last_id();

        $sessiondata = $this->session->userdata('logged_in');
        $id_user = $sessiondata['id'];

        $role = $this->role->set_role($id_user, $id_project, 'Créateur');
        
        if($project && $role && $this->project->addRoot($id_project))
        {
            $this->conversation->setConversation($id_project);
            $this->conversation->addUser($id_project,$id_user);
            $this->session->set_flashdata('success', 'new project has been created');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        redirect('chef/project/'.$id_project);
        
    }

    public function delete_project()
    {
        $id_project = $this->session->userdata('id_project');

        $delete_role = $this->role->delete_role($id_project, true);
        
        $delete_task = $this->task->delete_task($id_project);

        $delete = $this->project->delete_project($id_project);

        if($delete_role && $delete && $delete_task)
        {
            $this->conversation->deleteConversation($id_project);
            $this->session->set_flashdata('success', 'project has been deleted');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        redirect('chef');

    }
     public function sendDirContent()
  {
      $idDir = $_POST['id'];
      $idProject = $_POST['project'];
      if($idDir && $idProject){
          $Facade = new SystemFacade($idProject);
            $id=$Facade->decrypt($idFile);
            $Facade->setCurrentFile($id);
            echo $Facade->makeFileList();
      }
  }

}