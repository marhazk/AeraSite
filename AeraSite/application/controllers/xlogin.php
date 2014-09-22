<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->library('session');
        $this->load->helper('url');
        if ($this->session->userdata('username'))
        {

            redirect('/panel', 'refresh');
        }
        else
        {
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->data ["title"] = ":: SIGN IN";
            $this->load->vars($this->data);
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('sidebar');
            $this->load->view('footer');
        }

    }

    public function login_in()
    {
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database("default");
        $uname = $this->input->post("username");
        $upass = $this->input->post("pass");

        $query = $this->db->query("select * from account where username = '" . $uname . "' and password = '" . $upass . "'");
        if ($query->num_rows() == 1)
        {
            foreach ($query->result() as $row)
            {
                $session_data = array(
                    'username' => $row->username,
                    'email'    => $row->email,
                    'status'    => $row->status,
                    'is_admin' => $row->admin
                );

            }
            $this->session->set_userdata($session_data);
            redirect('/panel', 'refresh');
        }
        else
        {
            $this->data ["status"] = "<span style='background:#F30; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Invalid username or password or both of them. Please try again.</span>";
            $this->db->close();
            $this->index();
        }




    }

    public function destroy_session()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        $this->index();
    }
}

/* Location: ./application/controllers/welcome.php */