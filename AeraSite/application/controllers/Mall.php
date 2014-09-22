<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mall extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

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
    //				(Default:	NULL for SELECT sql functions
    //				returning SELECT * FROM tblName WHERE (tblAttr0=tblValue0 AND tblAttr1=tblValue1 AND ... tblAttrN=tblValueN)
    //
    //				'INSERT' for INSERT sql functions
    //				returning INSERT INTO tblName (tblAttr0, tblAttr1, tblAttrN) VALUES (tblValue0, tblValue0, tblValueN);
    //
    //				ARRAY (whAttr, whValue) for UPDATE sql functions
    //				returning UPDATE tblName SET tblAttr0=tblValue0, tblAttr1=tblValue=1, ... tblAttrN=tblValueN WHERE whAttr0=whValue0 AND ...
    //
    // EOF


    var $designpath = "malls";
    var $designfile = "panel";
    var $designtype = "htm";
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
        $this->aeravars->linkhovers['MENU2'] = "current";
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

        //CLOSE THE DATABASES

        if (isset($AeraDB['www']))
            $AeraDB['www']->Close();
        if (isset($AeraDB['pwi']))
            $AeraDB['pwi']->Close();
        if (isset($AeraDB['ryl']))
            $AeraDB['ryl']->Close();
        if (isset($this->db))
            $this->db->Close();
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
            $this->load->database("www");
            $this->uid  = $this->session->userdata($this->primarykey);
            $query      = $this->db->query("select u.*, b.*,i.* from ae_accounts u, ae_balances b,ae_ipcountry i where i.ipfrom<=" . abs(ip2long($_SERVER[REMOTE_ADDR])) . " AND i.ipto>=" . abs(ip2long($_SERVER[REMOTE_ADDR])) . " AND b.uid=u.aid AND u.aid=" . $this->uid . " LIMIT 0,1");
            $this->user = $query->row_array();
            $this->db->Close();
            $this->inputs['BALANCE'] = $this->user['pbalance'];
        }
        else
            $this->uid = 0;

        //ListDB
        $this->ListDB  = array(
            0 => "Pending",
            1 => "Purchased & Pending",
            2 => "Purchased & Delivered",
            3 => "Failed"
        );
        $this->ListDB2 = array(
            0 => "Pending",
            1 => "Purchased & Pending",
            2 => "Transfered",
            3 => "Failed"
        );
        //LINKS
        $this->inputs['GMLINKS'] = NULL;
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['GMLINKS'] = '<li><strong></strong></li>';
            $this->inputs['GMLINKS'] = '<li><strong>GM Session</strong></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Mall/Add">Add Item</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Mall/ListStocks">List Items</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Mall/ListPurchases">List Purchases</a></li>';
        }
    }

    /////////////////////////////////////////////////////////////
    ////////////////// END OF MAIN FUNCTIONS ////////////////////
    /////////////////////////////////////////////////////////////

    public function index()
    {
        $this->set();
        $this->load->database("pwi");
        if (!isset($this->inputs['title']))
            $this->inputs['title'] = "Latest Shopping Malls";
        if ($this->session->userdata('username'))
        {

            $this->aera->push(array('CONTENT' => '<table width=400px><tr><td width=30%><h2>PWI</h2></td><td width=70% style="alignment-adjust:baseline; vertical-align:bottom; text-align:left"><p>[<a href="/?/Mall/Category/1">click here to view more</a>]</p></td></tr></table>'));
            $query = $this->db->query("select * from ae_stocks WHERE ogame=1 ORDER BY oid DESC LIMIT 0,3");
            if ($query->num_rows() >= 1)
            {
                $num = 0;
                foreach ($query->result_array() as $prow)
                {
                    if ($prow[ogame] == 1)
                    {
                        $prow[game] = "PWI ./. " . $prow[oprice] . " AP";
                        if (isset($prow[oimg]))
                            $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                        else
                            $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                        $prow[link]  = "/?/Mall/View/" . $prow[oid];
                        $prow[title] = $prow[oname];
                    }
                    $num++;
                    if ($num == 3)
                    {
                        $this->aera->addviews("CONTENT", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("CONTENT", "list", $prow);
                }
            }
            $this->aera->push(array('CONTENT' => '<table width=400px><tr><td width=30%><h2>RYL2</h2></td><td width=70% style="alignment-adjust:baseline; vertical-align:bottom; text-align:left"><p>[<a href="/?/Mall/Category/2">click here to view more</a>]</p></td></tr></table>'));
            $query = $this->db->query("select * from ae_stocks WHERE ogame=2 ORDER BY oid DESC LIMIT 0,3");
            if ($query->num_rows() >= 1)
            {
                $num = 0;
                foreach ($query->result_array() as $prow)
                {
                    if ($prow[ogame] == 2)
                    {
                        $prow[game] = "RYL2 ./. " . $prow[oprice] . " AP";
                        if (isset($prow[oimg]))
                            $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                        else
                            $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                        $prow[link]  = "/?/Mall/View/" . $prow[oid];
                        $prow[title] = $prow[oname];
                    }
                    $num++;
                    if ($num == 3)
                    {
                        $this->aera->addviews("CONTENT", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("CONTENT", "list", $prow);
                }
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->helper('url');
            redirect('/Accounts', 'refresh');
        }
        $this->db->Close();
        $this->viewpage();
    }

    public function Category()
    {
        $this->set();
        $this->load->database("pwi");
        if (!isset($this->inputs['title']))
            $this->inputs['title'] = "Shopping Malls by Categories";
        if (true)
        {
            $catid = "";
            if ($this->uri->segment(3, 0))
                $catid = " WHERE ogame=" . (int)$this->uri->segment(3);
            $query = $this->db->query("select * from ae_stocks " . $catid . " ORDER BY oid DESC LIMIT 0,10");
            if ($query->num_rows() >= 1)
            {
                $num = 0;
                foreach ($query->result_array() as $prow)
                {
                    if ($prow[ogame] == 1)
                        $prow[game] = "PWI ./. " . $prow[oprice] . " AP";
                    if ($prow[ogame] == 2)
                        $prow[game] = "RYL2 ./. " . $prow[oprice] . " AP";
                    if (isset($prow[oimg]))
                        $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                    else
                        $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                    $prow[link]  = "/?/Mall/View/" . $prow[oid];
                    $prow[title] = $prow[oname];
                    $num++;
                    if ($num == 3)
                    {
                        $this->aera->addviews("content", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("content", "list", $prow);
                }
            }
        }
        $this->db->Close();
        $this->viewpage();
    }

    public function Latest()
    {
        $this->index();
    }

    public function Promotion()
    {
        $this->inputs['title'] = "Promo Shopping Malls";
        $this->index();
    }

    public function Search()
    {
        $this->set();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->inputs['TITLE'] = "Search Item";
        if ((int)$this->uri->segment(3) >= 1000)
        {
            $word   = $this->input->post('search');
            $sql    = "SELECT * FROM ae_stocks WHERE oname LIKE '%$word%' OR oid LIKE '%$word%' OR oiid LIKE '%$word%' ORDER BY oid DESC LIMIT 0,20";
            $result = $this->db->query($sql);
            if ($result)
            {
                $found = 0;
                $num   = 0;
                foreach ($result->result_array() as $prow)
                {
                    $found++;
                    if ($prow[ogame] == 1)
                        $prow[game] = "PWI ./. " . $prow[oprice] . " AP";
                    if ($prow[ogame] == 2)
                        $prow[game] = "RYL2 ./. " . $prow[oprice] . " AP";
                    if (isset($prow[oimg]))
                        $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                    else
                        $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                    $prow[link]  = "/?/Mall/View/" . $prow[oid];
                    $prow[title] = $prow[oname];
                    $num++;
                    if ($num == 3)
                    {
                        $this->aera->addviews("content", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("content", "list", $prow);
                }
                if ($found == 0)
                {
                    $this->inputs['MSG'] = "No result found, try again later.";
                    $this->aera->addviews('content', 'search', $this->inputs);
                }
            }
            else
            {
                $this->inputs['MSG'] = "No result found, try again later.";
                $this->aera->addviews('content', 'search', $this->inputs);
            }
        }
        else
            $this->aera->addviews('content', 'search', array());
        $this->viewpage();
    }

    public function Add()
    {
        $this->set();
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['title'] = "Add Stock";
            if ((int)$this->uri->segment(3) >= 1000)
            {
                //Form Variables
                $msg                       = "";
                $oid                       = $this->input->post("oid");
                $oname                     = $this->input->post("oname");
                $ogame                     = $this->input->post("ogame");
                $oprice                    = $this->input->post("oprice");
                $ostock                    = $this->input->post("ostock");
                $olimit                    = $this->input->post("olimit");
                $ohot                      = $this->input->post("ohot");
                $odesc                     = $this->input->post("odesc");
                $opwsender                 = $this->input->post("opwsender");
                $opwmsg                    = $this->input->post("opwmsg");
                $opwcount                  = $this->input->post("opwcount");
                $opwdata                   = $this->input->post("opwdata");
                $oimg                      = $_FILES['oimg']['name'];
                $osubmit                   = $this->input->post("osubmit");
                $this->inputs['vid']       = $oid;
                $this->inputs['vname']     = $oname;
                $this->inputs['vprice']    = $oprice;
                $this->inputs['vstock']    = $ostock;
                $this->inputs['vlimit']    = $olimit;
                $this->inputs['vhot']      = $ohot;
                $this->inputs['vimg']      = $oimg;
                $this->inputs['vdesc']     = $odesc;
                $this->inputs['vpwsender'] = $opwsender;
                $this->inputs['vpwmsg']    = $opwmsg;
                $this->inputs['vpwcount']  = $opwcount;
                $this->inputs['vpwdata']   = $opwdata;
                $this->inputs['vsubmit']   = $osubmit;
                if ($ogame == 1)
                    $this->inputs['vgame'] = '<option selected=selected value="1">PWI</option>';
                else if ($ogame == 2)
                    $this->inputs['vgame'] = '<option selected=selected value="2">RYL</option>';
                else
                    $this->inputs['vgame'] = '';

                //Validation
                if ((empty($oid) || empty($oname) || empty($ogame) || empty($ostock) || empty($ohot) || empty($odesc)) && ($ogame >= 2))
                {
                    $this->inputs['MSG'] = "Please fill in the blanks atleast most..";
                    $this->aera->addviews('content', 'add', $this->inputs);
                }
                elseif ((empty($oid) || empty($oname) || empty($ogame) || empty($ostock) || empty($ohot) || empty($odesc) || empty($opwsender) || empty($opwmsg) || empty($opwcount)) && ($ogame == 1))
                {
                    $this->inputs['MSG'] = "Please fill in the blanks atleast most (PW)..";
                    $this->aera->addviews('content', 'add', $this->inputs);
                }
                else
                {
                    $AeraDB['www'] = $this->load->database("www", TRUE);
                    if (isset($_FILES['oimg']))
                    {
                        $this->load->library('upload', $_FILES['oimg']);
                        $this->upload->file_new_name_body = $this->session->userdata('username') . "_UPLOAD_" . time();
                        $this->upload->Process("./upload/");
                        $uploaded = FALSE;
                        if ($this->upload->processed)
                        {
                            if ($this->upload->file_is_image)
                            {
                                $oimg = $this->upload->file_dst_name;
                                $uploaded = TRUE;
                            }
                            else if ($uploaded == FALSE)
                            {

                                //if (!$this->upload->do_upload())
                                //{
                                $chkerr   = TRUE;
                                $errormsg = $this->upload->error . " TOTAL FILE: " . count($_FILES) . " Details: " . $_FILES['oimg']['name'];
                            }
                        }
                        else if ($uploaded == FALSE)
                        {
                            //PWI: upload/admin_UPLOAD_1381403149.png
                            //RESERVED: upload/admin_UPLOAD_1381215601.png
                            if ($ogame == 1)
                                $oimg = "admin_UPLOAD_1381403149.png";
                            else
                                $oimg = "admin_UPLOAD_1381215601.png";
                            //$chkerr = TRUE;
                            //$errormsg = $this->upload->error." TOTAL FILE: ".count($_FILES)." Details: ".$_FILES['oimg']['name'];
                        }
                        $this->upload->Clean();
                    }
                    $tblVal = array(
                        'oid'    => time(),
                        'oiid'   => $oid,
                        'oname'  => $oname,
                        'ogame'  => $ogame,
                        'oprice' => $oprice,
                        'ostock' => $ostock,
                        'olimit' => $olimit,
                        'ohot'   => $ohot,
                        'oimg'   => $oimg,
                        'odesc'  => $odesc
                    );
                    if ($ogame == 1)
                    {
                        $tblVal['opwsender'] = $opwsender;
                        $tblVal['opwmsg']    = $opwmsg;
                        $tblVal['opwcount']  = $opwcount;
                        $tblVal['opwdata']   = $opwdata;
                    }
                    $sql = $this->aera->sql('ae_stocks', $tblVal, 'INSERT');
                    if ($chkerr)
                    {
                        $this->inputs['MSG'] = "Failed to add " . $oname . " into ae_stocks. Image is failed to upload.<BR>Reason : " . $errormsg;
                        $this->aera->addviews('content', 'add', $this->inputs);
                    }
                    else
                    {
                        $resultstock = $AeraDB['www']->query($sql);
                        if ($resultstock)
                            $this->inputs['content'] = $oname . " has been added into stock list.";
                        else
                        {
                            $this->inputs['MSG'] = "Failed to add " . $oname . " into ae_stocks.";
                            $this->aera->addviews('content', 'add', $this->inputs);
                        }
                    }
                }
            }
            else
            {
                $this->inputs['vid']       = "";
                $this->inputs['vname']     = "";
                $this->inputs['vgame']     = "";
                $this->inputs['vprice']    = "50000";
                $this->inputs['vstock']    = "2";
                $this->inputs['vlimit']    = "1";
                $this->inputs['vhot']      = "1";
                $this->inputs['vdesc']     = "";
                $this->inputs['vpwsender'] = "Aera Gaming International";
                $this->inputs['vpwmsg']    = "Item has been transferred from Aera Gaming Mall";
                $this->inputs['vpwcount']  = "1";
                $this->inputs['vpwdata']   = "";
                $this->inputs['vsubmit']   = "Add";
                $this->aera->addviews('content', 'add', $this->inputs);
            }
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $this->viewpage();
    }

    public function EditStock()
    {
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['title'] = "Edit Stock";
            if ((int)$this->uri->segment(3) >= 1)
            {
                if ($this->uri->segment(4) == "Save")
                {
                    $queryf = TRUE;
                }
                else
                {
                    $tblFind = array(
                        'oid' => (int)$this->uri->segment(3)
                    );
                    $sqlf    = $this->aera->sql('ae_stocks', $tblFind);
                    $queryf  = $this->db->query($sqlf . " LIMIT 0, 1");
                    $rowf    = $queryf->row_array();
                }
                if ($queryf)
                {
                    //Form Variables
                    $msg = "";

                    if ($this->uri->segment(4) == "Save")
                    {
                        $oid       = $this->input->post("oid");
                        $oiid      = $this->input->post("oiid");
                        $oname     = $this->input->post("oname");
                        $ogame     = $this->input->post("ogame");
                        $oprice    = $this->input->post("oprice");
                        $ostock    = $this->input->post("ostock");
                        $ohot      = $this->input->post("ohot");
                        $olimit    = $this->input->post("olimit");
                        $odesc     = $this->input->post("odesc");
                        $opwsender = $this->input->post("opwsender");
                        $opwmsg    = $this->input->post("opwmsg");
                        $opwcount  = $this->input->post("opwcount");
                        $opwdata   = $this->input->post("opwdata");
                        $oimg      = $_FILES['oimg']['name'];
                        $osubmit   = $this->input->post("osubmit");
                    }
                    else
                    {
                        $oid       = $rowf['oid'];
                        $oiid      = $rowf['oiid'];
                        $oname     = $rowf['oname'];
                        $ogame     = $rowf['ogame'];
                        $oprice    = $rowf['oprice'];
                        $ostock    = $rowf['ostock'];
                        $ohot      = $rowf['ohot'];
                        $olimit    = $rowf['olimit'];
                        $odesc     = $rowf['odesc'];
                        $opwsender = $rowf['opwsender'];
                        $opwmsg    = $rowf['opwmsg'];
                        $opwcount  = $rowf['opwcount'];
                        $opwdata   = $rowf['opwdata'];
                        $oimg      = NULL;
                        $osubmit   = 'Save';
                    }
                    $this->inputs['vid']       = $oid;
                    $this->inputs['viid']      = $oiid;
                    $this->inputs['vname']     = $oname;
                    $this->inputs['vprice']    = $oprice;
                    $this->inputs['vstock']    = $ostock;
                    $this->inputs['vhot']      = $ohot;
                    $this->inputs['vlimit']    = $olimit;
                    $this->inputs['vimg']      = $oimg;
                    $this->inputs['vdesc']     = $odesc;
                    $this->inputs['vpwsender'] = $opwsender;
                    $this->inputs['vpwmsg']    = $opwmsg;
                    $this->inputs['vpwcount']  = $opwcount;
                    $this->inputs['vpwdata']   = $opwdata;
                    $this->inputs['vsubmit']   = $osubmit;
                    if ($ogame == 1)
                        $this->inputs['vgame'] = '<option selected=selected value="1">PWI</option>';
                    else if ($ogame == 2)
                        $this->inputs['vgame'] = '<option selected=selected value="2">RYL</option>';
                    else
                        $this->inputs['vgame'] = '';

                    if ($this->uri->segment(4) == "Save")
                    {
                        //Validation
                        if (empty($oid) || empty($oname) || empty($ogame) || empty($ostock) || empty($ohot) || empty($odesc))
                        {
                            $this->inputs['MSG'] = "Please fill in the blanks atleast most..";
                            $this->aera->addviews('content', 'edit', $this->inputs);
                        }
                        else
                        {
                            $AeraDB['www'] = $this->load->database("www", TRUE);
                            $tblVal        = array(
                                'oiid'   => $oiid,
                                'oname'  => $oname,
                                'ogame'  => $ogame,
                                'oprice' => $oprice,
                                'ostock' => $ostock,
                                'olimit' => $olimit,
                                'ohot'   => $ohot,
                                'odesc'  => $odesc
                            );
                            if ($ogame == 1)
                            {
                                $tblVal['opwsender'] = $opwsender;
                                $tblVal['opwmsg']    = $opwmsg;
                                $tblVal['opwcount']  = $opwcount;
                                $tblVal['opwdata']   = $opwdata;
                            }
                            $tblWhere = array(
                                'oid' => $oid
                            );
                            if (isset($_FILES['oimg']))
                            {
                                $this->load->library('Upload', $_FILES['oimg']);
                                $this->upload->file_new_name_body = $this->session->userdata('username') . "_UPLOAD_" . time();
                                $this->upload->Process("./upload/");
                                if ($this->upload->processed)
                                {
                                    if ($this->upload->file_is_image)
                                    {
                                        $oimg           = $this->upload->file_dst_name;
                                        $tblVal['oimg'] = $oimg;
                                    }
                                    else
                                    {
                                        $chkerr   = TRUE;
                                        $errormsg = $this->upload->error . " TOTAL FILE: " . count($_FILES) . " Details: " . $_FILES['oimg']['name'];
                                    }
                                }
                                else
                                {
                                    $chkerr   = TRUE;
                                    $errormsg = $this->upload->error . " TOTAL FILE: " . count($_FILES) . " Details: " . $_FILES['oimg']['name'];
                                }
                                $this->upload->Clean();
                            }

                            $sql = $this->aera->sql('ae_stocks', $tblVal, $tblWhere);
                            if ($chkerr)
                            {
                                $this->inputs['MSG'] = "Failed to edit " . $oname . " into ae_stocks. Image is failed to upload.<BR>Reason : " . $errormsg;
                                $this->aera->addviews('content', 'edit', $this->inputs);
                            }
                            else
                            {
                                $resultstock = $AeraDB['www']->query($sql);
                                if ($resultstock)
                                    $this->inputs['content'] = $oname . " has been editted into stock list.";
                                else
                                {
                                    $this->inputs['MSG'] = "Failed to edit " . $oname . " into ae_stocks.";
                                    $this->aera->addviews('content', 'edit', $this->inputs);
                                }
                                $AeraDB['www']->Close();
                            }
                        }
                    }
                    else
                    {
                        $this->aera->addviews('content', 'edit', $this->inputs);
                    }
                }
                else
                {
                    //NOT FOUND
                }
            }
            else
            {
                $this->inputs['vid']     = "";
                $this->inputs['vname']   = "";
                $this->inputs['vgame']   = "";
                $this->inputs['vprice']  = "50000";
                $this->inputs['vstock']  = "2";
                $this->inputs['vhot']    = "1";
                $this->inputs['vlimit']  = "1";
                $this->inputs['vdesc']   = "";
                $this->inputs['vsubmit'] = "Add";
                $this->aera->addviews('content', 'edit', $this->inputs);
            }
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $this->viewpage();
    }

    public function EditPurchase()
    {
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['title'] = "Edit Purchase";
            if ((int)$this->uri->segment(3) >= 1000)
            {
                if ($this->uri->segment(4) == "Save")
                {
                    $queryf = TRUE;
                }
                else
                {
                    $tblFind = array(
                        'pid' => (int)$this->uri->segment(3)
                    );
                    $sqlf    = $this->aera->sql('ae_purchaselist', $tblFind);
                    $queryf  = $this->db->query($sqlf . " LIMIT 0, 1");
                    $rowf    = $queryf->row_array();
                }
                if ($queryf)
                {
                    //Form Variables
                    $msg = "";

                    if ($this->uri->segment(4) == "Save")
                    {
                        $pid     = $this->input->post("pid");
                        $puid    = $this->input->post("puid");
                        $psid    = $this->input->post("psid");
                        $pstatus = $this->input->post("pstatus");
                        $ptotal  = $this->input->post("ptotal");
                        $psubmit = $this->input->post("psubmit");
                    }
                    else
                    {
                        $pid     = $rowf['pid'];
                        $puid    = $rowf['puid'];
                        $psid    = $rowf['oid'];
                        $pstatus = $rowf['status'];
                        $ptotal  = $rowf['total'];
                        $psubmit = 'Save';
                    }
                    $this->inputs['vid']     = $pid;
                    $this->inputs['vtotal']  = $ptotal;
                    $this->inputs['vsubmit'] = $psubmit;
                    $this->inputs['vuid']    = '';
                    $this->inputs['vsid']    = '';
                    $this->inputs['vstatus'] = '';
                    $queryu                  = $this->db->query("SELECT * FROM ae_accounts ORDER BY aname ASC");
                    $querys                  = $this->db->query("SELECT * FROM ae_stocks ORDER BY oname ASC");

                    $this->inputs['vuid'] = '<option value="0">-</option>';
                    $this->inputs['vsid'] = '<option value="0">-</option>';
                    foreach ($queryu->result_array() as $rowu)
                    {
                        if (($puid >= 1) && ($puid == $rowu['ID']))
                            $this->inputs['vuid'] .= '<option selected=selected value="' . $rowu['ID'] . '">' . $rowu['name'] . '</option>';
                        else
                            $this->inputs['vuid'] .= '<option value="' . $rowu['ID'] . '">' . $rowu['name'] . '</option>';
                    }
                    foreach ($querys->result_array() as $rows)
                    {
                        if (($psid >= 1) && ($psid == $rows['oid']))
                            $this->inputs['vsid'] .= '<option selected=selected value="' . $rows['oid'] . '">' . $rows['oname'] . '</option>';
                        else
                            $this->inputs['vsid'] .= '<option value="' . $rows['oid'] . '">' . $rows['oname'] . '</option>';
                    }

                    if ($pstatus == 1)
                        $this->inputs['vstatus'] = '<option selected=selected value="1">Purchased & Pending</option>';
                    else if ($pstatus == 2)
                        $this->inputs['vstatus'] = '<option selected=selected value="2">Purchased & Delivered</option>';
                    else if ($pstatus == 3)
                        $this->inputs['vstatus'] = '<option selected=selected value="3">Failed</option>';
                    else
                        $this->inputs['vstatus'] = '';

                    if ($this->uri->segment(4) == "Save")
                    {
                        //Validation
                        if (empty($pid) || empty($puid) || empty($psid) || empty($pstatus) || empty($ptotal))
                        {
                            $this->inputs['MSG'] = "Please fill in the blanks atleast most..";
                            $this->aera->addviews('content', 'edit2', $this->inputs);
                        }
                        else
                        {
                            $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
                            $tblVal        = array(
                                'status' => $pstatus,
                                'total'  => $ptotal,
                                'puid'   => $puid,
                                'oid'    => $psid
                            );
                            $tblWhere      = array(
                                'pid' => $pid
                            );

                            $sql            = $this->aera->sql('ae_purchaselist', $tblVal, $tblWhere);
                            $resultpurchase = $AeraDB['pwi']->query($sql);
                            if ($resultpurchase)
                                $this->inputs['content'] = "Purchase has been editted into purchase list.";
                            else
                            {
                                $this->inputs['MSG'] = "Failed to edit " . $pid . " into purchases.";
                                $this->aera->addviews('content', 'edit2', $this->inputs);
                            }
                        }
                    }
                    else
                    {
                        $this->aera->addviews('content', 'edit2', $this->inputs);
                    }
                }
                else
                {
                    //NOT FOUND
                }
            }
            else
            {
                $this->inputs['vid']     = "";
                $this->inputs['vname']   = "";
                $this->inputs['vgame']   = "";
                $this->inputs['vprice']  = "50000";
                $this->inputs['vstock']  = "2";
                $this->inputs['vhot']    = "1";
                $this->inputs['vdesc']   = "";
                $this->inputs['vsubmit'] = "Add";
                $this->aera->addviews('content', 'edit2', $this->inputs);
            }
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $this->viewpage();
    }

    public function ListStocks()
    {
        $this->set();

        $AeraDB['www']       = $this->load->database("www", TRUE);
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['title'] = "List of Stock";

            $tables    = array(
                'oid'       => array(
                    'name' => 'Stock ID',
                    'type' => "NULL"
                ),
                'oiid'      => array(
                    'name' => 'Item ID',
                    'type' => "NULL"
                ),
                'oname'     => array(
                    'name' => 'Name',
                    'type' => "NULL"
                ),
                'ogame'     => array(
                    'name' => 'Game Type',
                    'list' => array(
                        0 => 'N/A',
                        1 => 'PW',
                        2 => 'RYL2'
                    )
                ),
                'oprice'    => array(
                    'name' => 'AP Price',
                    'type' => "NULL"
                ),
                'ostock'    => array(
                    'name' => 'ae_stocks',
                    'type' => "NULL"
                ),
                'reserved1' => array(
                    'name' => '',
                    'type' => "NULL",
                    'html' => '<input type="checkbox" name="iddel[]" value="{RESERVED1}" />'
                ),
                'reserved2' => array(
                    'name' => '',
                    'type' => "NULL",
                    'html' => '<a href="/?/Mall/EditStock/{RESERVED2}">EDIT</a>'
                )
            );
            $ae_stocks = $AeraDB['www']->query("select *, oid as reserved1, oid as reserved2 from ae_stocks order by oid desc limit 0,100");


            $this->aera->push('content', '<form action="/?/Mall/UpdateAll/ae_stocks" method=post>{CONTENT}');
            $this->aera->addtables('content', $tables, $ae_stocks->result_array());
            $this->aera->push('content', '<button name="option" value="delete" type=submit>Delete</button><button name="option" value="out" type=submit>Mark as Out of ae_stocks</button><button type=button onclick="checkAll();">Check All</button><button type=reset>Uncheck All</button></form>');
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $AeraDB['www']->Close();
        $this->viewpage();
    }

    public function UpdateAll()
    {
        $this->set();
        $AeraDB['www']       = $this->load->database("www", TRUE);
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            if ($this->uri->segment(3) == "ae_stocks")
            {
                $ikey = "oid";
                $itbl = "ae_stocks";
            }
            else if ($this->uri->segment(3) == "Purchases")
            {
                $ikey = "pid";
                $itbl = "ae_purchaselist";
            }
            else
            {
                //Not found
                die("NOT_FOUND");
            }

            $items       = $this->input->post('iddel');
            $num         = 0;
            $ae_itemlist = "";
            if ($this->input->post('option') == "delete")
                $sql = "DELETE FROM $itbl WHERE ";
            else if ($this->input->post('option') == "out")
                $sql = "UPDATE $itbl SET ostock=0 WHERE ";
            else if ($this->input->post('option') == "pending")
                $sql = "UPDATE $itbl SET status=1 WHERE ";
            else if ($this->input->post('option') == "delivered")
                $sql = "UPDATE $itbl SET status=2 WHERE ";
            else if ($this->input->post('option') == "failed")
                $sql = "UPDATE $itbl SET status=3 WHERE ";
            else
                $sql = "DELETE FROM $itbl WHERE ";
            foreach ($items as $row)
            {
                if ($num >= 1)
                {
                    $sql .= " OR ";
                    $ae_itemlist .= ", ";
                }
                $sql .= $ikey . "='" . $row . "'";
                $ae_itemlist .= $row;
                $num++;
            }
            $resultupdateall = $AeraDB['www']->query($sql);
            $method          = explode(' ', $sql);
            $methodnames     = array();
            if ($method[0] == "DELETE")
            {
                $this->inputs['title'] = "Deletion Result";
                $methodnames[0]        = "removed";
                $methodnames[1]        = "remove";
            }
            else
            {
                $this->inputs['title'] = "Updating Result";
                $methodnames[0]        = "updated";
                $methodnames[1]        = "update";
            }
            if ($resultupdateall)
                $this->inputs['content'] = "You have successfully " . $methodnames[0] . " $ae_itemlist from database";
            else
                $this->inputs['content'] = "You have failed to " . $methodnames[1] . " $ae_itemlist from database";
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $AeraDB['www']->Close();
        $this->viewpage();
    }

    public function ListPurchases()
    {
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->user['accstat'] >= 50)
        {
            $AeraDB['www']         = $this->load->database("www", TRUE);
            $tables                = array(
                'status'    => array(
                    'name' => "Status",
                    'type' => $this->ListDB
                ),
                'pdate'     => array(
                    'name' => "Last Purchase Made",
                    'type' => "TIME"
                ),
                'oname'     => array(
                    'name' => "Item Name",
                    'type' => NULL
                ),
                'uname'     => "Purchaser",
                'reserved1' => array(
                    'name' => '',
                    'type' => "NULL",
                    'html' => '<input type="checkbox" name="iddel[]" value="{RESERVED1}" />'
                ),
                'reserved2' => array(
                    'name' => '',
                    'type' => "NULL",
                    'html' => '<a href="/?/Mall/EditPurchase/{RESERVED2}">EDIT</a>'
                )
            );
            $purchases             = $AeraDB['www']->query("select *, u.aname as uname, p.pid as reserved1, p.pid as reserved2 from ae_purchaselist p, ae_stocks s, ae_accounts u where s.oid=p.oid AND u.aid=p.puid ORDER BY p.pdate DESC");
            $this->inputs['title'] = "List of Purchases";

            $this->aera->push('content', '<form action="/?/Mall/UpdateAll/Purchases" method=post>{CONTENT}');
            $this->aera->addtables('content', $tables, $purchases->result_array());
            $this->aera->push('content', '<button name="option" value="delete" type=submit>Delete</button><button name="option" value="delivered" type=submit>Mark as Delivered</button><button name="option" value="pending" type=submit>Mark as Pending</button><button name="option" value="failed" type=submit>Mark as Failed</button><button type=button onclick="checkAll();">Check All</button><button type=reset>Uncheck All</button></form>');
            $AeraDB['www']->Close();
        }
        else
        {
            $this->inputs['title']   = "Privilledge Errors";
            $this->inputs['content'] = "You cannot enter this session";
        }
        $this->viewpage();
    }

    public function Order()
    {
        $this->set();

        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ((int)$this->uri->segment(3, 0) >= 1)
        {
            $AeraDB['www'] = $this->load->database("www", TRUE);
            $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
            //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
            //$uname      = $this->input->post("login");

            $query = $AeraDB['www']->query("SELECT * FROM ae_stocks WHERE oid=" . (int)$this->uri->segment(3, 0));
            if ($query->num_rows() >= 1)
            {
                $prow          = $query->row_array();
                $prow[oototal] = (int)$this->input->post('total');
                $newstock      = ((int)$prow[ostock] - (int)$prow[oototal]);
                $cost          = ((int)$prow[oprice] * (int)$prow[oototal]);
                $bal           = ((int)$this->user[pbalance] - $cost);
                if (((int)$prow[ostock] >= 0) && ((int)$prow[oototal] >= 0) && ((int)$prow[ostock] >= (int)$prow[oototal]) && ($bal >= 0))
                {
                    $this->inputs["TITLE"] = $prow[oname];
                    $prow[title]           = $prow[oname];
                    if (isset($prow[oimg]))
                        $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                    else
                        $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                    $prow[link] = "/?/Mall/View/" . $prow[oid];
                    $prow[game] = "Game : PWI<BR>";
                    $prow[game] .= "Price : " . $prow[oprice] . " AP. It will cost you " . $cost . " AP for this order (You new balance will be " . $bal . " AP)<BR>";
                    $prow[game] .= "Stock : " . $prow[ostock] . " left. You are ordering " . $prow[oototal] . " item(s).<BR>";
                    $prow['form'] = "";

                    $chkduplicate = $AeraDB['www']->query("SELECT SUM(total) as overall FROM ae_purchaselist WHERE oid='" . $prow[oid] . "' AND puid='" . $this->uid . "' LIMIT 0,1");
                    if ($chkduplicate)
                    {
                        $iprow  = $chkduplicate->row_array();
                        $itotal = $iprow['overall'];
                    }
                    else
                    {
                        $itotal = 99999999999;
                    }
                    if ($prow[oototal] > $prow[olimit])
                    {
                        $this->inputs['MSG'] = "You failed to purchase " . $prow[oototal] . " " . $prow[oname] . ". You cannot make this order more than " . $prow[olimit] . ".<BR><BR>";
                        $this->View();
                    }
                    else if ($this->user['astatus'] == 0)
                    {
                        $this->inputs['MSG'] = 'You failed to purchase ' . $prow[oototal] . ' ' . $prow[oname] . '. You have not validate your acccount yet. Please check your verified email to validate. <a href="/?/Accounts/ResendValidate">Click here</a> to resend the validation code into your email.".<BR><BR>';
                        $this->View();
                    }
                    else if ($itotal >= $prow[olimit])
                    {
                        $this->inputs['MSG'] = "You failed to purchase " . $prow[oototal] . " " . $prow[oname] . " because you already purchased this item more than " . $prow[olimit] . " before.<BR><BR>";
                        $this->View();
                    }
                    else
                    {
                        if ($prow[ogame] == 1)
                        {
                            $qrole   = "SELECT r.roleid, r.name FROM roles r, users u WHERE r.userid=u.ID AND u.name='" . $this->user['aname'] . "'";
                            $qresult = $AeraDB['pwi']->query($qrole);
                            $prow[form] .= 'Choose Character Name:<BR>';
                            if ($qresult)
                            {
                                if ($qresult->num_rows() >= 1)
                                {
                                    $prow[form] .= '<select name="roleid">';
                                    foreach ($qresult->result_array() as $role)
                                    {
                                        $prow[form] .= '<option value="' . $role['roleid'] . '">' . $role['name'] . '</option>';
                                    }
                                    $prow[form] .= '</select><BR><BR>';
                                }
                            }
                            else
                            {
                                $this->aera->addviews("content", "errorchar", array());
                            }
                            $this->aera->addviews("content", "confirm", $prow);
                        }
                        else
                            $this->aera->addviews("content", "confirm", $prow);
                    }
                }
                else if ($bal < 0)
                {
                    $this->inputs['MSG'] = "You cannot make an order if dont have enough AP balance.";
                    $this->View();
                }
                else if ((int)$prow[ostock] <= 0)
                {
                    $this->inputs['MSG'] = "This item is out of stock. Please choose another item.";
                    $this->View();
                }
                else
                {
                    $this->inputs['MSG'] = "You cannot make an order more than the stock list. You only can only order between 1-" . $prow[ostock];
                    $this->View();
                }
            }

            //CLOSE THE DATABASES
            $AeraDB['www']->Close();
            $AeraDB['pwi']->Close();
            //$AeraDB['ryl']->Close();
        }
        $this->inputs['CREATEKEY'] = time();
        $this->viewpage();
    }

    public function Confirm()
    {
        $this->set();

        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ((int)$this->uri->segment(3, 0) >= 1)
        {
            if ($this->input->post('option') == 2)
            {
                redirect('Mall/View/' . $this->uri->segment(3, 0), 'refresh');
                die();
            }
            $AeraDB['www'] = $this->load->database("www", TRUE);
            $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
            //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
            //$uname      = $this->input->post("login");

            $query = $AeraDB['www']->query("SELECT * FROM ae_stocks WHERE oid=" . (int)$this->uri->segment(3, 0));
            if ($query->num_rows() >= 1)
            {

                $prow          = $query->row_array();
                $prow[oototal] = (int)$this->input->post('total');
                $newstock      = ((int)$prow[ostock] - (int)$prow[oototal]);
                $cost          = ((int)$prow[oprice] * (int)$prow[oototal]);
                $bal           = ((int)$this->user[pbalance] - $cost);
                if (((int)$prow[ostock] >= 0) && ((int)$prow[oototal] >= 0) && ((int)$prow[ostock] >= (int)$prow[oototal]) && ($bal >= 0))
                {
                    $sql1 = "INSERT INTO ae_purchaselist (puid,oid,status,pdate,total) VALUES(" . $this->uid . "," . $prow[oid] . ",1," . time() . ", " . $prow[oototal] . ");";
                    $sql2 = "UPDATE ae_balances SET pbalance=" . $bal . ", pdate=" . time() . " WHERE uid=" . $this->uid . ";";
                    $sql3 = "UPDATE ae_stocks SET ostock=" . $newstock . " WHERE oid=" . $prow[oid] . ";";
                    //$sql4 = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('".$role[userid]."', '".$role[roleid]."', '0', '".$val."', '".$_POST[icount]."', '".$_POST[imaxcount]."', '".$_POST[sender]."', '".$_POST[msg]."', '".$_POST[iproctype]."', '".$_POST[iexpiredate]."', '".$_POST[imask]."', '".$_POST[idata]."', NOW());";

                    if ($prow['ogame'] == 1)
                    {
                        $stockq      = $AeraDB['www']->query("SELECT * FROM ae_stocks WHERE oid='" . $prow[oid] . "' LIMIT 0,1");
                        $stockdetail = $stockq->row_array();
                        $roleid      = $this->input->post('roleid');
                        $userid      = $this->uid;
                        $opwiid      = $stockdetail['oiid'];
                        $opwcount    = (int)$stockdetail['opwcount'] * (int)$prow[oototal];
                        $opwsender   = $stockdetail['opwsender'];
                        $opwmsg      = $stockdetail['opwmsg'];
                        $opwdata     = $stockdetail['opwdata'];
                        $sql1        = "INSERT INTO ae_purchaselist (puid,oid,status,pdate,total) VALUES(" . $this->uid . "," . $prow[oid] . ",2," . time() . ", " . $prow[oototal] . ");";
                        $sql4        = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, idata, isdate) VALUES ('" . $userid . "', '" . $roleid . "', '0', '" . $opwiid . "', '" . $opwcount . "', '" . $opwcount . "', '" . $opwsender . "', '" . $opwmsg . "', '" . $opwdata . "', NOW());";
                        //$sql4 = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, idata, isdate) VALUES ('6576', '1120', '0', '16161', '1', '9999', '[GM]aera', 'item send', '', NOW());";

                    }
                    //die($sql4);
                    $this->inputs['TITLE'] = "Purchase Result";

                    $chkduplicate = $AeraDB['www']->query("SELECT SUM(total) as overall FROM ae_purchaselist WHERE oid='" . $prow[oid] . "' AND puid='" . $this->uid . "' LIMIT 0,1");
                    if ($chkduplicate)
                    {
                        $iprow  = $chkduplicate->row_array();
                        $itotal = $iprow['overall'];
                    }
                    else
                    {
                        $itotal = 99999999999;
                    }
                    if ($prow[oototal] > $prow[olimit])
                    {
                        $this->inputs['CONTENT'] = "You failed to purchase " . $prow[oototal] . " " . $prow[oname] . ". You cannot make this order more than " . $prow[olimit] . ".<BR><BR>";
                    }
                    else if ($this->user['astatus'] == 0)
                    {
                        $this->inputs['CONTENT'] = 'You failed to purchase ' . $prow[oototal] . ' ' . $prow[oname] . '. You have not validate your acccount yet. Please check your verified email to validate. <a href="/?/Accounts/ResendValidate">Click here</a> to resend the validation code into your email.".<BR><BR>';
                    }
                    else if ($itotal >= $prow[olimit])
                    {
                        $this->inputs['CONTENT'] = "You failed to purchase " . $prow[oototal] . " " . $prow[oname] . " because you already purchased this item more than " . $prow[olimit] . " before.<BR><BR>";
                    }
                    else
                    {
                        $result1 = $AeraDB['www']->query($sql1);
                        $result2 = $AeraDB['www']->query($sql2);
                        $result3 = $AeraDB['www']->query($sql3);
                        if ($prow['ogame'] == 1)
                            $result4 = $AeraDB['pwi']->query($sql4);
                        if ((($prow['ogame'] == 1) && ($result4)) || (($prow['ogame'] >= 2) && (true)))
                        {
                            $this->inputs['CONTENT'] = "You have purchased " . $prow[oototal] . " " . $prow[oname] . ".<BR><BR>";
                            $this->inputs['CONTENT'] .= "Please check under Purchase History to view the result. Your new balance is now " . $bal . " AP<BR>";
                        }
                        else
                        {
                            $this->inputs['CONTENT'] = "You failed to purchase " . $prow[oototal] . " " . $prow[oname] . ". Please try again later.<BR><BR>";
                        }
                    }
                }
                else if ($bal < 0)
                {
                    $this->inputs['MSG'] = "You cannot make an order if dont have enough AP balance.";
                    $this->View();
                }
                else if ((int)$prow[ostock] <= 0)
                {
                    $this->inputs['MSG'] = "This item is out of stock. Please choose another item.";
                    $this->View();
                }
                else
                {
                    $this->inputs['MSG'] = "You cannot make an order more than the stock list. You only can only order between 1-" . $prow[ostock];
                    $this->View();
                }
            }

            //CLOSE THE DATABASES
            $AeraDB['pwi']->Close();
            $AeraDB['www']->Close();
        }
        $this->inputs['CREATEKEY'] = time();
        $this->viewpage();
    }

    public function PurchaseHistory()
    {

        $this->set();
        //$this->aera->push('CONTENT', "No result found");
        if ($this->session->userdata('username'))
        {
            $this->load->database("www");
            $this->aera->push('TITLE', "Purchase History");
            $notfound = 1;
            if ($this->user['accstat'] >= 50)
                $query = $this->db->query("select * from ae_purchaselist p, ae_stocks s, ae_accounts u where s.oid=p.oid AND u.aid=p.puid ORDER BY p.pdate DESC LIMIT 0,100");
            else
                $query = $this->db->query("select * from ae_purchaselist p, ae_stocks s, ae_accounts u where s.oid=p.oid AND u.aid=p.puid AND p.puid = " . $this->uid . " ORDER BY p.pdate DESC LIMIT 0,20");
            if ($query->num_rows() >= 1)
            {
                $tables = array(
                    'pid'    => array(
                        'name' => "# Order ID",
                        'type' => NULL
                    ),
                    'status' => array(
                        'name' => "Status",
                        'type' => $this->ListDB
                    ),
                    'pdate'  => array(
                        'name' => "Last Purchase Made",
                        'type' => "TIME"
                    ),
                    'oname'  => array(
                        'name' => "Item Name",
                        'type' => NULL
                    ),
                    'aname'  => 'Purchased by'
                );
                $this->aera->addtables("content", $tables, $query->result_array());
                $notfound = 0;
            }
            if ($notfound == 0)
                $this->aera->push('CONTENT', "<HR>");

            if ($this->user['accstat'] >= 50)
                $query2 = $this->db->query("select * from ae_purchaselist p, ae_accounts u where p.oid=0 AND u.aid=p.puid ORDER BY p.pdate DESC LIMIT 0,100");
            else
                $query2 = $this->db->query("select * from ae_purchaselist p, ae_accounts u where p.oid=0 AND u.aid=p.puid AND p.puid = " . $this->uid . " ORDER BY p.pdate DESC LIMIT 0,20");
            if ($query2->num_rows() >= 1)
            {
                $tables2 = array(
                    'pid'    => array(
                        'name' => "# Order ID",
                        'type' => NULL
                    ),
                    'status' => array(
                        'name' => "Status",
                        'type' => $this->ListDB2
                    ),
                    'pdate'  => array(
                        'name' => "Last Purchase Made",
                        'type' => "TIME"
                    ),
                    'msg'    => array(
                        'name' => "Desc",
                        'type' => NULL
                    ),
                    'aname'  => 'Purchased by'
                );
                $this->aera->addtables("content", $tables2, $query2->result_array());
                $notfound = 0;
            }
            if ($notfound)
                $this->aera->push('CONTENT', "No result found");
            $this->db->Close();
        }
        $this->viewpage();
    }

    public function Balances()
    {

        $this->set();
        //$this->aera->push('CONTENT', "No result found");
        if ($this->session->userdata('username'))
        {
            $this->aera->push('TITLE', "Balances History");
            $notfound = 1;
            if ($this->user['accstat'] >= 50)
            {
                $this->load->database("www");
                $query = $this->db->query("select * from ae_balances b, ae_accounts u where b.uid=u.aid AND b.total>=1 ORDER BY b.pdate DESC LIMIT 0,100");
                if ($query->num_rows() >= 1)
                {
                    $tables = array(
                        'uid'    => array(
                            'name' => "# UID",
                            'type' => NULL
                        ),
                        'total'    => array(
                            'name' => "Total",
                            'type' => NULL
                        ),
                        'pbalance'    => array(
                            'name' => "Balance",
                            'type' => NULL
                        ),
                        'pdate'  => array(
                            'name' => "Last Purchase Made",
                            'type' => "TIME"
                        ),
                        'aname'  => 'Holder'
                    );
                    $this->aera->addtables("content", $tables, $query->result_array());
                    $notfound = 0;
                }
            }
            $this->db->Close();
        }
        $this->viewpage();
    }

    public function View()
    {
        $this->set();
        if (!isset($this->inputs['MSG']))
            $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ((int)$this->uri->segment(3, 0) >= 1)
        {
            $AeraDB['www'] = $this->load->database("www", TRUE);
            //$uname      = $this->input->post("login");

            $query = $AeraDB['www']->query("SELECT * FROM ae_stocks WHERE oid=" . (int)$this->uri->segment(3, 0));
            if ($query->num_rows() >= 1)
            {
                $prow                  = $query->row_array();
                $this->inputs["TITLE"] = $prow[oname];
                $prow[title]           = $prow[oname];
                if (isset($prow[oimg]))
                    $prow[url] = "http://www.perfectworld.com.my/upload/" . $prow[oimg];
                else
                    $prow[url] = "http://www.pwdatabase.com/images/icons/generalm/" . $prow[oiid] . ".gif";
                $prow[link] = "/?/Mall/View/" . $prow[oid];
                $prow[game] = "Game : PWI<BR>";
                $prow[game] .= "Price : " . $prow[oprice] . " AP<BR>";
                if ($prow[ostock] >= 1)
                    $prow[game] .= "Stock : " . $prow[ostock] . " left " . $this->aera->views("malls/order.htm", $prow) . "<BR>";
                else
                    $prow[game] .= 'Stock : <font color="#FF0000">OUT OF STOCK</font>';
                $prow[game] .= "<BR>";
                $prow[game] .= "Desc<BR><style>img { width:100px; height:auto;};</style>";
                $prow[odesc] = str_replace("/images/icons/generalm/", "http://pwi.perfectworld.com.my/images/icons/", $prow[odesc]);
                $prow[odesc] = str_replace("?op=common/item&view=", "http://pwi.perfectworld.com.my/?op=common/item&view=", $prow[odesc]);
                $prow[game] .= $prow[odesc] . "<BR>";

                $this->aera->addviews("content", "list3", $prow);
            }

            //CLOSE THE DATABASES
            $AeraDB['www']->Close();
        }
        $this->inputs['CREATEKEY'] = time();
        if ($this->uri->segment(2) == "View")
            $this->viewpage();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */