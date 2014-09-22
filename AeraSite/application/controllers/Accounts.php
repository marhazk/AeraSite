<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller
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

    var $designpath = "accounts";
    var $designfile = "login";
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
            $this->load->database("default");
            $this->uid  = $this->session->userdata($this->primarykey);
            $query      = $this->db->query("select u.*, b.*,i.* from ae_accounts u, ae_balances b, ae_ipcountry i where i.ipfrom<=" . abs(ip2long($_SERVER[REMOTE_ADDR])) . " AND i.ipto>=" . abs(ip2long($_SERVER[REMOTE_ADDR])) . " AND b.uid=u.aid AND u.aid=" . $this->uid . " LIMIT 0,1");
            $this->user = $query->row_array();
            $this->db->Close();
            $this->inputs['BALANCE'] = $this->user['pbalance'];
        }
        else
            $this->uid = 0;

        //LINKS
        $this->inputs['GMLINKS'] = NULL;
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Mall/Balances">Balances</a></li>';
            $this->inputs['GMLINKS'] .= '<li><h3></h3></li>';
            $this->inputs['GMLINKS'] .= '<li><strong>PWI GM Session</strong></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Accounts/Broadcast">Broadcast Msg</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Accounts/FastMail">FastMail</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="/?/Accounts/iManage">iManage</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="http://cp.haztech.com.my/iweb/manage/">iManage d</a></li>';
            $this->inputs['GMLINKS'] .= '<li><a href="http://cp.haztech.com.my/iweb/role/index.jsp">iRole d</a></li>';

            $this->inputs['GMLINKS'] .= '<li><h3></h3></li>';
            $this->inputs['GMLINKS'] .= '<li><strong>RYL GM Session</strong></li>';
            $this->inputs['GMLINKS'] .= '<li>Coming soon.</li>';
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

    public function ClaimRewards()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title'] = "Claim & Transfer Rewards";
        //$this->inputs['content'] = "Here, you can claim anything that has rewarded";
        $this->aera->addviews("content", "claim", $this->inputs);
        $this->viewpage();
    }

    public function PW()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title'] = "PW > Score Boards";
        //$this->inputs['content'] = "Here, you can claim anything that has rewarded";
        $_tempdb = $this->load->database("pwi", TRUE);
        if ($this->uri->segment(3) == "ScoreBoards")
        {
            $limits = 20;
            $this->aera->push('CONTENT', "<HR>");
            //Top Rank
            $query = $_tempdb->query("select r.*, o.name AS oname, g.name as gname, f.fname from roles r, factionusers fu, factions f, gender g, occupations o WHERE r.gender=g.id AND fu.rid=r.roleid AND f.fid=fu.fid AND r.occupation=o.id AND r.userid!=32 ORDER BY r.battlepower DESC, r.level DESC, r.reputation DESC LIMIT 0,$limits");
            if ($query->num_rows() >= 1)
            {
                $tables = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'fname'          => "Guild"
                );
                $params = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Top Players (ALL)</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables, $query->result_array(), $params);
                $this->aera->push('CONTENT', "<HR>");
            }
            //Top Level
            /*$query2 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.level DESC LIMIT 0,$limits");
            if ($query->num_rows() >= 1)
            {
                $tables2 = array(
                    'roleid'     => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'       => "Character Name",
                    'level'      => "Level",
                    'reputation' => "Reputation",
                    'bounty'     => array(
                        'name' => "Bounty",
                        'type' => 'INT'
                    ),
                    'oname'      => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'      => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params2 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Top Levels</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables2, $query2->result_array(), $params2);
                $this->aera->push('CONTENT', "<HR>");
            }*/
            //Top Bounty
            /*$query3 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.bounty DESC LIMIT 0,$limits");
            if ($query3->num_rows() >= 1)
            {
                $tables3 = array(
                    'roleid'     => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'       => "Character Name",
                    'level'      => "Level",
                    'reputation' => "Reputation",
                    'bounty'     => array(
                        'name' => "Bounty",
                        'type' => 'INT'
                    ),
                    'oname'      => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'      => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params3 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Top Bounty</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables3, $query3->result_array(), $params3);
                $this->aera->push('CONTENT', "<HR>");
            }*/

            //BattlePowers
            $query4 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.battlepower DESC LIMIT 0,$limits");
            if ($query4->num_rows() >= 1)
            {
                $tables4 = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params4 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Top BattlePowers</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables4, $query4->result_array(), $params4);
                $this->aera->push('CONTENT', "<HR>");
            }
            //BattlePowersLVL
            $query4 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.battlepowerlvl DESC LIMIT 0,$limits");
            if ($query4->num_rows() >= 1)
            {
                $tables4 = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params4 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Top BattlePowers Level</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables4, $query4->result_array(), $params4);
                $this->aera->push('CONTENT', "<HR>");
            }
            //New Character
            $query5 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.create_time DESC LIMIT 0,$limits");
            if ($query5->num_rows() >= 1)
            {
                $tables5 = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'create_time'    => "Created Time",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params5 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>New Characters</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables5, $query5->result_array(), $params5);
                $this->aera->push('CONTENT', "<HR>");
            }
            //Last Login
            $query6 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.lastlogin_time DESC LIMIT 0,$limits");
            if ($query6->num_rows() >= 1)
            {
                $tables6 = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'lastlogin_time' => "Last Login Time",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params6 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Last Login Players</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables6, $query6->result_array(), $params6);
                $this->aera->push('CONTENT', "<HR>");
            }
            //Login top 5
            $query6 = $_tempdb->query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND online2=1 ORDER BY lastlogin2 DESC LIMIT 0,5");
            if ($query6->num_rows() >= 1)
            {
                $tables6 = array(
                    'roleid'         => array(
                        'name' => "",
                        'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                    ),
                    'name'           => "Character Name",
                    'reputation'     => "Reputation",
                    'battlepowerlvl' => array(
                        'name' => "BP Level",
                        'type' => 'INT'
                    ),
                    'battlepowerpct' => array(
                        'name' => "BP Exp",
                        'html' => '{BATTLEPOWERPCT}%'
                    ),
                    'oname'          => array(
                        'name' => "Class",
                        'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    ),
                    'gname'          => array(
                        'name' => "Gender",
                        'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                    )
                );
                $params6 = array(
                    'limit'      => $limits,
                    'showid'     => TRUE,
                    'htmlheader' => '<h1>Last Login Players</h1>',
                    'htmlfooter' => ''
                );
                $this->aera->addtables("content", $tables6, $query6->result_array(), $params6);
                $this->aera->push('CONTENT', "<HR>");
            }

            if ($this->user['accstat'] >= 50)
            {
                //Online PLayers
                $query7 = $_tempdb->query("SELECT u.ID, u.name AS uname, u.email, r.*, o.name AS oname, g.name as gname FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, online oo, users u, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND r.userid=oo.Id AND u.ID=r.userid GROUP BY r.userid ORDER BY r.level DESC");
                if ($query7->num_rows() >= 1)
                {
                    $tables7 = array(
                        'ID'             => "UID",
                        'uname'          => "UName",
                        'roleid'         => array(
                            'name' => "",
                            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                        ),
                        'name'           => "Character Name",
                        'lastlogin_time' => "Last Login Time",
                        'level'          => "Level",
                        'reputation'     => "Reputation",
                        'bounty'         => array(
                            'name' => "Bounty",
                            'type' => 'INT'
                        ),
                        'battlepower'    => array(
                            'name' => "Battlepower",
                            'type' => 'INT'
                        ),
                        'battlepowerlvl' => array(
                            'name' => "BP Level",
                            'type' => 'INT'
                        ),
                        'battlepowerpct' => array(
                            'name' => "BP Exp",
                            'html' => '{BATTLEPOWERPCT}%'
                        ),
                        'oname'          => array(
                            'name' => "Class",
                            'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                        ),
                        'gname'          => array(
                            'name' => "Gender",
                            'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                        )
                    );
                    $params7 = array(
                        'limit'      => $limits,
                        'showid'     => TRUE,
                        'htmlheader' => '<h1>Actived Players</h1>',
                        'htmlfooter' => ''
                    );
                    $this->aera->addtables("content", $tables7, $query7->result_array(), $params7);
                    $this->aera->push('CONTENT', "<HR>");
                }
            }
            else
            {
                //Online PLayers
                /*$query7 = $_tempdb->query("SELECT u.ID, u.name AS uname, u.email, r.*, o.name AS oname, g.name as gname FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, online oo, users u, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND r.userid=oo.Id AND u.ID=r.userid GROUP BY r.userid ORDER BY r.level DESC");
                if ($query7->num_rows() >= 1)
                {
                    $tables7 = array(
                        'roleid'         => array(
                            'name' => "",
                            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}"><img src="images/icoInfo.gif"></a>'
                        ),
                        'name'           => "Character Name",
                        'lastlogin_time' => "Last Login Time",
                        'level'          => "Level",
                        'reputation'     => "Reputation",
                        'bounty'         => array(
                            'name' => "Bounty",
                            'type' => 'INT'
                        ),
                        'oname'          => array(
                            'name' => "Class",
                            'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                        ),
                        'gname'          => array(
                            'name' => "Gender",
                            'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                        )
                    );
                    $params7 = array(
                        'limit'      => $limits,
                        'showid'     => TRUE,
                        'htmlheader' => '<h1>Actived Players</h1>',
                        'htmlfooter' => ''
                    );
                    $this->aera->addtables("content", $tables7, $query7->result_array(), $params7);
                    $this->aera->push('CONTENT', "<HR>");
                }
                */
            }
        }
        $this->viewpage();
    }

    public
    function TransferAP()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title'] = "Claim & Transfer > Transfer AP";
        $tamount               = 0;
        $tprice                = 0;
        $tgrp                  = "E";
        $tmsg                  = "";
        $topupuid              = 32;
        //$topupuid              = $this->uid;

        $_tempdb  = $this->load->database("www", TRUE);
        $_temp2db = $this->load->database("pwi", TRUE);

        if ($this->uri->segment(3) == "Reserved")
        {
        }
        else if (strlen($this->uri->segment(3)) >= 4)
        {
            $query = $_temp2db->query("select ID, name FROM users WHERE name='" . $this->user['aname'] . "' LIMIT 0,1");
            if ($query->num_rows() >= 1)
            {
                $row      = $query->row_array();
                $topupuid = $row['ID'];
                if ($this->uri->segment(3) == "50AP")
                {
                    $tamount = 550;
                    $tprice  = 50;
                }
                elseif ($this->uri->segment(3) == "100AP")
                {
                    $tamount = 1150;
                    $tprice  = 100;
                }
                elseif ($this->uri->segment(3) == "150AP")
                {
                    $tamount = 1650;
                    $tprice  = 150;
                }
                elseif ($this->uri->segment(3) == "200AP")
                {
                    $tamount = 2300;
                    $tprice  = 200;
                }
                elseif ($this->uri->segment(3) == "250AP")
                {
                    $tamount = 2800;
                    $tprice  = 250;
                }

                if ($tprice >= 1)
                {
                    if ($this->user['pbalance'] >= $tprice)
                    {
                        //die ($tamount."TEST".$topupuid);
                        $tamountcoin = $tamount * 100;
                        $this->aera->push('key', time());
                        $this->aera->push('msg', NULL);

                        $this->aerapoint->db($_temp2db);

                        $details           = array();
                        $details['puid']   = $this->uid;
                        $details['oid']    = 0;
                        $details['status'] = 2;
                        $details['pdate']  = time();
                        $details['total']  = 1;
                        $details['msg']    = $tamount . " AeraGold Topup code (PW)";
                        $sql               = $this->aera->sql('ae_purchaselist', $details, 'INSERT');
                        $_tempdb->query($sql);


                        $details = $this->aerapoint->AddPWcode(NULL, $topupuid, $tamountcoin, $tprice, $tgrp, $tmsg, 0);
                        //die("PASS");
                        if ($details["success"])
                        {
                            $_tempdb->query("UPDATE ae_balances SET pbalance=pbalance-" . $tprice . " WHERE uid=" . $this->uid);
                            $this->inputs['content'] = "Your " . $tprice . "AP has been transferred into " . $tamount . " AeraGold Topup Code. Login at http://pwi.perfectworld.com.my to topup into the game";
                        }
                        else
                        {
                            $this->inputs['content'] = "Fail to transfer. PW server is currently down. Please try again later.";
                        }
                    }
                    else
                    {
                        $this->inputs['content'] = "You dont have enough balance to transfer. Please topup first before proceed.";
                    }
                }
                else
                {
                    $this->inputs['content'] = "Fail to transfer. Are you trying to hack us?";
                }
            }
            else
            {
                $this->inputs['content'] = "Invalid. Please re-register your account";
            }
        }
        $_tempdb->Close();
        $_temp2db->Close();
        $this->viewpage();
    }

    public
    function TopPlayers()
    {
        $this->set("accounts", "panel", "htm");
        $pwi = $this->load->database("pwi", TRUE);
        $this->aera->push('title', '');

        //RYL2
        $ryl2top = json_decode(file_get_contents('http://cp.haztech.com.my/ryl/stat2.php'));

        if (count($ryl2top) >= 1)
        {
            $tables = array(
                'Name'  => array(
                    'name' => "Name",
                    'type' => NULL
                ),
                'Level' => array(
                    'name' => "Level",
                    'type' => NULL
                ),
                'Medal' => array(
                    'name' => "Medal",
                    'type' => NULL
                ),
                'Race'  => array(
                    'name' => "Race",
                    'type' => array(
                        '0' => "Human",
                        '1' => "Ak'kan"
                    )
                ),
                'Class' => array(
                    'name' => "Class",
                    'type' => array(
                        '10'  => "Enchanter",
                        '11'  => "Priest",
                        '12'  => "Cleric",
                        '13 ' => "N/A",
                        '14 ' => "N/A",
                        '15 ' => "N/A",
                        '17'  => "Combatant",
                        '18'  => "Officiator",
                        '19'  => "Templar",
                        '20'  => "Attacker",
                        '21'  => "Gunner",
                        '22'  => "Rune Ofc.",
                        '23'  => "Life Ofc.",
                        '24'  => "Shadow Ofc.",
                        '0'   => "N/A",
                        '1'   => "Fighter",
                        '2'   => "Rouge",
                        '3'   => "Mage",
                        '4'   => "Acolyte",
                        '5'   => "Defender",
                        '6'   => "Warrior",
                        '7'   => "Assassin",
                        '8'   => "Archer",
                        '9'   => "Sorcerer"
                    )
                ),
                'Fame'  => array(
                    'name' => "Fame",
                    'type' => "NULL"
                )
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '<hr><h1>RYL2 Rank</h1>',
                'htmlfooter' => ''
            );
            $this->aera->addtables("content", $tables, $ryl2top, $params);
        }

        //JD
        $jdtop = json_decode(file_get_contents('http://www.senpohseng.tk/jd/d.php'));
        if (count($jdtop) >= 1)
        {
            $tables = array(
                'name'            => array(
                    'name' => "Name",
                    'type' => NULL
                ),
                'gender'          => array(
                    'name' => "Gender",
                    'html' => '<img src="http://pwi.perfectworld.com.my/images/{GENDER}2.png" alt="{GENDER}" title="{GENDER}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">',
                    'type' => array(
                        '0' => "Male",
                        '1' => "Female"
                    )
                ),
                'level'           => array(
                    'name' => "Level",
                    'type' => NULL
                ),
                'pkvalue'         => array(
                    'name' => "PKP",
                    'type' => NULL
                ),
                'time_used'       => array(
                    'name' => "Total Online",
                    'type' => NULL
                ),
                'reputation'      => array(
                    'name' => "Reputation",
                    'type' => NULL
                ),
                'inventory_money' => array(
                    'name' => "Money",
                    'type' => NULL
                )
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '<hr><h1>Jade Dynasty Rank</h1>',
                'htmlfooter' => ''
            );
            $this->aera->addtables("content", $tables, $jdtop, $params);
        }

        //PWI
        $query = $pwi->query("select r.*, o.name AS oname, g.name as gname, c.name AS cultivation, f.fname from roles r, cultivations c, factionusers fu, factions f, gender g, occupations o WHERE r.gender=g.id AND r.level2=c.id AND fu.rid=r.roleid AND f.fid=fu.fid AND r.occupation=o.id AND r.userid!=32 ORDER BY r.level DESC, r.bounty DESC, r.reputation DESC LIMIT 0,50");
        if ($query->num_rows() >= 1)
        {
            $tables = array(
                'name'       => "Character Name",
                'level'      => "Level",
                'reputation' => "Reputation",
                'bounty'     => array(
                    'name' => "Bounty",
                    'type' => 'INT'
                ),
                'oname'      => array(
                    'name' => "Class",
                    'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                ),
                'gname'      => array(
                    'name' => "Gender",
                    'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                ),
                'fname'      => "Guild"
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '<hr><h1>PWI Rank</h1>',
                'htmlfooter' => ''
            );
            $this->aera->addtables("content", $tables, $query->result_array(), $params);
        }

        //TERA
        $query = $pwi->query("select * FROM character_data d, dbo.character c WHERE c.id=d.playerid ORDER BY c.level DESC LIMIT 0,50");
        if ($query->num_rows() >= 1)
        {
            $tables = array(
                'name'        => "Character Name",
                'gender'      => array(
                    'name' => "Gender",
                    'html' => '<img src="http://pwi.perfectworld.com.my/images/{GENDER}2.png" alt="{GENDER}" title="{GENDER}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                ),
                'race'        => "Race",
                'playerclass' => "Class",
                'level'       => "Level",
                'exp'         => "Experience"
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '<hr><h1>Tera Rank</h1>',
                'htmlfooter' => ''
            );
            $this->aera->addtables("content", $tables, $query->result_array(), $params);
        }
        $pwi->Close();
        $this->viewpage();
    }

    public
    function Panel()
    {
        $this->load->database("default");
        if ($this->session->userdata('username'))
        {
            $this->set("accounts", "panel", "htm");
            //$sqluser = "UPDATE users SET ipaddr='".$_SERVER[REMOTE_ADDR]."', iplong='".abs(ip2long($_SERVER[REMOTE_ADDR]))."', ipcountry='".strtolower($this->user['country2'])."' WHERE ID=".$this->uid.";";
            //$update = $this->db->query($sqluser);


            $query = $this->db->query("select *, b.total as total, (b.total-SUM(b.pbalance)) as totalused, pbalance AS balance, b.pdate AS tdateuse from ae_accounts u, ae_balances b where b.uid=u.aid AND u.aid = " . $this->uid . " ORDER BY b.pdate DESC");
            //$query = $this->db->query("select *, b.total as total, SUM(p.pamount) as totalused, (b.total-SUM(p.pamount)) AS balance, p.pdate AS tdateuse from users u, balances b, pointtransfer p where b.uid=u.ID AND p.puid=u.ID AND u.ID = " . $this->uid ." ORDER BY p.pdate DESC");
            $row = $query->row_array();
            if ($row['astatus'] == 1)
                $row['astatus'] = 'VERIFIED & VALIDATED';
            else
                $row['astatus'] = 'NOT VALIDATED YET.<BR>[<a href="/?/Accounts/ResendValidate">Click here</a> to resend the validation code into your email.]';
            $row['tdateused']      = $this->aera->gendate($row['tdateuse']);
            $this->inputs['title'] = "Details";
            $this->aera->addviews("content");
            $this->aera->addviews("footer");
            $this->aera->addviews("header", "userinfo", $row);

            $this->aera->push(array('LIST' => '<table width=400px><tr><td width=30%><h2>PWI</h2></td><td width=70% style="alignment-adjust:baseline; vertical-align:bottom; text-align:left"><p>[<a href="/?/Mall/Category/1">click here to view more</a>]</p></td></tr></table>'));
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
                        $this->aera->addviews("list", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("list", "list", $prow);
                }
            }
            $this->aera->push(array('LIST' => '<table width=400px><tr><td width=30%><h2>RYL2</h2></td><td width=70% style="alignment-adjust:baseline; vertical-align:bottom; text-align:left"><p>[<a href="/?/Mall/Category/2">click here to view more</a>]</p></td></tr></table>'));
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
                        $this->aera->addviews("list", "list2", $prow);
                        $num = 0;
                    }
                    else
                        $this->aera->addviews("list", "list", $prow);
                }
            }
        }
        $this->db->Close();
        $this->viewpage();
    }

    public
    function Login()
    {

        if ($this->session->userdata('username'))
        {
            $this->Panel();
        }
        else if ($this->input->post("uname"))
        {
            $AeraDBD = $this->load->database("www", TRUE);
            $uname   = $this->input->post("uname");
            $upass   = $this->input->post("upass");
            $query   = $AeraDBD->query("select * from ae_accounts where aname = '" . $uname . "' and apass = '" . $upass . "'");
            if ($query->num_rows() == 1)
            {
                $row = $query->row_array();
                foreach ($query->result() as $_row)
                {
                    $session_data = array(
                        'username' => $_row->aname,
                        'uemail'   => $_row->aemail,
                        'uid'      => $_row->aid
                    );

                }
                $this->set();
                $this->aera->loggerdb($AeraDBD, $row['name'] . " just logged in at the website");
                $this->session->set_userdata($session_data);
                $AeraDBD->Close();
                $this->Panel();
            }
            else
            {
                $this->viewpage();
            }
            $AeraDBD->Close();
        }
        else
        {
            $this->viewpage();
        }
    }

    public
    function TransferData()
    {

        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        $result1       = $AeraDB['pwi']->query("SELECT * from rylaccounts");
        foreach ($result1->result_array() as $row)
        {
            $result2 = $AeraDB['pwi']->query("call fastadd('" . $row[username] . "','" . $row[password] . "','" . time() . "','" . $row[email] . "','" . $row[password] . "','" . $row[hash_key] . "','2');");
        }
        $AeraDB['pwi']->Close();
        die("DONE");
    }

    public
    function FixForum()
    {
        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        $result        = $AeraDB['pwi']->query("SELECT * from users");
        $temp          = "";
        $key           = "AERA";
        foreach ($result->result_array() as $row)
        {
            $ID        = $row['ID'];
            $Login     = $row['name'];
            $Email     = trim($row['email']);
            $Pass      = $row['passwd3'];
            $Salt      = strtolower(trim($Login)) . strtolower(trim($Pass));
            $Salt      = md5($Salt, true);
            $Salt      = base64_encode($Salt);
            $uname     = strtolower(trim($Login));
            $saltedpwd = md5(md5($key) . md5($Pass));
            $temp .= "INSERT IGNORE INTO mybb_users VALUES (NULL, '" . $uname . "', '" . $saltedpwd . "', '" . $key . "', 'Ts9mWix2SnFqhXJkrj6kTYD9qW68nJbFfcADSlruTzVifXdhLG', '" . $Email . "', 0, '', '', '', 2, '', 0, '', 1380839254, 1380839405, 1380839254, 0, '', '0', '', '', '', '', 'all', '', 1, 0, 0, 0, 1, 0, 1, 0, 'linear', 1, 1, 1, 1, 0, 0, 0, '', '', '10', 0, 2, '', '', 0, 0, 0, '0', '', '', '', 0, 0, 0, '175.145.132.177', '175.145.132.177', -1349417807, -1349417807, '', 151, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '');";
            //$resultx = $AeraDB['pwi']->query($temp);
        }
        $AeraDB['pwi']->Close();
        die($temp);
    }

    public
    function FixPassword()
    {
        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        $result        = $AeraDB['pwi']->query("SELECT * from users WHERE passwd='X'");
        $temp          = "";
        foreach ($result->result_array() as $row)
        {
            $ID      = $row['ID'];
            $Login   = $row['name'];
            $Pass    = $row['passwd3'];
            $Salt    = strtolower(trim($Login)) . strtolower(trim($Pass));
            $Salt    = md5($Salt, true);
            $Salt    = base64_encode($Salt);
            $temp    = "UPDATE users SET passwd='$Salt' WHERE ID=" . $ID . ";";
            $resultx = $AeraDB['pwi']->query($temp);
        }
        $AeraDB['pwi']->Close();
        die("DONE");
    }

    public
    function Transfer2RYL()
    {
        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        $result        = $AeraDB['pwi']->query("SELECT * from users");
        $temp          = "";
        foreach ($result->result_array() as $row)
        {
            $ID      = $row['ID'];
            $Login   = $row['name'];
            $Pass    = $row['passwd3'];
            $Salt    = strtolower(trim($Login)) . strtolower(trim($Pass));
            $Salt    = md5($Salt, true);
            $Salt    = base64_encode($Salt);
            $temp    = "UPDATE users SET passwd='$Salt' WHERE ID=" . $ID . ";";
            $resultx = $AeraDB['pwi']->query($temp);
        }
        $AeraDB['pwi']->Close();
        die("DONE");
    }

    public function GameHistory()
    {
        $this->set("accounts", "panel", "htm");
        $this->aera->push('title', "Game History");
        $this->aera->push('content', "Coming soon");
        $this->viewpage();
    }

    public function RegisterGame()
    {
        $this->designpath = "accounts";
        $this->designfile = "panel";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        $this->inputs['temp'] = "";


        $AeraDB['www'] = $this->load->database("www", TRUE);
        $userq = $AeraDB['www']->query("SELECT aname, aemail, apass FROM ae_accounts where aid='".$this->session->userdata('uid')."' LIMIT 0,1;");

        $qrow     = $userq->row_array();
        if ($this->uri->segment(3) == "FWI")
        {
            $this->inputs['result'] = 'Registering your account into Forsaken World Malaysia game';
            //

            //$Login = $_REQUEST['login'];
            //$Pass = $_REQUEST['passwd'];
            //$Repass = $_REQUEST['repasswd'];
            //$Email = $_REQUEST['email'];
            $argv = "";
            $argv .= "login=".$qrow['aname'];
            $argv .= "&passwd=".$qrow['aemail'];
            $argv .= "&email=".$qrow['apass'];

            $result = file_get_contents("http://senpohseng.ddns.net/register/add.php?".$argv);

            if ($result >= 100)
                $this->inputs['result'] = 'Account has been successfully registered';
            else if ($result == 1)
                $this->inputs['result'] = 'Your account is unable to be registered with the current game (Reason: Username is existed due tester or already registered). Please register with another account.';
            else
                $this->inputs['result'] = 'Something goes wrong, please report this to webmaster.';
            //$this->aera->addviews('CONTENT', 'reggame', array());
        }
        else
        {
            //$this->aera->push('TITLE', '');
            //$this->aera->addviews('CONTENT', 'reggame', array());
            //$this->aera->addviews('CONTENT', 'blank', array());
            $this->inputs['result'] = 'Please select any game you want to register with your current account';
        }
        $AeraDB['www']->Close();
        $this->aera->push('TITLE', '');
        $this->aera->addviews('CONTENT', 'reggame', array());
        $this->viewpage();
    }

    public function ValidateOLD()
    {
        $this->designpath    = "accounts";
        $this->designfile    = "validate";
        $this->designtype    = "htm";
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        $chkserver = file_get_contents('http://cp.haztech.com.my/pw/chkport.php?port=3306');

        if (($this->uri->segment(3, 0)) && ($this->uri->segment(4, 0)) && ($chkserver))
        {
            $hash_key          = $this->uri->segment(4, 0);
            $username_to_check = $this->uri->segment(3, 0);
            $usrData           = $this->getDataByHashID($hash_key, $username_to_check);

            if ($usrData [0] == "0" && $usrData [1] == "0" && $usrData [2] == "0" && $usrData [3] == "0")
            {
                $this->inputs["MSG"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
            }
            else
            {
                $username = $usrData [0];
                $umail    = $usrData [1];
                $comments = $usrData [2];
                $aid      = $usrData [2];
                $pass     = $usrData [3];
                $status   = $usrData [4];

                //if (true)
                if ($status == 0)
                {
                    $AeraDB['www'] = $this->load->database("www", TRUE);
                    //$AeraDB['pwi'] = $this->load->database("pwi", TRUE);

                    $reserved = "Reserved";
                    $pos0     = $reserved; //fname
                    $pos1     = $reserved; //lname
                    $pos2     = time(); //idnumber
                    $pos3     = time(); //phonenumber
                    $pos4     = time(); //mobilenumber
                    $pos5     = $reserved; //city
                    $pos6     = $reserved; //state
                    $pos7     = $reserved; //postalcode
                    $pos8     = $reserved; //country/province
                    $pos9     = 1; //dob-day
                    $pos10    = 1; //dob-month
                    $pos11    = 1930; //dob-year
                    $pos12    = 0; //Mentor
                    $pos13    = 0; //gender 0=male , 1=female
                    $Login    = strtolower(trim($username));
                    $Pass     = strtolower(trim($pass));
                    $Repass   = strtolower(trim($pass));
                    $Email    = trim($umail);

                    //PW
                    $Salt = strtolower(trim($Login)) . strtolower(trim($Pass));
                    $Salt = md5($Salt, true);
                    $Salt = base64_encode($Salt);

                    //JD
                    $SaltJD = $Login . $Pass;
                    $SaltJD = md5($SaltJD);
                    $SaltJD = "0x" . $SaltJD; //Encrypts the password

                    //Tera
                    $SaltTera = md5($pass);

                    $hash_key = md5($Login . $Pass . time());

                    //BEGIN REGISTRATION FOR RYL2
                    //$sqlchk    = 'http://cp.haztech.com.my/ryl/reg_acc.php?username=' . $username . '&password=' . $pass . '&skey=aera123';
                    //$usrOutput = json_decode(file_get_contents($sqlchk));

                    //UPDATE!!!
                    $result0 = $AeraDB['www']->query("UPDATE ae_accounts SET astatus = 1, avalidatetime=NOW() where aname = '" . $username . "'");

                    $chk1 = $AeraDB['pwi']->query("SELECT * FROM users WHERE name='$Login'");
                    if ($chk1->num_rows() < 1)
                        $result1 = $AeraDB['pwi']->query("call adduser('$Login', '$Salt', '0', '0', '0', '$pos2', '$Email', '$pos4', '$pos8', '$pos5', '$pos3', '0', '$pos7', '$pos13', now(), '', '$Salt', '$Pass', '$pos0', '$pos1', '$pos6', '$pos9', '$pos10', '$pos11', '$pos12', '$Login', '$hash_key');");

                    $chk2 = $AeraDB['www']->query("SELECT * FROM ae_balances WHERE uid='$aid'");
                    if ($chk2->num_rows() < 1)
                        $result2 = $AeraDB['www']->query("INSERT INTO ae_balances (uid) VALUES ($aid);");

                    //$chk4 = $AeraDB['jd']->query("SELECT * FROM users WHERE name='$Login'");
                    //if ($chk4->num_rows() < 1)
                    //$result4 = $AeraDB['jd']->query("call adduser('$Login', $SaltJD, '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '', '0', $SaltJD)");
                    $chk5 = $AeraDB['pwi']->query("SELECT * FROM accounts WHERE Username='$Login'");
                    if ($chk5->num_rows() < 1)
                        $result5 = $AeraDB['pwi']->query("INSERT INTO accounts(Id,Username,Password,Email,AccessLevel,Membership,LastOnlineUtc,Coins) values(NULL,'" . $Login . "','" . $SaltTera . "','" . $Email . "','" . "0" . "','" . "0" . "','" . "0" . "','" . "0" . "')");

                    //$AeraDB['pwi']->query("UPDATE users SET regsuccess = 1 where name = '".strtolower($username)."'");
                    //$AeraDB['ryl']->query("INSERT IGNORE INTO account (username, password, email, hash_key, comments, status) values ('".strtolower($username)."','$pass','$email','NA','NA', 1) ON DUPLICATE KEY UPDATE email = VALUES(email), status = VALUES(status);");
                    //$AeraDB['ryl']->query("UPDATE account SET status = 1 where username = '$username'");

                    $AeraDB['www']->Close();
                    $AeraDB['pwi']->Close();
                    //$AeraDB['jd']->Close();

                    $this->inputs["MSG"] = "Dear " . $username . ", your account validation is successful. Please launch game client to play.";

                }
                else if (!($chkserver))
                {
                    $this->inputs["MSG"] = "Error. Please Validate later, server is under maintenance.";
                }
                else
                {
                    $this->inputs["MSG"] = "Error. Yo peep! You cannot valid your account twice. If any probs, please contact our admin.";
                }
            }
        }
        else
        {

            //$this->inputs["MSG"] = "Error. Validation is temporary disabled due our developer team still maintenance the server. Operation will be enabled at the evening today.";
            $this->inputs["MSG"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
        }
        $this->viewpage();
    }

    public function Validate()
    {
        $this->designpath    = "accounts";
        $this->designfile    = "validate";
        $this->designtype    = "htm";
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        $chkserver = 1;

        if (($this->uri->segment(3, 0)) && ($this->uri->segment(4, 0)) && ($chkserver))
        {
            $hash_key          = $this->uri->segment(4, 0);
            $username_to_check = $this->uri->segment(3, 0);
            $usrData           = $this->getDataByHashID($hash_key, $username_to_check);

            if ($usrData [0] == "0" && $usrData [1] == "0" && $usrData [2] == "0" && $usrData [3] == "0")
            {
                $this->inputs["MSG"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
            }
            else
            {
                $username = $usrData [0];
                $umail    = $usrData [1];
                $comments = $usrData [2];
                $aid      = $usrData [2];
                $pass     = $usrData [3];
                $status   = $usrData [4];

                //if (true)
                if ($status == 0)
                {
                    $AeraDB['www'] = $this->load->database("www", TRUE);
                    //$AeraDB['pwi'] = $this->load->database("pwi", TRUE);



                    $Login    = strtolower(trim($username));
                    $Pass     = strtolower(trim($pass));
                    $Repass   = strtolower(trim($pass));
                    $Email    = trim($umail);

                    $hash_key = md5($Login . $Pass . time());


                    //UPDATE!!!
                    $result0 = $AeraDB['www']->query("UPDATE ae_accounts SET astatus = 1, avalidatetime=NOW() where aname = '" . $username . "'");

                    $chk2 = $AeraDB['www']->query("SELECT * FROM ae_balances WHERE uid='$aid'");
                    if ($chk2->num_rows() < 1)
                        $result2 = $AeraDB['www']->query("INSERT INTO ae_balances (uid) VALUES ($aid);");

                    $AeraDB['www']->Close();
                    $this->inputs["MSG"] = "Dear " . $username . ", your account validation is successful. Please launch game client to play.";

                }
                else if (!($chkserver))
                {
                    $this->inputs["MSG"] = "Error. Please Validate later, server is under maintenance.";
                }
                else
                {
                    $this->inputs["MSG"] = "Error. Yo peep! You cannot valid your account twice. If any probs, please contact our admin.";
                }
            }
        }
        else
        {

            //$this->inputs["MSG"] = "Error. Validation is temporary disabled due our developer team still maintenance the server. Operation will be enabled at the evening today.";
            $this->inputs["MSG"] = "Error. Operation is invalid. Do you know what are doing? If not so, please go back to our main site.";
        }
        $this->viewpage();
    }

    public
    function ResendValidate()
    {
        $this->designpath = "accounts";
        $this->designfile = "validate";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        if ((int)$this->uri->segment(3, 0) >= 10000)
        {
            $this->load->database('www');
            $uname = $this->input->post('uname');
            $umail = $this->input->post('umail');
            $userq = $this->db->query("SELECT aname, aemail, astatus FROM ae_accounts where aname='$uname' AND aemail='$umail' LIMIT 0,1;");

            if ($userq)
            {
                $qrow     = $userq->row_array();
                $username = $qrow ['aname'];
                $email    = $qrow ['aemail'];
                $comments = $qrow ['aid'];
                $pass     = $qrow ['apass'];

                if ($qrow['regsuccess'] == 1)
                {
                    $this->inputs["MSG"] = "Error. Yo peep! We cannot resend the validation code. You already verified and validated your account";
                }
                else if (strlen($username) >= 2)
                {
                    $AeraDB['www'] = $this->load->database("www", TRUE);

                    $hashkey = md5(md5($username) . md5($email) . time());
                    $chk     = $this->sendMail($email, $username, $hashkey, 'ID:' . $comments);
                    //$sqlryl = "INSERT INTO account (username, password, email, hash_key, comments, status) values ('".strtolower($username)."','$pass','$email','".$hashkey."','NA', '0') ON DUPLICATE KEY UPDATE hash_key = VALUES(hash_key), status = VALUES(status);";
                    //die ($sqlryl);
                    $AeraDB['www']->query("UPDATE ae_accounts SET astatus = 0, aregcode='" . $hashkey . "' where aname = '" . strtolower($username) . "'");
                    //$AeraDB['ryl']->query("UPDATE account SET status = 1 where username = '$username'");

                    $AeraDB['www']->Close();

                    $this->inputs["MSG"] = "Dear " . $username . ", we have sent the validation codes into your email. Please check your email to validate.";
                }
                else
                {
                    $this->inputs["MSG"] = "Error. Yo peep! We cannot resend the validation code. Username or email not matches in our system.";
                }
                $this->db->Close();
            }
            else
            {
                $this->inputs["MSG"] = "Username or email not match. Please insert a correct data to resend.";
            }
        }
        else
        {
            $this->aera->addviews('MSG', 'resend', array());
        }
        $this->viewpage();
    }

    public
    function getDataByHashID($hashid, $username_to_check)
    {
        $this->load->database("www");

        $userData = $this->db->query("select * from ae_accounts where aregcode = '$hashid' and aname = '$username_to_check' ");
        if ($userData->num_rows() > 0)
        {
            foreach ($userData->result() as $row)
            {
                $username = $row->aname;
                $email    = $row->aemail;
                $comments = $row->aid;
                $pass     = $row->apass;
                $status   = $row->astatus;
            }
        }
        else
        {
            $username = 0;
            $email    = 0;
            $comments = 0;
            $pass     = 0;
            $status   = 0;
        }

        $this->db->Close();

        return array(
            $username,
            $email,
            $comments,
            $pass,
            $status
        );
    }

//Clean Forum Spammers
    public
    function CleanSpammers()
    {
        $this->designpath = "accounts";
        $this->designfile = "create";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ((int)$this->uri->segment(3, 0) >= 1)
        {
            //$AeraDB['pwi'] = $this->load->database("pwi", TRUE);
            //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
            $AeraDB['www'] = $this->load->database("www", TRUE);

            //BEGIN REGISTRATION FOR RYL2
            //$result1 = $AeraDB['pwi']->query("");
            //$result2 = $AeraDB['ryl']->query("");
            $result3 = $AeraDB['www']->query("DELETE FROM mybb_users WHERE uid >= 5 AND salt!='AERA';");

            //CLOSE THE DATABASES
            //$AeraDB['pwi']->Close();
            //$AeraDB['ryl']->Close();
            $AeraDB['www']->Close();
        }
        die("DONE");
    }

//Account Creation
    public
    function ChangePassword()
    {
        $this->designpath = "accounts";
        $this->designfile = "password";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ($this->uid <= 32)
        {
            redirect('/Accounts', 'refresh');
        }
        else if ((int)$this->uri->segment(3, 0) >= 1)
        {
            $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
            $AeraDB['www'] = $this->load->database("www", TRUE);
            $upass         = $this->input->post("passwd");
            $unpass        = $this->input->post("newpasswd");
            $urenpass      = $this->input->post("renewpasswd");
            $ufastreg      = 1;
            $table_name    = "account";

            if (empty ($upass) || empty ($unpass) || empty ($urenpass))
            {
                //EMPTY DATA
                $this->inputs['MSG'] = "Please fill the empty fields.";
            }
            else if ($unpass != $urenpass)
            {
                //ERROR PASSWD MISMATCH
                $this->inputs['MSG'] = "Password Mismatch. Please check it properly.";
            }
            else
            {
                if ($ufastreg)
                {
                    //Check if Empty
                    $result0 = $AeraDB['pwi']->query("SELECT * from users WHERE ID='" . $this->uid . "'");
                    if ($result0->num_rows() == 1)
                    {
                        $row   = $result0->row_array();
                        $Login = strtolower(trim($row['name']));
                        $Pass  = strtolower(trim($unpass));
                        //$Repass = strtolower(trim($urenpass));
                        //$Email  = trim($row['email']);

                        $Salt     = strtolower(trim($Login)) . strtolower(trim($Pass));
                        $Salt     = md5($Salt, true);
                        $Salt     = base64_encode($Salt);
                        $hash_key = md5($Login . $Pass . time());

                        //For Forum
                        $key = "AERA";
                        //$ufname    = strtolower(trim($uname));
                        $saltedpwd = md5(md5($key) . md5($unpass));

                        //BEGIN REGISTRATION FOR RYL2
                        $result1  = $AeraDB['pwi']->query("UPDATE users SET passwd3='" . $unpass . "', passwd='" . $Salt . "' WHERE ID=" . $this->uid . ";");
                        $result2  = $AeraDB['www']->query("UPDATE mybb_users SET password='" . $saltedpwd . "' WHERE username='" . $Login . "';");
                        $result3  = $AeraDB['www']->query("UPDATE ae_accounts SET apass='" . $unpass . "' WHERE aname='" . $Login . "';");
                        $xtest    = urlencode("update youxiuser.dbo.usertbl set passwd='$unpass' where account='$Login';");
                        $rylvar   = "http://local.ryl2.perfectworld.com.my/ryl/query.php?key=utem123&stmt=$xtest";
                        $result2b = file_get_contents($rylvar);

                        //CHECK RESULT
                        if ($result1)
                            $err1 = "PW:YES";
                        else
                            $err1 = "PW:NO";
                        if ($result2)
                            $err2 = "FORUM:YES";
                        else
                            $err2 = "FORUM:NO";
                        if ($result3)
                            $err3 = "WWW:YES";
                        else
                            $err3 = "WWW:NO";
                        if (($result1) && ($result2) && ($result3))
                        {
                            $this->inputs['MSG'] = "Change Password success. You may login with new password now.";
                        }
                        else
                        {
                            $this->inputs['MSG'] = "Change Password error. Please check your input data. ERROR INFO: $err1 $err2";
                        }
                    }
                    else
                    {
                        $this->inputs['MSG'] = "Username or email is not existed. Please login first.";
                    }
                }
                else
                {
                    $this->inputs['MSG'] = "Sorry for the inconvenience. Our team has disable this. Please contact administrator for instance.";
                }
            }
            //CLOSE THE DATABASES
            $AeraDB['pwi']->Close();
            $AeraDB['www']->Close();
        }
        $this->inputs['CREATEKEY'] = time();
        $this->viewpage();
    }

//Account Creation
    public
    function Success()
    {
        $this->designpath = "accounts";
        $this->designfile = "success";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "<h1>Verify your email address<BR><BR>You are almost done! A verification message has been sent into your EMAIL.<BR><BR>Check your email and follow the link to finish creating your Aera account. Once you verify your email address, you will be able to access all Aera games and services.</h1>";

        $this->viewpage();
    }

    public
    function Create()
    {
        $this->designpath    = "accounts";
        $this->designfile    = "create";
        $this->designtype    = "htm";
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');
        if ((int)$this->uri->segment(3, 0) >= 1)
        {
            $AeraDB['www'] = $this->load->database("www", TRUE);
            $this->set();
            $uname      = $this->input->post("login");
            $umail      = $this->input->post("email");
            $upass      = $this->input->post("passwd");
            $urepass    = $this->input->post("repasswd");
            $ufastreg   = $this->input->post("fastreg");
            $table_name = "account";

            if (empty ($uname) || empty ($upass) || empty ($umail) || empty ($urepass))
            {
                //EMPTY DATA
                $this->inputs['MSG'] = "Please fill the empty fields.";
            }
            else if ($upass != $urepass)
            {
                //ERROR PASSWD MISMATCH
                $this->inputs['MSG'] = "Password Mismatch. Please check it properly.";
            }
            else if (!preg_match('/^[a-z0-9]{5,10}$/', $uname))
            {
                //ERROR USERNAME INVALID
                $this->inputs['MSG'] = "Account ID should consist of a-z, 0-9 and 5-10 length!";
            }
            else if ((strlen($uname) < 5) || (strlen($uname) > 10))
            {
                //ERROR USERNAME INVALID
                $this->inputs['MSG'] = "Account ID should 5-10 length!";
            }
            else
            {
                //BEGIN REGISTRATION FOR PWAERA
                if ($ufastreg)
                {
                    $reserved = "Reserved";
                    $pos0     = $reserved; //fname
                    $pos1     = $reserved; //lname
                    $pos2     = time(); //idnumber
                    $pos3     = time(); //phonenumber
                    $pos4     = time(); //mobilenumber
                    $pos5     = $reserved; //city
                    $pos6     = $reserved; //state
                    $pos7     = $reserved; //postalcode
                    $pos8     = $reserved; //country/province
                    $pos9     = 1; //dob-day
                    $pos10    = 1; //dob-month
                    $pos11    = 1930; //dob-year
                    $pos12    = 0; //Mentor
                    $pos13    = 0; //gender 0=male , 1=female
                    $Login    = strtolower(trim($uname));
                    $Pass     = strtolower(trim($upass));
                    $Repass   = strtolower(trim($urepass));
                    $Email    = trim($umail);

                    $Salt     = strtolower(trim($Login)) . strtolower(trim($Pass));
                    $Salt     = md5($Salt, true);
                    $Salt     = base64_encode($Salt);
                    $hash_key = md5($Login . $Pass . time());

                    //For Forum
                    $key       = "AERA";
                    $ufname    = strtolower(trim($uname));
                    $saltedpwd = md5(md5($key) . md5($upass));

                    //Check if Empty
                    $result0 = $AeraDB['www']->query("SELECT * from ae_accounts WHERE aname='" . $Login . "' OR aemail='" . $Email . "'");
                    if ($result0->num_rows() < 1)
                    {
                        //BEGIN REGISTRATION into mybb
                        $result1 = $AeraDB['www']->query("INSERT INTO ae_accounts (aname, aemail, apass, aregcode, astatus) VALUES ('$Login', '$Email', '$upass', '$hash_key', 0);");

                        $result2 = $AeraDB['www']->query("INSERT IGNORE INTO mybb_users VALUES (NULL, '" . $ufname . "', '" . $saltedpwd . "', '" . $key . "', 'Ts9mWix2SnFqhXJkrj6kTYD9qW68nJbFfcADSlruTzVifXdhLG', '" . $Email . "', 0, '', '', '', 2, '', 0, '', 1380839254, 1380839405, 1380839254, 0, '', '0', '', '', '', '', 'all', '', 1, 0, 0, 0, 1, 0, 1, 0, 'linear', 1, 1, 1, 1, 0, 0, 0, '', '', '8', 0, 2, '', '', 0, 0, 0, '0', '', '', '', 0, 0, 0, '175.145.132.177', '175.145.132.177', -1349417807, -1349417807, '', 151, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '');");


                        //CHECK RESULT
                        if ($result1)
                            $err1 = "ACC:YES";
                        else
                            $err1 = "ACC:NO";
                        if ($result2)
                            $err2 = "FORUM:YES";
                        else
                            $err2 = "FORUM:NO";
                        if (($result1) && ($result2))
                        {
                            if ($this->sendMail($umail, $uname, $hash_key, 'N/A'))
                            {
                                $resultdl = file_get_contents("http://www.perfectworld.com.my/?/Accounts/Logger?dl=2&q=" . $uname);
                                //$this->aera->logger($uname." just registered at the website");
                                $this->inputs['MSG'] = "Registration success. Please check your email to validate.";
                                redirect('/Accounts/Success', 'refresh');
                                //$this->Success();
                                //die();
                            }
                            else
                            {
                                $chk1                = $AeraDB['www']->query("delete from ae_accounts where aname = '$Login' AND aregcode = '$hash_key'");
                                $chk2                = $AeraDB['www']->query("delete from mybb_users where username = '$ufname' AND salt = '$key'");
                                $this->inputs['MSG'] = "Invalid email. Please re-register again.";
                            }
                        }
                        else
                        {
                            $chk1                = $AeraDB['www']->query("delete from ae_accounts where aname = '$Login' AND aregcode = '$hash_key'");
                            $chk2                = $AeraDB['www']->query("delete from mybb_users where username = '$ufname' AND salt = '$key'");
                            $this->inputs['MSG'] = "Registration error. Please check your input data. ERROR INFO: $err1 $err2";
                        }
                    }
                    else
                    {
                        $this->inputs['MSG'] = "Username or email is already existed. Try another one later.";
                    }
                }
                else
                {
                    $this->inputs['MSG'] = "You have not agree our Term and Policy.";
                }
            }
            //CLOSE THE DATABASES
            $AeraDB['www']->Close();
        }
        $this->inputs['CREATEKEY'] = time();
        $this->viewpage();
    }

    public
    function sendMail($email, $uname, $skey, $ucomments)
    {
        $this->load->library('email');
        $this->email->from('noreply@perfectworld.com.my', 'Aera Registration Support');
        $this->email->to($email);
        $msg = '<p>Dear ' . $uname . ', </p>
<p>  Your registeration has been accepted. Please check the following details:</p>
<p>Username : ' . $uname . '<br />
  Password : ****<br />
  Your comments : ' . $ucomments . '
</p>
<p>If all the details is correct, you may proceed by clicking this <a href="http://www.perfectworld.com.my/?/Accounts/Validate/' . $uname . '/' . $skey . '">link</a> to verify. </p>
<p><strong>RYL2 Aera NOTE: </strong></p>
<p><strong>  By clicking the link, you are agree with our terms (Tester Terms) listed below:</strong></p>
<p><strong>1. You may report bugs at facebook fanpage, but do not hope that admins will entertain you.<br />
2. No items selling (using Ringgit Malaysia or other currency).<br />
3. Starting October 2013, server will be down in weeks on Monday 1am - 4am.</strong></p>
<p><strong>PWI Aera NOTE: </strong></p>
<p><strong>  By clicking the link, you are agree with our terms (Tester Terms) listed below:</strong></p>
<p><strong>1. You may report bugs at facebook fanpage, but do not hope that admins will entertain you.<br />
2. No items selling (using Ringgit Malaysia or other currency).<br />
3. No advertisements in game or facebook. Account will be banned for Mass Ads reasons.</strong></p>
<p>Regards, </p>
<p>Aera Supports.</p>';
        $this->email->subject('Aera User Account Validation');
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

    public
    function TopList()
    {
    }

    public
    function TopupPoint()
    {
        $this->load->helper('form');
        if ($this->session->userdata('username'))
        {
            $this->set("accounts", "panel", "htm");
            $_tempdb = $this->load->database("www", TRUE);
            $this->aera->addviews("content", "topup", array());
            //select *, b.total as total, SUM(p.pamount) as totalused, (b.total-SUM(p.pamount)) AS balance, p.pdate AS tdateuse from users u, balances b, pointtransfer p where b.uid=u.ID AND p.puid=u.ID AND u.ID = " . $this->uid ." ORDER BY p.pdate DESC
            $this->inputs['title'] = "Top-up Aerapoint";
            $this->inputs['list']  = "N/a";

            if ($this->uri->segment(3, 0) == "Reserved")
            {
            }
            else if ($this->uri->segment(3, 0) == "PayPal")
            {
                $this->aera->addviews("content", "paypal", array());
            }
            else if ($this->uri->segment(3, 0) == "GetRedeemCode")
            {
                if ((strlen($this->input->post("datecode")) >= 1) && (strlen($this->input->post("timecode")) >= 1) && (strlen($this->input->post("price")) >= 1))
                {
                    //2014-01-03time:05:03
                    //yyyy-dd-mm HH:mm
                    //die ($this->input->post("datecode") . "time:" . $this->input->post("timecode"));
                    //
                    $datecode = $this->input->post("datecode");
                    $timecode = $this->input->post("timecode");
                    $price    = $this->input->post("price");

                    $chkdb = $_tempdb->query("select * from ae_topups WHERE datecode='" . $datecode . "' AND timecode='" . $timecode . "' AND payment='" . $price . "' AND claimed=0;");
                    if ($chkdb->num_rows() >= 1)
                    {
                        $trow = $chkdb->row_array();
                        //$this->aera->push('LIST', "TEST".$trow[serial]);
                        $updatecode = $_tempdb->query("UPDATE ae_topups SET bid=" . $this->uid . ", claimed=1 WHERE cid=" . $trow['cid'] . ";");
                        if ($updatecode)
                            $this->aera->push('LIST', "Congratulation! You have redeem a topup code. The new Aera TopupCode is now displayed below. You may topup it now with that topup code.");
                        else
                            $this->aera->push('LIST', "ERROR: Fail to update. Please re-try");
                    }
                    else
                        $this->aera->push('LIST', "ERROR: Unknown records. Are you sure you already pay? If you already paid, please wait within 24 hours. Plus, you also cannot redeem the topup code twice.");
                }
                $this->aera->addviews("content", "getredeem", array());
            }
            else if ($this->uri->segment(3, 0) == "RedeemCode")
            {
                $this->aera->push('key', time());
                $this->aera->push('msg', NULL);
                if ($this->user['accstat'] >= 100)
                {
                    $queryudb = $_tempdb->query("select aid, aname from ae_accounts WHERE astatus=1 order by aname ASC;");
                    if (($queryudb->num_rows() >= 1) && ($this->uri->segment(5, 0) == "Add"))
                    {
                        foreach ($queryudb->result_array() as $row)
                        {
                            $this->aera->push('formuid', '<option value="' . $row["aid"] . '">' . $row["aname"] . '</option>');
                        }
                    }
                    $queryudb2 = $_tempdb->query("select aid, aemail from ae_accounts WHERE astatus=1 order by aemail ASC;");
                    if (($queryudb2->num_rows() >= 1) && ($this->uri->segment(5, 0) == "Add"))
                    {
                        foreach ($queryudb2->result_array() as $row2)
                        {
                            $this->aera->push('formemail', '<option value="' . $row2["aid"] . '">' . $row2["aemail"] . '</option>');
                        }
                    }
                    $this->aera->addviews("content", "addredeem", array());
                }
                $this->aera->addviews("content", "redeem", array());
                if ($this->uri->segment(4, 0) == "RESERVED")
                {
                }
                else if ($this->uri->segment(4, 0) >= 1000)
                {
                    $this->aerapoint->db($_tempdb);
                    $details = array();
                    if (($this->uri->segment(5) == "Add") && ($this->user['accstat'] >= 100))
                    {
                        if (($this->input->post('topupuid') >= 1) || ($this->input->post('topupuid2') >= 1))
                        {
                            if ($this->input->post('topupuid') >= 1)
                                $topupuid = $this->input->post('topupuid');
                            if ($this->input->post('topupuid2') >= 1)
                                $topupuid = $this->input->post('topupuid2');
                            //die("TEST".$topupuid);
                            $more    = $topupuid;
                            $details = $this->aerapoint->Addcode(NULL, $more, $this->input->post('topupamount'), $this->input->post('topupprice'), $this->input->post('topupgroup'), $this->input->post('topupmsg'), $this->uid);
                            //die("PASS");
                            if ($details["success"])
                            {
                                if ($this->input->post('topupgroup') == "E")
                                {
                                    $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " has been added into AeraPointDB and emailed to him/her");
                                }
                                else
                                    $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " has been added into AeraPointDB");
                            }
                            else
                            {
                                /** @noinspection PhpUndefinedFieldInspection */
                                $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " failed to be added into AeraPointDB ");
                            }
                        }
                        else
                        {
                            $topupuid = 0;
                            //die("TEST".$topupuid);
                            if ((strlen($this->input->post('datecode')) >= 1) && (strlen($this->input->post('timecode')) >= 1))
                            {
                                $more             = array();
                                $more['datecode'] = $this->input->post('datecode');
                                $more['timecode'] = $this->input->post('timecode');
                                $more['bid']      = 0;
                            }
                            else
                                $more = $topupuid;
                            $details = $this->aerapoint->Addcode(NULL, $more, $this->input->post('topupamount'), $this->input->post('topupprice'), $this->input->post('topupgroup'), $this->input->post('topupmsg'), $this->uid);
                            //die("PASS");
                            if ($details["success"])
                            {
                                if ($this->input->post('topupgroup') == "E")
                                {
                                    $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " has been added into AeraPointDB and emailed to him/her but unknown user");
                                }
                                else
                                    $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " has been added into AeraPointDB");
                            }
                            else
                            {
                                /** @noinspection PhpUndefinedFieldInspection */
                                $this->aera->push('msg', $details["serial"] . " with amount " . $details["cash"] . " failed to be added into AeraPointDB ");
                            }
                        }
                    }
                    else
                    {
                        if (true)
                        {
                            $details = $this->aerapoint->Topup($this->uid, $this->input->post('topupcode'));
                            if ($details["success"] == 10)
                            {
                                $this->aera->push('msg', "Congratulation! You have been topup " . ($details["cash"]) . " Aera. Please relogin within 10 minutes to receive the Aerapoint");
                                //$this->aera->push('msg', "Congratulation! You have been topup ".($details["cash"]/100)." Aerapoint. Please relogin within 10 minutes to receive the Aerapoint");
                            }
                            elseif ($details["success"] == 9)
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup serial id " . ($details["serial"]) . ". Please contact Administrator for details..");
                            }
                            elseif ($details["success"] == 5)
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup serial id " . ($details["serial"]) . ". This coupon card is not for you.");
                            }
                            elseif ($details["success"] == 4)
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup serial id " . ($details["serial"]) . ". Unable to sync to the game server.");
                            }
                            elseif ($details["success"] == 3)
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup. Unable to retrieve the coupon.");
                            }
                            elseif ($details["success"] == 2)
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup serial id " . ($details["serial"]) . ". Topup Coupon has been locked/banned.");
                            }
                            elseif ($details["success"] == 1)
                            {
                                $this->aera->push('msg', "ERROR: Fail to retrieve. Already topup or code already used. Top-up Serial Number : " . $details["serial"]);
                            }
                            else
                            {
                                $this->aera->push('msg', "ERROR: Fail to topup. Unknown topup code.");
                            }
                        }
                        /*else if ($this->input->post('topuptype') == 442)
                        {
                            $details = $this->AeraPoint->Addcode(NULL, $this->input->post('uid'), 0, 0, "E", "", 32, 2, $this->input->post('topupcode'));
                            $this->aera->push('msg', "Congratulation! You have been topup DiGi Topup Code into AeraPoint Code. Please wait for several minutes for the status...");
                        }*/
                    }
                }
            }
            if ($this->user['accstat'] >= 50)
                $_sql = "select t.*, u.aname from ae_topups t, ae_accounts u where u.aid=t.bid order by t.cid desc limit 0,20";
            else
                $_sql = "select t.*, u.aname from ae_topups t, ae_accounts u where u.aid=t.bid AND t.bid = " . $this->uid . "  order by t.cid desc";
            ////die("Temporary closed due server maintenance...");
            $_squery = $_tempdb->query($_sql);
            if ($_squery->num_rows() >= 1)
            {
                $tables                = array(
                    'code'   => array(
                        'name' => "Redeem Code",
                        'html' => '<font face="Courier">{CODE}</font>'
                    ),
                    'serial' => "Serial Code",
                    'cash'   => "Aera",
                    'status' => array(
                        'name' => "Status",
                        'type' => array(
                            "0" => "-",
                            "1" => "Used",
                            "2" => "Pending"
                        )
                    ),
                    'aname'  => "Purchaser"
                );
                $this->inputs["TITLE"] = "Top-up AeraPoint History";
                $this->aera->addtables("list", $tables, $_squery->result_array());
                if ($this->user['accstat'] >= 50)
                {
                    //$_sql2 = "select x.*. u.aname from accounts u, (select t.* from ae_topups t where t.bid=0 order by t.cid desc limit 0,20) as x WHERE u.aid= OR x.bid=0 LIMIT 0,20";
                    $_sql2    = "select t.* from ae_topups t order by t.cid desc limit 0,20";
                    $_squery2 = $_tempdb->query($_sql2);
                    if ($_squery2->num_rows() >= 1)
                    {
                        $tables2 = array(
                            'code'    => array(
                                'name' => "Redeem Code",
                                'html' => '<font face="Courier">{CODE}</font>'
                            ),
                            'serial'  => "Serial Code",
                            'cash'    => "Aera",
                            'bid'     => "Purchaser",
                            'status'  => array(
                                'name' => "Status",
                                'type' => array(
                                    "0" => "-",
                                    "1" => "Used",
                                    "2" => "Pending"
                                )
                            ),
                            'claimed' => array(
                                'name' => "Status",
                                'type' => array(
                                    "0" => "-",
                                    "1" => "Claimed"
                                )
                            )
                        );
                        $this->aera->addtables("list", $tables2, $_squery2->result_array());
                    }
                }
            }
            else
                $this->aera->push('LIST', "No result found");
            $_tempdb->Close();
        }
        $this->viewpage();
    }

    public
    function TransferPoint()
    {
        if ($this->session->userdata('username'))
        {
            $this->set("accounts", "panel", "htm");
            $this->load->database("www");

            $query = $this->db->query("select * from ae_pointtransfer where puid = " . $this->uid . " ORDER BY pdate DESC");
            if ($query->num_rows() >= 1)
            {
                $tables                = array(
                    'pamount' => array(
                        'name' => "Amount",
                        'type' => NULL
                    ),
                    'pgame'   => array(
                        'name' => "Game",
                        'type' => array(
                            "1" => "PW:Aera",
                            "2" => "RYL2:Aera"
                        )
                    ),
                    'pdate'   => array(
                        'name' => "Last Transaction Made",
                        'type' => "TIME"
                    )
                );
                $this->inputs["TITLE"] = "Transaction History";
                $this->aera->addtables("content", $tables, $query->result_array());
            }
            else
                $this->aera->push(array('CONTENT', "No result found"));
            $this->db->Close();
        }
        $this->viewpage();
    }

    public
    function CheckUsername()
    {
        if ($this->uri->segment(4, 1) == 0)
        {
            $this->load->database("www");
            $uname = $this->uri->segment(3, 0);
            $query = $this->db->query("select * from ae_accounts where aname = '" . $uname . "'");
            $num   = $query->num_rows();
            //(preg_match('/^[A-Za-z][A-Za-z0-9]{5,10}$/', $uname))
            $this->db->Close();
            if ($num == 1)
                die("4"); //FAIL
            else if (!preg_match('/^[a-z0-9]{5,10}$/', $uname))
                die("141"); //FAIL
            else
                die("3"); //VALID
        }
        else
            die("WrongValue");
    }

    public
    function CheckEmail()
    {
        if ($this->uri->segment(4, 1) == 0)
        {
            $this->load->database("www");
            $umail = $this->uri->segment(3, 0);
            $query = $this->db->query("select * from ae_accounts where aemail = '" . $umail . "'");
            $num   = $query->num_rows();
            $this->db->Close();
            if ($num == 1)
                die("4"); //FAIL
            else if (preg_match('/^[A-Za-z0-9][A-Za-z0-9][@][A-Za-z0-9.]{5,50}$/', $umail))
                die("141"); //FAIL
            else
                die("3"); //VALID
        }
        else
            die("WrongValue");
    }

    public
    function UpdateRYL()
    {
        $ryl2top = json_decode(file_get_contents('http://local.ryl2.perfectworld.com.my/ryl/stat2.php'));
        $chk     = "";
        foreach ($ryl2top as $row)
        {
            $chk .= "INSERT INTO rylfame (cid,name,fame,medal) VALUES (" . $row->CID . ", '" . $row->Name . "', " . $row->Fame . ", " . $row->Medal . ") ON DUPLICATE KEY UPDATE fame = VALUES(fame), medal = VALUES(medal);";
        }
        die($chk);
    }

    public
    function RecentActivity()
    {
        $this->set("default", "default", "htm");
        $this->load->database("pwi");
        if ($this->input->get("_") > 0)
        {
            $query = $this->db->query("select * from activities WHERE ((amsg not Like '%test%') AND (amsg not Like '%admin %')) and ((vstr1 not Like '%test%' AND vstr1 not Like 'admin')) ORDER BY aid DESC LIMIT 0,8");
            foreach ($query->result_array() as $row)
            {
                if ($row['amsg'] == "PW:LOGIN")
                    $feeds['text'] = $row['vstr1'] . " just logged in PWI";
                else if ($row['amsg'] == "REGISTER")
                    $feeds['text'] = $row['vstr1'] . " just registered an account.";
                else if ($row['amsg'] == "PW:LOGOUT")
                    $feeds['text'] = $row['vstr1'] . " just logged out from PWI";
                else
                    $feeds['text'] = $row['amsg'];
                $this->aera->addviews("content", "feeds", $feeds);
            }
        }
        $this->db->Close();
        $this->viewpage(FALSE);
    }

    public
    function Logger()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->set();
        if ($this->input->get('dl') == 1)
        {
            $dba = $this->load->database("www", TRUE);
            $this->aera->loggerdb($dba, $this->input->get('q'));
            $dba->Close();
            die("OK");
        }
        else if ($this->input->get('dl') == 2)
        {
            $this->load->database("www");
            $name = $this->input->get('q');
            $this->db->query("INSERT into ae_activities (amsg, vstr1) VALUES ('REGISTER', '" . $name . "');");
            $this->db->Close();
            die("OK");
        }
        die("NO");
    }


    public
    function Broadcast()
    {
        $this->designpath = "accounts";
        $this->designfile = "panel";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);//
        if ((int)$this->user['accstat'] >= 50)
        {
            if ((int)$this->uri->segment(3, 0) >= 10000)
            {
                $bmsg   = $this->input->post('bmsg');
                $result = file_get_contents("http://cp.haztech.com.my/iweb/broadcast2.jsp?msg=" . $bmsg);
                $this->aera->push('TITLE', 'Broadcast Message - ' . $result);
            }
            else
            {
                $this->aera->push('TITLE', 'Broadcast Message');
            }
            $this->aera->addviews('CONTENT', 'broadcast', array());
        }
        else
        {
            $this->aera->push('TITLE', '');
            $this->aera->addviews('CONTENT', 'blank', array());
        }
        $AeraDB['pwi']->Close();
        //$AeraDB['ryl']->Close();
        $this->viewpage();
    }

    public
    function Template()
    {
        $this->designpath = "accounts";
        $this->designfile = "panel";
        $this->designtype = "htm";
        $this->set();
        $this->inputs['MSG'] = "";
        $this->load->helper('form');
        $this->load->helper('url');

        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);
        if ((int)$this->uri->segment(3, 0) >= 10000)
        {
        }
        else
        {
            $this->inputs['result'] = 'hlalhlelhaehe';
            $this->aera->push('TITLE', '');
            $this->aera->addviews('CONTENT', 'blank', array());
        }
        $AeraDB['pwi']->Close();
        $this->viewpage();
    }


    public
    function FastMail()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title']        = "Fast Mail System";
        $this->inputs['announcement'] = "Here, you can claim anything that has rewarded";
        $adb                          = $this->load->database("pwi", TRUE);
        if ($this->user['accstat'] >= 50)
        {
            $this->inputs['RESULT'] = "";
            if ((int)$this->uri->segment(3, 0) >= 10000)
            {
                if (strlen((int)$this->input->post('rid')) >= 2)
                    $rid = (int)$this->input->post('rid');
                else if ((int)$this->input->post('rid2') >= 1)
                    $rid = (int)$this->input->post('rid2');
                else
                    $rid = (int)$this->input->post('rid3');

                if (strlen((int)$this->input->post('iid')) >= 2)
                    $iid = $this->input->post('iid');
                else
                    $iid = $this->input->post('iid2');

                $icount = $this->input->post('icount');

                $imask       = "";
                $imaxcount   = $this->input->post('imaxcount');
                $sender      = $this->input->post('sender');
                $msg         = $this->input->post('msg');
                $iproctype   = $this->input->post('iproctype');
                $iexpiredate = $this->input->post('iexpiredate');
                $idata       = $this->input->post('idata');
                $resultQuery = "";
                $itemDB      = explode(":", $iid);
                foreach ($itemDB as $val)
                {
                    $sqladd  = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('0', '" . $rid . "', '0', '" . $val . "', '" . $icount . "', '" . $imaxcount . "', '" . $sender . "', '" . $msg . "', '" . $iproctype . "', '" . $iexpiredate . "', '" . $imask . "', '" . $idata . "', NOW());";
                    $additem = $adb->query($sqladd);
                    if ($additem)
                        $this->inputs['RESULT'] .= "The item " . $val . " has been successfully sent to " . $rid . "<BR>";
                    else
                        $this->inputs['RESULT'] .= "The item " . $val . " has not been sent to " . $rid . "<BR>";
                    //$this->inputs['RESULT'] .= $sqladd;
                }
            }
            $tables = array(
                'roleid' => "Role ID",
                'name'   => "Name",
                'iname'  => "Item Name",
                'status' => array(
                    'name' => "Status",
                    'type' => array(
                        '0' => "-",
                        '1' => "Delivered"
                    )
                ),
                'icount' => "Total #",
                'isdate' => "Added on"
            );
            $params = array(
                'limit'  => 30,
                'showid' => TRUE
            );
            $qitem  = $adb->query("SELECT r.roleid, r.name, i.iname, u.status, u.* FROM uwebitems u, itemlist i, roles r WHERE i.iid=u.iid AND r.roleid=u.roleid ORDER BY u.isdate DESC LIMIT 0,30;");

            $sqlae_itemlist          = "SELECT u.*, i.* FROM uwebitems i, itemlist u WHERE u.iid=i.iid GROUP BY i.iid ORDER BY i.iid ASC";
            $qae_itemlist            = $adb->query($sqlae_itemlist);
            $qr2                     = $adb->query("SELECT r.* FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, online o, users u WHERE r.userid=o.Id AND u.ID=r.userid GROUP BY r.userid ORDER BY r.roleid ASC");
            $qr3                     = $adb->query("SELECT r.* FROM (SELECT * FROM roles ORDER BY lastlogin_time DESC) AS r, online o, users u WHERE r.userid=o.Id AND u.ID=r.userid GROUP BY r.userid ORDER BY r.name ASC");
            $tablesval               = array();
            $this->inputs['RID2VAL'] = "";
            foreach ($qae_itemlist->result_array() as $row)
            {
                $this->inputs['IID'] .= '<option value="' . $row[iid] . '">' . $row[iname] . '</option>';
            }
            foreach ($qr2->result_array() as $row)
            {
                $this->inputs['RID2'] .= '<option value="' . $row[roleid] . '">' . $row[name] . '</option>';
            }
            foreach ($qr3->result_array() as $row)
            {
                $this->inputs['RID3'] .= '<option value="' . $row[roleid] . '">' . $row[name] . '</option>';
            }
            $this->aera->addviews("content", "fastmail", $this->inputs);
            $this->aera->addtables("content", $tables, $qitem->result_array(), $params);
        }
        else
            $this->aera->push('content', 'You dont have priviledge here');
        $adb->Close();
        $this->viewpage();
    }

    public
    function iManage()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title']        = "iManage";
        $this->inputs['announcement'] = "Here, you can claim anything that has rewarded";
        //$adb = $this->load->database("pwi", TRUE);
        if ($this->user['accstat'] >= 50)
        {

            if (strlen($this->uri->segment(3)) >= 1)
            {
                $content = file_get_contents("http://cp.haztech.com.my/iweb/manage/" . $this->uri->segment(3));
                $this->inputs['title'] .= " > " . $this->uri->segment(3);
            }
            else
                $content = file_get_contents("http://cp.haztech.com.my/iweb/manage/");
            $content = str_replace("<form action=\"", "<form action=\"/?/Accounts/iManage/", $content);
            $this->aera->push('content', $content);
        }
        else
            $this->aera->push('content', 'You dont have priviledge here');
        $this->viewpage();
    }


    /*public function Template()
    {
        $this->set("accounts", "panel", "htm");
        $this->inputs['title']			= "Fast Mail System";
        $this->inputs['announcement']	= "Here, you can claim anything that has rewarded";
        $this->load->database("pwi");
        if ($this->user['accstat'] >= 50)
        {
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
            $this->aera->addtables("content", $tables, $qitem->result_array(), $params);
        }
        else
            $this->aera->push('content', 'You dont have priviledge here');
        $this->viewpage();
    }*/

    public
    function Logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }

    public
    function Test()
    {
        die("TESTaXAXAaa");
    }

    public
    function Test2()
    {
        die("xa");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */