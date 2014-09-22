<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property mixed aera
 * @property mixed data
 * @property mixed aeravars
 * @property mixed db
 * @property mixed uri
 * @property mixed session
 */
class _NAMA_CLASS_ extends CI_Controller
{

    /////////////////////////////////////////////////////////////
    ////////////////// BEGIN OF MAIN FUNCTIONS //////////////////
    /////////////////////////////////////////////////////////////

    // Revision : 0005

    //Guide for $this->aera->sql functions
    // $sql = $this->aera->sql($tblName, $tblVal, $tblOption);
    //
    // $tblName		= Table Name (STRING)
    // $tblVal		= Table Attributes (ARRAY (tblAttr => tblValue)
    // $tblOption	= Table Parameters
    //				(Default:	NULL for SELECT
    //				returning SELECT * FROM tblName WHERE (tblAttr0=tblValue0 AND tblAttr1=tblValue1 AND ... tblAttrN=tblValueN)
    //
    //				'INSERT' for INSERT
    //				returning INSERT INTO tblName (tblAttr0, tblAttr1, tblAttrN) VALUES (tblValue0, tblValue0, tblValueN);
    //
    //				ARRAY (whAttr, whValue)
    //				returning UPDATE tblName SET tblAttr0=tblValue0, tblAttr1=tblValue=1, ... tblAttrN=tblValueN WHERE whAttr0=whValue0 AND ...
    //
    // EOF

    /////////////////////////
    // EDIT HERE///
    /////////////////////////
    var $designpath = "accounts"; //Folder D:\www\aerapanel\application\views\designs\accounts
    var $designfile = "login"; //Filename D:\www\aerapanel\application\views\designs\accounts\login.htm
    var $designtype = "htm"; //Filetype for login.htm

    var $categoryList = array(
        0 => "Pending",
        1 => "Purchased & Pending",
        2 => "Purchased & Delivered",
        3 => "Failed"
    );
    var $gmlinks = '
        <li><h3></h3></li>
        <li><strong>PWI GM Session</strong></li>
        <li><a href="/?/Accounts/Broadcast">Broadcast Msg</a></li>
        <li><a href="/?/Accounts/FastMail">FastMail</a></li>
        <li><h3></h3></li>
        <li><strong>RYL GM Session</strong></li>
        <li>Coming soon.</li>';

    /////////////////////////
    // EOF ///
    /////////////////////////

    var $ListDB = array();
    var $inputs = array('MSG' => NULL); //This variable must be declared as ARRAY()
    var $uid = 0;
    var $primarykey = "uid";
    var $AeraDB = array();
    var $user = array();

    public function viewpage($includes = TRUE)
    {
        $this->load->helper('url');

        $this->inputs["RAND"] = time();

        //Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
        $this->aera->page($this->designpath, $this->designfile, $this->designtype);
        $this->aeravars->linkhovers['MENU4'] = "current";
        $this->aera->addviews('HEADERBAR', "headerbar", $this->aeravars->linkhovers);
        $this->aera->pushlinks($this->aeravars->links);
        $this->aera->push($this->aeravars->sys);
        $this->aera->push($this->inputs);

        if ($this->session->userdata('username'))
        {
            $this->aera->push('name', $this->session->userdata('username'));
            $this->aera->push('uid', $this->session->userdata('uid'));
        }
        if ($includes)
            $this->data['header'] = $this->aera->loadheader();
        $this->data['content'] = $this->aera->loadpage();
        if ($includes)
            $this->data['footer'] = $this->aera->loadfooter();
        $this->load->vars($this->data);

        //LOAD PAGE
        if ($includes)
            $this->load->view('header');
        $this->load->view('page');
        if ($includes)
            $this->load->view('footer');

    }

    public function set($path = NULL, $file = NULL, $type = NULL)
    {
        //LOAD DB

        //$AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
        //$AeraDB['www'] = $this->load->database("www", TRUE);

        //BEGIN
        if ($path == NULL)
        {
            $path = $this->designpath;
            $file = $this->designfile;
            $type = $this->designtype;
        }
        $this->designpath = $path;
        $this->designfile = $file;
        $this->designtype = $type;
        $this->aera->page($this->designpath, $this->designfile, $this->designtype);
        if ($this->session->userdata('username'))
        {
            $this->load->database("default");
            $this->uid  = $this->session->userdata($this->primarykey);
            $query      = $this->db->query("select u.*, b.*,i.* from ae_accounts u, ae_balances b, ae_ipcountry i where i.ipfrom<=" . abs(ip2long($_SERVER['REMOTE_ADDR'])) . " AND i.ipto>=" . abs(ip2long($_SERVER['REMOTE_ADDR'])) . " AND b.uid=u.aid AND u.aid=" . $this->uid . " LIMIT 0,1");
            $this->user = $query->row_array();
            $this->db->Close();
            $this->inputs['BALANCE'] = $this->user['pbalance'];
        }
        else
            $this->uid = 0;

        //ListDB
        $this->ListDB = $this->categoryList;

        //LINKS
        $this->inputs['GMLINKS'] = NULL;
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['GMLINKS'] = $this->gmlinks;
        }
    }

    /////////////////////////////////////////////////////////////
    ////////////////// END OF MAIN FUNCTIONS ////////////////////
    /////////////////////////////////////////////////////////////


    public function index()
    {
        if ($this->session->userdata('username'))
        {
            $this->Panel();
        }
        else
        {
            $this->Login();
        }
    }

    public function Template()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title']			= "Fast Mail System";
        $this->inputs['announcement']	= "Here, you can claim anything that has rewarded";
        $_db = $this->load->database("pwi", TRUE);
        if ($this->user['accstat'] >= 50)
        {
            $_query = $_db->query("SELECT BLABLA");
            if ((int)$this->uri->segment(3, 0) >= 10000)
            {
            }
            $tables = array(
                    'name' => "Name",
                    'status' => array(
                        'name' => "Status",
                        'type' => array(
                            '0' => "-",
                            '1' => "Delivered"
                        )
                    ),
                    'icount' => "Total #",
                );
            $params = array(
                'limit'		=> 30,
                'showid'	=> TRUE
            );
            $this->aera->addviews("content", "fastmail", $this->inputs);
            $this->aera->addtables("content", $tables, $_query->result_array(), $params);
        }
        else
            $this->aera->push('content', 'You dont have priviledge here');
        $_db->Close();
        $this->viewpage();
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }

    public function Test()
    {
        die("MarHazKStyle Coding v4.1");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */