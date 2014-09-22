<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class AeraVars
	{
		public $links = array(
			"LHEADER"		=> array("Aera Gaming International", "/?/home"),
			"L01"			=> array("HOME", "/?/home"),
			"L02"			=> array("GAMES", "/?/home"),
			"L02/01"		=> array("PERFECT WORLD", "http://pwi.perfectworld.com.my"),
			"L02/01/01"		=> array("RANK", "http://ryl2.perfectworld.com.my"),
			"L02/01/02"		=> array("SCREEN SHOTS", "http://ryl2.perfectworld.com.my"),
			"L02/01/03"		=> array("FACEBOOK", "http://ryl2.perfectworld.com.my"),
			
			"L02/02"		=> array("RISK YOUR LIFE", "http://ryl2.perfectworld.com.my"),
			"L02/02/01"		=> array("RANK", "http://ryl2.perfectworld.com.my/index.php/charstat"),
			"L02/02/02"		=> array("SCREEN SHOTS", "http://ryl2.perfectworld.com.my/index.php/screenshot"),
			"L02/02/03"		=> array("FACEBOOK", "https://www.facebook.com/ryl2aera"),
			
			"L02/03"		=> array("JADE DYNASTY", "http://jd.perfectworld.com.my"),
			"L02/03/01"		=> array("RANK", "http://jd.perfectworld.com.my/"),
			"L02/03/02"		=> array("SCREEN SHOTS", "http://jd.perfectworld.com.my/"),
			"L02/03/03"		=> array("FACEBOOK", "https://www.facebook.com/aerajd"),
			
			"L02/04"		=> array("TERA ONLINE", "http://tera.perfectworld.com.my"),
			"L02/04/01"		=> array("RANK", "http://tera.perfectworld.com.my/"),
			"L02/04/02"		=> array("SCREEN SHOTS", "http://tera.perfectworld.com.my/"),
			"L02/04/03"		=> array("FACEBOOK", "https://www.facebook.com/pages/Tera-Online-Aera-Malaysia-International/615844485134918"),
			
			"L02/03"		=> array("TOP PLAYER", "http://pwi.perfectworld.com.my/?op=common/top_players"),
			"L02/04"		=> array("SCREEN SHOTS", "http://pwi.perfectworld.com.my/?op=photos"),
			"L02/05"		=> array("FACEBOOK", "https://www.facebook.com/pwmalaysia"),
			
			"L03"			=> array("MALLS", "/?/Mall"),
			"L06"			=> array("FORUM", "http://forum.perfectworld.com.my/"),
			"L04"			=> array("ACCOUNTS", "/?/Accounts"),
			"L05"			=> array("CONTACTS", "/?/Contacts"),
			
			//FOOTER SESSION
			"L/FOOTER/FB"			=> array("FB", "https://www.facebook.com/pages/Aera-Gaming-International/302975109845737"),
			"L/FOOTER/TWITTER"		=> array("TWITTER", "https://www.facebook.com/pages/Aera-Gaming-International/302975109845737"),
			"L/FOOTER/MORE"			=> array("MORE", "/?/More"),
			"L/FOOTER/TRADEMARK"	=> array("Aera Gaming International", ""),
			"L/FOOTER/AUP"			=> array("Privacy Policy", "/?/Aup")
		);
		
		//More Variables Systems
		public $sys = array(
			"ANNOUNCEMENT" 			=> "Page is currently under maintenance",
			"TEST"					=> "This is TEST"
		);
		
		public $linkhovers = array(
			'MENU0'		=> "",		//HOME
			'MENU1'		=> "",		//GAMES
			'MENU2'		=> "",		//MALLS
			'MENU3'		=> "",		//FORUM
			'MENU4'		=> "",		//ACCOUNTS
			'MENU5'		=> "",		//CONTACTS
			'MENUN'		=> ""
		);
	}
?>