<?php
	//bb_topics > topic_last_post_subject / topic_title : VARCHAR
	//bb_topics > forum_id : INT (6: General 27: Beginner 28: Features)
	//bb_topics > topic_type :INT (0: normal 1: sticky)
	//bb_topics > topic_time : BIGINT
	//bb_topics > topic_last_post_time : BIGINT
	//bb_topics > topic_id : INT (primary key)

		for ($fnum = 0; $fnum < 7; $fnum++)
		{
			$na = "Not Available at the moment ...................."; //44 + 3
			$body[qa] .= '<tr><td><a href="http://forum.perfectworld.com.my/" title="'.$na.'">'.$na.'</a></td><td>[GENERAL]</td></tr>';
		}
	
		for ($fnum = 0; $fnum < 7; $fnum++)
		{
			$na = "[Report] Not Available at the moment"; //33 + 3
			$body[ts] .= '<tr><td><a href="http://forum.perfectworld.com.my" title="'.$na.'">'.$na.'</a></td><td> [03-10]</td></tr>';
		}

?>