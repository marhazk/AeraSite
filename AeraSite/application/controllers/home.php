<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function Test()
    {
        die("TESTaaDADAaadddaxa");
    }
	public function index()
	{
		//$AeraDB['pwi'] = $this->load->database("default", TRUE);
		//$AeraDB['ryl'] = $this->load->database("ryl2db", TRUE);
		$AeraDB['www'] = $this->load->database("www", TRUE);
			
		//BEGIN REGISTRATION FOR RYL2
		//$result1 = $AeraDB['pwi']->query("");
		//$result2 = $AeraDB['ryl']->query("");
		//$result3 = $AeraDB['www']->query("DELETE FROM mybb_users WHERE uid >= 5 AND salt!='AERA';");
			

		//Please set your template below
		$designpath				= "home";
		$designfile				= "home";
		$designtype				= "htm";
		
		//// Introduction of Loadpage and arrays
		$inputs = array();	//This variable must be declared as ARRAY()
		$inputs["CACHE"] = time();

		$inputs["LEFT"] = "Loading...";
		$inputs["CHATS"] = "Loading...";
		$inputs["POSTER"] = "Loading...";
		$inputs["NEWS"] = "Loading...";
        $inputs["RIGHT"] = "Loading...";
        $inputs["VISITS"] = "";
        $inputs["MOST1"] = "";
        $inputs["MOST2"] = "";
		
		//XML from FB
		/*
		ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
		$rssUrl = "http://www.facebook.com/feeds/page.php?id=302975109845737&format=rss20";
		$xml = simplexml_load_file($rssUrl); // Load the XML file
		$entry = $xml->channel->item;*/
		
		//Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
		$this->aera->page($designpath, $designfile, $designtype);
		$this->aeravars->linkhovers['MENU0'] = "current";
		$this->aera->addviews('HEADERBAR', "headerbar", $this->aeravars->linkhovers);
		$this->aera->pushlinks($this->aeravars->links);



        ////////////////////////////////////////////////////////////////
        //TOP POSTER SECTION
        ////////////////////////////////////////////////////////////////
        if (true)
        {
            $qposter = $AeraDB['www']->query("SELECT u.username as name, COUNT(p.uid) as total FROM mybb_posts p, mybb_users u WHERE u.uid=p.uid GROUP BY p.uid ORDER BY COUNT(p.uid) DESC LIMIT 0,10;");
            if ($qposter->num_rows() >= 1)
            {
                $tpnum = 0;
                $prow = array();
                foreach ($qposter->result_array() as $row)
                {
                    if ($tpnum > 0)
                        $inputs["MOST1"]	 .= ", ";
                    $inputs["MOST1"]			.= $row['name']." (".$row['total']." posts) ";
                    $tpnum++;
                }
                //$this->aera->addviews("POSTER", "home.poster", $prow);
            }
        }

        ////////////////////////////////////////////////////////////////
        //MOST PLAYER SECTION
        ////////////////////////////////////////////////////////////////
        if (true)
        {
            //COUNTRY
            $querycountry = $AeraDB['www']->query("SELECT ipcountry FROM ae_accounts GROUP BY ipcountry ORDER BY COUNT(aid) DESC;");
            $cnum = 0;
            $acprow = array();
            if ($querycountry->num_rows() >= 1)
            {
                foreach ($querycountry->result_array() as $cprow)
                {
                    if (file_exists('images/world/'.strtolower($cprow['ipcountry']).'.gif'))
                    {
                        $inputs["MOST2"]		.= '<img alt="'.$cprow['ipcountry'].'" title="'.$cprow['ipcountry'].'" style="width:20px; height:auto;" src="/images/world/'.strtolower($cprow['ipcountry']).'.gif"> ';
                    }
                }
                //$this->aera->addviews("COUNTRY", "default", $acprow);
            }
        }



        ////////////////////////////////////////////////////////////////
        //VISITORS SECTION
        ////////////////////////////////////////////////////////////////
        if (true)
        {
            //COUNTRY
            $vquery = $AeraDB['www']->query("SELECT COUNT(v.vid) as vtotal, v.vcountry FROM ae_visitors v GROUP BY v.vcountry ORDER BY COUNT(v.VID) DESC;");
            $cnum = 0;
            $vprow = array();
            if ($vquery->num_rows() >= 1)
            {
                foreach ($vquery->result_array() as $cprow)
                {
                    if (file_exists('images/world/'.strtolower($cprow['vcountry']).'.gif'))
                    {
                        $inputs["VISITS"]		.= '<img alt="'.$cprow[vtotal].' '.$cprow['vcountry'].' has visited this page" title="'.$cprow[vtotal].' '.$cprow['vcountry'].' has visited this page" style="width:20px; height:auto;" src="/images/world/'.strtolower($cprow['vcountry']).'.gif">  ';
                    }
                }
                //$this->aera->addviews("VISITS", "default", $vprow);
                //$this->aera->push($vprow);
            }
        }


        //PUSHING TO PAGE CONTENTS
		$this->aera->push($inputs);
		
		/* //NEWS
		$i = 0;
		while ($i < 3)
		{
			if ($entry[$i]->author == "Aera Gaming International")
			{
				$fbxml = array(
					"TITLE" => $entry[$i]->title,
					"LINK" => $entry[$i]->link,
					"DESC" => $entry[$i]->description,
					"DATE" => $entry[$i]->pubDate,
					"AUTHOR" => $entry[$i]->author
				);
				$this->aera->addviews("news", $fbxml);
				$i++;
			}
		}
		*/
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
		$uid = "0";
		if ($this->session->userdata('uid'))
			$uid = $this->session->userdata('uid');
		$sqlup = "INSERT INTO ae_visitors (SELECT NULL, LOWER(country2) AS vcountry, NOW() AS vdate, ".abs(ip2long($_SERVER[REMOTE_ADDR])).", '".$uid."' AS vuid FROM ae_ipcountry WHERE ipfrom<=".abs(ip2long($_SERVER[REMOTE_ADDR]))." AND ipto>=".abs(ip2long($_SERVER[REMOTE_ADDR]))." LIMIT 0,1);";
		$upresult = $AeraDB['www']->query($sqlup);
		
		//CLOSE THE DATABASES
		//$AeraDB['pwi']->Close();
		//$AeraDB['ryl']->Close();




        $AeraDB['www']->Close();

        $this->data['content'] = $this->aera->loadpage();
		$this->data['footer'] = $this->aera->loadfooter();
		$this->load->vars($this->data);
		$this->load->view('page');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */