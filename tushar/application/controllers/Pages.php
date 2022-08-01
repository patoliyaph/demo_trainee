<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('Pages_model');
    }

    public function signup()
    {
        $user = $this->session->userdata('email');
        $data['email'] = $user;

        if ($this->input->POST('submit')) 
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('dob', 'Dob', 'trim|required|callback_validate_age');
            $this->form_validation->set_message('validate_age','You must be 18 years old to sign up.!');
            $this->form_validation->set_rules('r1', 'Gender', 'required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|callback_valid_password');
            
            $this->form_validation->set_rules('cpassword', 'Cpassword', 'trim|required|matches[password]');
            if (empty($_FILES['img']['name'])) 
            {
                $this->form_validation->set_rules('img', 'Img', 'required');
            }

            if ($this->form_validation->run() === FALSE) 
            {
                echo validation_errors('<div class="alert alert-danger">', '</div>');       
            } 
            else 
            {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');   
                $data['dob'] = $this->input->post('dob');
                $data['gender'] = $this->input->post('r1');
                $data['password'] = md5($this->input->post('password'));
                $data['img'] = $_FILES['img']['name'];

                if (isset($_FILES['img']['name'])) 
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 100;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 768;

                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);
                    $this->upload->do_upload("img");
                    $img_name = $this->upload->data();
                    $data['img'] = $img_name['file_name'];

                    $this->load->model('Pages_model');
                    if ($this->Pages_model->imgUpload($data)) 
                    {
                        echo '<img src="./pictures/' . $img_name['file_name'] . '" alt="">';
                    }
                } 
                else 
                {
                    echo 'error';
                }
                $this->session->set_userdata('email');
                $this->session->set_flashdata('success', 'Record Added SuccessFully!');
                redirect(base_url() . 'index.php/pages/login');
            }
        }
        $this->load->view('pages/signup',$data);
    }

    public function index()
    {  
        $user = $this->session->userdata('email');
        if($user)
        {
            $this->load->view('pages/index');
        }
        else
        {
            redirect(base_url() . 'index.php/pages/login');
        }
    }

    public function item()
    {
        $resultList = $this->Pages_model->fetchAllData('*', 'emp', array());

        $result = array();
        $i = 1;
        foreach ($resultList as $key => $row) 
        {
            $img = '<img src="/codeigniter/uploads/' . $row['img'] . '" width="100px" alt="img" >';
            $button = '<a class="btn btn-primary text-light" href="view/' . $row['id'] . '"> View</a> ';

            $button .= '<a class="btn btn-success text-light" href="edit/' . $row['id'] . '"> Edit</a> ';

             $button .=  ' <a class="delete btn btn-danger text-light " style="padding-left:7px; padding-right:7px;" href="delete/' .$row['id'].'"> Delete</a>';
            
            $result['data'][] = array(
                $i++,
                $row['name'],
                $row['email'],
                $row['dob'],
                $row['gender'],
                $img,
                $row['creat_dt'],
                $button
            );
        }
        echo json_encode($result);

        exit();
    }

    public function delete($id)
    {
        $this->Pages_model->deleteEmp($id);
        redirect(base_url() . 'index.php/pages/index');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        redirect(base_url() . 'index.php/pages/login', 'refresh');
    }

    public function login()
    {
        $this->load->view('pages/login');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|callback_valid_password');

        if ($this->form_validation->run() == TRUE) 
        {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            $this->db->select('*');
            $this->db->from('emp');
            $this->db->where(array('email' => $email, 'password' => $password));
            $query = $this->db->get();
            $emp = $query->row();

            if ($emp->email) 
            {
                $_SESSION['user_logged'] = TRUE;
                $sessArray = array(
                    'email' => $email
                );
                $this->session->set_userdata($sessArray);
                
                redirect(base_url() . 'index.php/pages/enter');
            } else 
            {
                $this->session->set_flashdata('msg', 'Invalid Email or Password!');
                redirect(base_url() . 'index.php/pages/login', 'refresh');
            }
        } 
        else 
        {
            echo validation_errors('<div class="alert alert-danger">', '</div>');
        }
    }

    public function enter()
    {
        if($this->session->userdata('email') != '')
        { 
            $this->session->set_flashdata('success', 'You are SuccessFully Logedin!');
            redirect(base_url() . 'index.php/pages/index');
        }
        else
        {
            redirect(base_url() . 'index.php/pages/login', 'refresh');
        }
    }

    
    public function add()
    {
        $user = $this->session->userdata('email');
        if($user)
        {
            $this->load->view('pages/add');

            if ($this->input->POST('submit')) 
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('dob', 'Dob', 'trim|required|callback_validate_age');
                $this->form_validation->set_message('validate_age','You must be 18 years old.!');
                $this->form_validation->set_rules('r1', 'Gender', 'required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|callback_valid_password');
                
                $this->form_validation->set_rules('cpassword', 'Cpassword', 'trim|required|matches[password]');
                if (empty($_FILES['img']['name'])) 
                {
                    $this->form_validation->set_rules('img', 'Img', 'required');
                }

                if ($this->form_validation->run() === FALSE) 
                {
                    echo validation_errors('<div class="alert alert-danger">', '</div>');
                } 
                else 
                {
                    $data['name'] = $this->input->post('name');
                    $data['email'] = $this->input->post('email');
                    $data['dob'] = $this->input->post('dob');
                    $data['gender'] = $this->input->post('r1');
                    $data['password'] = md5($this->input->post('password'));
                    $data['img'] = $_FILES['img']['name'];

                    if (isset($_FILES['img']['name'])) 
                    {
                        $img = "img";
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['max_size'] = 100;
                        $config['max_width'] = 1024;
                        $config['max_height'] = 768;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);
                        $this->upload->do_upload("img");
                        $img_name = $this->upload->data();
                        $data['img'] = $img_name['file_name'];

                        if ($this->Pages_model->addEmp($data)) 
                        {
                            echo '<img src="./pictures/' . $img_name['file_name'] . '" alt="">';
                        }
                    } 
                    else 
                    {
                        echo 'error';
                    }
                    $this->session->set_flashdata('success', 'Your Record Added SuccessFully!');
                    redirect(base_url() . 'index.php/pages/index');
                }
            }
        }
        else
        {
            redirect(base_url() . 'index.php/pages/login');
        } 
        
    }


    public function validate_age($age) 
    {
        $dob = new DateTime($age);
        $now = new DateTime();
        if($now->diff($dob)->y > 18) {
            return true;
        }
        return false;
    }

    public function valid_password($password = '')
    {
        $password = trim($password);

        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

        if (empty($password)) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');

            return FALSE;
        }

        if (preg_match_all($regex_lowercase, $password) < 1) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_uppercase, $password) < 1) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_number, $password) < 1) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

            return FALSE;
        }

        if (preg_match_all($regex_special, $password) < 1) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

            return FALSE;
        }

        if (strlen($password) < 5) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

            return FALSE;
        }

        if (strlen($password) > 32) 
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

            return FALSE;
        }

        return TRUE;
    }

    public function view($id)
    {
        $data['user'] = $this->Pages_model->viewEmp($id);
        $this->load->view('pages/view', $data);
    }

    public function edit($id)
    {
        $user = $this->session->userdata('email');
        if($user)
        {
            $data['user'] = $this->Pages_model->editEmp($id);
            $this->load->view('pages/edit', $data);
        }
        else
        {
            redirect(base_url() . 'index.php/pages/login');
        } 
    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dob', 'Dob', 'required');
        $this->form_validation->set_rules('r1', 'Gender', 'required');

        if ($this->form_validation->run() == TRUE) 
        {
            $old_img = $this->input->post('old_img');
            $new_img = $_FILES["img"]["name"];

            if ($new_img == TRUE) {
                if (isset($_FILES['img']['name'])) 
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 100;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 768;
                
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);
                    $this->upload->do_upload("img");
                    $img_name = $this->upload->data();
                    $data['img'] = $img_name['file_name'];

                    if (file_exists("./codeigniter/uploads/" . $old_img)) 
                    {
                        unlink("./codeigniter/uploads/  " . $old_img);
                    }
                }
            } 
            else 
            {
                $new_img = $old_img;
            }

            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['dob'] = $this->input->post('dob');
            $data['gender'] = $this->input->post('r1');
            $data['img'] = $new_img;
            $this->Pages_model->updateEmp($data, $id);

            $this->session->set_flashdata('success', 'Your Record Edited SuccessFully!');
            redirect(base_url() . 'index.php/pages/index');
        } 
        else 
        {
            echo validation_errors('<div class="alert alert-danger">', '</div>');
        }
    } 
}
