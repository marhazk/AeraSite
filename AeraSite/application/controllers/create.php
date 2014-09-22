<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
class Create extends CI_Controller
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
        $this->load->helper('form');
        $this->data ["title"] = ":: Create Account";
        // $this->data ["full_link"] = "http://www.4shared.com/file/sQH785kL/RYL2Aera-Setup.html";
        // $this->data ["patch_link"] = "http://www.4shared.com/file/Foep1HoJ/patch-latest.html";
        $this->load->vars($this->data);
        $this->load->view('header');
        $this->load->view('create');
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    public function reg()
    {
        $this->load->database("default");
        $uname      = $this->input->post("username");
        $upass      = $this->input->post("pass");
        $umail      = $this->input->post("email");
        $ucomment   = $this->input->post("comments");
        $hash_key   = uniqid();
        $table_name = "account";

        if (empty ($uname) || empty ($upass) || empty ($umail) || empty ($ucomment))
        {
            $this->data ["status"] = "<span style='background:#F30; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Registration error. Please fill in the empty form.</span>";
        }
        else
        {
            if ($this->db->query("insert into " . $table_name . "(username, password, email, hash_key, comments)
					values ('$uname','$upass','$umail','$hash_key','$ucomment')")
            )
            {
                if ($this->sendMail($umail, $uname, $hash_key, $ucomment))
                {
                    $this->data ["status"] = "<span style='background:#18a416; color: #000000; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Registration success. Please check your email.</span>";
                }
                else
                {
                    $this->db->query("delete from account where username = '$uname'");
                    $this->data ["status"] = "<span style='background:#F30; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Invalid email. Please re-register again.</span>";
                }
            }
            else
            {
                $this->data ["status"] = "<span style='background:#F30; border-color:#000; border:1px solid; padding:5px 5px 5px 5px'>Registration error. Please check your input data.</span>";
            }
        }

        $this->db->close();

        $this->index();
    }

    public function sendMail($email, $uname, $skey, $ucomments)
    {
        $this->load->library('email');
        $this->email->from('support@ryl2.perfectworld.com.my', 'RYL2 Aera Support');
        $this->email->to($email);
        $msg = '<p>Dear ' . $uname . ', </p>
<p>  Your registeration has been accepted. Please check the following details:</p>
<p>Username : ' . $uname . '<br />
  Password : ****<br />
  Your comments : ' . $ucomments . '
</p>
<p>If all the details is correct, you may proceed by clicking this <a href="http://ryl2.perfectworld.com.my/index.php/validation?uniqueid=' . $skey . '&uname=' . $uname . '">link</a> to verify. </p>
<p><strong>NOTE: </strong></p>
<p><strong>  By clicking the link, you are agree with our terms (Tester Terms) listed below:</strong></p>
<p><strong>1. You may report bugs at facebook fanpage, but do not hope that admins will entertain you.<br />
2. No items selling (using Ringgit Malaysia or other currency).<br />
3. Starting October 2013, server will be down in weeks on Monday 1am - 4am</strong>.</p>
<p>Regards, </p>
<p>RYL2Aera Supports.</p>';
        $this->email->subject('User Account Validation');
        $this->email->message($msg);

        if ($this->email->send())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */