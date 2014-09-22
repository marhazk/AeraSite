<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
class Validation extends CI_Controller
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
        $this->data ["status"] = null;

        if ($this->input->get("uniqueid") && $this->input->get("uname"))
        {
            $hash_key          = $this->input->get("uniqueid", TRUE);
            $username_to_check = $this->input->get("uname", TRUE);
            $usrData           = $this->getDataByHashID($hash_key, $username_to_check);

            if ($usrData [0] == "0" && $usrData [1] == "0" && $usrData [2] == "0" && $usrData [3] == "0")
            {
                $this->data ["status"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
            }
            else
            {
                $username = $usrData [0];
                $email    = $usrData [1];
                $comments = $usrData [2];
                $pass     = $usrData [3];

                $usrOutput = json_decode(file_get_contents('http://local.ryl2.perfectworld.com.my/ryl/reg_acc.php?username=' . $username . '&password=' . $pass . '&skey=aera123'));

                if ($usrOutput [0] == "1")
                {
                    $this->load->database("default");

                    $this->db->query("UPDATE account SET status = 1 where username = '$username'");

                    $this->db->close();

                    $this->data ["status"] = "Dear " . $username . ", your account validation is successful. Please launch game client to play.";
                }
                else
                {
                    $this->data ["status"] = "Error. Yo peep! You cannot valid your account twice. If any probs, please contact our admin.";
                }
            }
        }
        else
        {
            $this->data ["status"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
        }

        $this->load->vars($this->data);
        $this->load->view('validation');
    }

    public function getDataByHashID($hashid, $username_to_check)
    {
        $this->load->database("default");

        $userData = $this->db->query("select * from account where hash_key = '$hashid' and username = '$username_to_check' ");
        if ($userData->num_rows() > 0)
        {
            foreach ($userData->result() as $row)
            {
                $username = $row->username;
                $email    = $row->email;
                $comments = $row->comments;
                $pass     = $row->password;
            }
        }
        else
        {
            $username = 0;
            $email    = 0;
            $comments = 0;
            $pass     = 0;
        }

        $this->db->close();

        return array(
            $username,
            $email,
            $comments,
            $pass
        );
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */