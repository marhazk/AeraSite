<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
class Panel extends CI_Controller
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
        $this->load->helper('form');
        if ($this->session->userdata('username'))
        {

            $this->data ["title"]   = ":: User Panel " . $this->session->userdata('username');
            $this->data ["status"]  = $this->status_v();
            $this->data ["a_name"]  = $this->session->userdata('username');
            $this->data ["a_email"] = $this->session->userdata('email');
            $this->data ["chars"] = $this->char_details();

            if ($this->session->userdata('is_admin') == "1")
            {
                $this->data ["is_admin"] = true;
            }
            else
            {
                $this->data ["is_admin"] = false;
            }

            $this->load->vars($this->data);
            $this->load->view('header');
            $this->load->view('panel');
            $this->load->view('sidebar');
            $this->load->view('footer');
        }
        else
        {
            redirect('/login', 'refresh');
        }
    }

    public function status_v()
    {
        if ($this->session->userdata('status') == "1")
        {
            return "Validated.";
        }
        else
        {
            return "Account is not validated. Please login to your email to validate.";
        }
    }

    public function notice_post()
    {
        if ($this->session->userdata('is_admin') == "1")
        {
            $notice = $this->input->post("notice");
            $this->load->database("default");
            $this->db->query("insert into notices (notice)
					values ('" . $notice . " - by " . $this->session->userdata('username') . "')");
            $this->data ["log"] = "<span style='background:#18a416; color: #000000; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Notice posted!</span>";
            $this->db->close();
        }
        else
        {
            $this->data ["log"] = "<span style='background:#F30; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Error. You are not an admin somehow.</span>";
        }

        $this->index();
    }

    public function char_details()
    {
        $this->load->library('query');
        $uid = $this->query->querys("select uid from youxiuser.dbo.usertbl where account = '".$this->session->userdata('username')."'");
        return $this->query->querys("EXEC Part2_Zodiac.dbo.GetUnifiedCharList @UID = ".$uid[0]->uid."");
    }

    public function upload_screenshots()
    {
        $this->load->helper('url');
        $this->load->database("default");

        $dir_dest = 'screenshot';
        $dir_pics = $dir_dest;

        if ($this->input->post("action") == "s_upload")
        {
            $title = $this->input->post("title");
            $this->load->library('upload', $_FILES ['u_field']);

            $this->upload->file_new_name_body = $this->session->userdata('username') . "_UPLOAD_" . time();
            $this->upload->Process($dir_dest);

            if ($this->upload->processed)
            {
                if ($this->upload->file_is_image)
                {

                    $u_log = '<p class="result">' . '  <b>Screenshot uploaded with success</b><br />' . '  File: ' . $this->upload->file_dst_name . '   (' . round(filesize($this->upload->file_dst_pathname) / 256) / 4 . 'KB)' . '</p>';

                    $this->db->query("insert into screenshot (owner, title, file)
                        values ('" . $this->session->userdata('username') . "','$title','" . $this->upload->file_dst_name . "')");
                }
                else
                {
                    $u_log = '<p class="result">' . '  <b>Screenshot not uploaded to the wanted location</b><br />' . '  Error: File is not an image.' . '</p>';
                }
            }
            else
            {
                $u_log = '<p class="result">' . '  <b>Screenshot not uploaded to the wanted location</b><br />' . '  Error: ' . $this->upload->error . '' . '</p>';
            }

            $this->upload->Clean();
        }
        else
        {
            $u_log = '<p class="result">' . '  <b>Screenshot not uploaded on the server</b><br />' . '  Error: ' . $this->upload->error . '' . '</p>';
        }
        $this->data ["u_log"] = $u_log;
        $this->index();
    }
}

/* Location: ./application/controllers/welcome.php */