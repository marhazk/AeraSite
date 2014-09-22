<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
class Screenshot extends CI_Controller
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
        $this->load->helper('url');
        $this->load->helper('date');
        if ($this->input->get('file'))
        {
            $this->data["loc"] = "screenshot/" . $this->input->get('file');

            $data                 = explode("_UPLOAD_", $this->input->get('file'));
            $owner                = $data[0];
            $timeuploaded         = $data[1];
            $this->data ["title"] = ":: Screenshot by " . $owner;
            $this->data ["owner"] = $owner;
            $this->data ["sharer"] = $this->input->get('file');

            $date_uploaded = unix_to_human($timeuploaded);

            $this->data ["date_uploaded"] = $date_uploaded;

            $this->load->vars($this->data);
            $this->load->view('header');
            $this->load->view('screenshot');
            $this->load->view('sidebar');
            $this->load->view('footer');
        }
        else
        {
            $this->data ["title"] = ":: Screenshots";
            $this->data ["screenshot"] = $this->getAllScreenshot();
            $this->load->vars($this->data);
            $this->load->view('header');
            $this->load->view('screenshot2');
            $this->load->view('sidebar');
            $this->load->view('footer');
        }

    }

    public function getAllScreenshot()
    {
        $this->load->database("default");
        if ($query = $this->db->query("select * from screenshot order by id desc"))
        {
            return $query;
        }
        $this->db->close();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */