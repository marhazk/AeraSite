<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
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
    public function Test11()
    {
        $this->load->view('welcome_message');
    }

    public function Test112()
    {
        $this->load->view('feature');
    }

    public function __index()
    {
        $this->load->view('welcome_message');
    }

    public function index()
    {
        //$AeraDB['pwi'] = $this->load->database("default", TRUE);
        //$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
        $AeraDB['www'] = $this->load->database("default", TRUE);
        $AeraDB['pwi'] = $this->load->database("pwi", TRUE);

        //TERA
        $query = $AeraDB['pwi']->query("select * FROM character_data d, dbo.character c WHERE c.id=d.playerid AND d.name NOT LIKE '%GM%' ORDER BY c.level DESC LIMIT 0,10");
        if ($query->num_rows() >= 1)
        {
            $tables = array(
                'name'        => "Name",
                'gender'      => array(
                    'name' => "Gender",
                    'html' => '<img src="http://pwi.perfectworld.com.my/images/{GENDER}2.png" alt="{GENDER}" title="{GENDER}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                ),
                'race'        => "Race",
                'playerclass' => "Class",
                'level'       => "Level"
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '',
                'htmlfooter' => '',
                'tbody'      => TRUE,
                'style'      => 'text-align:center'
            );
            $this->aera->addtables("toplevel", $tables, $query->result_array(), $params);
        }
        $query = $AeraDB['pwi']->query("select * FROM character_data d, dbo.character c WHERE c.id=d.playerid AND d.name NOT LIKE '%GM%' GROUP BY d.name ORDER BY c.creationdate DESC LIMIT 0,10");
        if ($query->num_rows() >= 1)
        {
            $tables = array(
                'name'        => "Name",
                'gender'      => array(
                    'name' => "Gender",
                    'html' => '<img src="http://pwi.perfectworld.com.my/images/{GENDER}2.png" alt="{GENDER}" title="{GENDER}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
                ),
                'race'        => "Race",
                'playerclass' => "Class",
                'exp'         => "Experience"
            );
            $params = array(
                'limit'      => 10,
                'showid'     => TRUE,
                'htmlheader' => '',
                'htmlfooter' => '',
                'tbody'      => TRUE,
                'style'      => 'text-align:center'
            );
            $this->aera->addtables("topnew", $tables, $query->result_array(), $params);
        }
        $AeraDB['pwi']->Close();

        //BEGIN REGISTRATION FOR RYL2
        //$result1 = $AeraDB['pwi']->query("");
        //$result2 = $AeraDB['ryl']->query("");
        //$result3 = $AeraDB['www']->query("DELETE FROM mybb_users WHERE uid >= 5 AND salt!='AERA';");


        //Please set your template below
        $designpath = "home";
        $designfile = "home";
        $designtype = "htm";

        //// Introduction of Loadpage and arrays
        $inputs          = array(); //This variable must be declared as ARRAY()
        $inputs["CACHE"] = time();

        $inputs["LEFT"]   = "Loading...";
        $inputs["CHATS"]  = "Loading...";
        $inputs["POSTER"] = "Loading...";
        $inputs["NEWS"]   = "Loading...";
        $inputs["RIGHT"]  = "Loading...";

        //XML from FB
        ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
        $rssUrl = "http://www.facebook.com/feeds/page.php?id=302975109845737&format=rss20";
        $xml    = simplexml_load_file($rssUrl); // Load the XML file
        $entry  = $xml->channel->item;

        //Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
        $this->aera->page($designpath, $designfile, $designtype);

        //NEWS
        $i = 0;
        while ($i < 6)
        {
            if ($entry[$i]->author == "Aera Gaming International")
            {
                $fbxml = array(
                    "TITLE"  => $entry[$i]->title,
                    "LINK"   => $entry[$i]->link,
                    "DESC"   => $entry[$i]->description,
                    "DATE"   => $entry[$i]->pubDate,
                    "AUTHOR" => $entry[$i]->author
                );
                //<li><a href="http://tera.perfectworld.com.my/?/Maintenance" title="" target="_blank">-!</a></li>
                $this->aera->push('ONLINE', '<li><a href="' . $fbxml['LINK'] . '" title="" target="_blank">' . $fbxml['TITLE'] . '</a></li>');
                $i++;
            }
        }
        $rssUrl = "http://www.facebook.com/feeds/page.php?id=615844485134918&format=rss20";
        $xml    = simplexml_load_file($rssUrl); // Load the XML file
        $entry  = $xml->channel->item;

        //NEWS
        $i = 0;
        while ($i < 6)
        {
            if ($entry[$i]->author == "Tera Online : Aera Malaysia International")
            {
                $fbxml = array(
                    "TITLE"  => $entry[$i]->title,
                    "LINK"   => $entry[$i]->link,
                    "DESC"   => $entry[$i]->description,
                    "DATE"   => $entry[$i]->pubDate,
                    "AUTHOR" => $entry[$i]->author
                );
                //<li><a href="http://tera.perfectworld.com.my/?/Maintenance" title="" target="_blank">-!</a></li>
                $this->aera->push('OFFLINE', '<li><a href="' . $fbxml['LINK'] . '" title="" target="_blank">' . $fbxml['TITLE'] . '</a></li>');
                $i++;
            }
        }


        //NOTICES from TERA
        $rssUrl = "http://www.facebook.com/feeds/page.php?id=615844485134918&format=rss20";
        $xml    = simplexml_load_file($rssUrl); // Load the XML file
        $entry  = $xml->channel->item;

        //NEWS
        $i = 0;
        while ($i < 10)
        {
            if ($entry[$i]->author == "Tera Online : Aera Malaysia International")
            {
                $fbxml = array(
                    "TITLE"     => $entry[$i]->title,
                    "LINK"      => $entry[$i]->link,
                    "DESC"      => $entry[$i]->description,
                    "DATE"      => $entry[$i]->pubDate,
                    "AUTHOR"    => $entry[$i]->author,
                    "PIC"       => '',
                    "FIRST"     => '',
                    "TEXT"      => '',
                    "REALTITLE" => ''
                );

                $_msg               = explode('<br /> <br /> ', $fbxml['DESC']);
                $fbxml['REALTITLE'] = $_msg[0];
                $fbxml['TEXT']      = $_msg[1];

                if (strpos(strtoupper($fbxml['REALTITLE']), "EVENT") !== false)
                {
                    $fbxml['REALTITLE'] = str_replace("EVENT:", "", strtoupper($fbxml['REALTITLE']));
                    $fbxml['PIC']       = 'index/6-1312311122180-L.jpg';
                }
                else if (strpos(strtoupper($fbxml['REALTITLE']), 'PATCH') !== false)
                {
                    $fbxml['REALTITLE'] = str_replace('PATCH:', '', strtoupper($fbxml['REALTITLE']));
                    $fbxml['PIC']       = 'index/7-1401061K6430-L.jpg';
                }
                else if (strpos(strtoupper($fbxml['REALTITLE']), 'SURVEY') !== false)
                {
                    $fbxml['REALTITLE'] = str_replace('SURVEY:', '', strtoupper($fbxml['REALTITLE']));
                    $fbxml['PIC']       = 'index/survey160x120.jpg';
                }
                else //NOTE
                {
                    $fbxml['REALTITLE'] = strtoupper($fbxml['REALTITLE']);
                    $fbxml['PIC']       = 'index/Note160x120.jpg';
                }

                if ($i >= 1)
                    $fbxml['FIRST'] = '';
                else
                    $fbxml['FIRST'] = ' class="on"';
                $fbxml['REALTITLE'] = str_replace("/l.php?u=","",$fbxml['REALTITLE']);
                $fbxml['TEXT'] = str_replace("/l.php?u=","",$fbxml['TEXT']);
                //<li><a href="http://tera.perfectworld.com.my/?/Maintenance" title="" target="_blank">-!</a></li>
                $this->aera->addviews('NOTICE', 'notice', $fbxml);
                $i++;
            }
        }
        //FORUM
        /*$query = $AeraDB['www']->query("select * from mybb_posts ORDER BY pid DESC LIMIT 0,12");
        if ($query->num_rows() >= 1)
        {
            foreach ($query->result_array() as $row)
            {
                $prow['link']		= "http://forum.perfectworld.com.my/showthread.php?tid=".$row['tid']."&action=lastpost";
                $prow['title']		= $row['subject'];
                $this->aera->addviews("left", "left", $prow);
            }
        }*/
        //abs(ip2long($_SERVER[REMOTE_ADDR]))
        //CLOSE THE DATABASES
        //$AeraDB['pwi']->Close();
        //$AeraDB['ryl']->Close();
        $this->aera->push($inputs);
        $AeraDB['www']->Close();

        $this->data['content'] = $this->aera->loadpage();
        $this->load->vars($this->data);
        $this->load->view('page');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */