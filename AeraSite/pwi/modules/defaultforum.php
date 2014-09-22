<?php
//bb_topics > topic_last_post_subject / topic_title : VARCHAR
//bb_topics > forum_id : INT (6: General 27: Beginner 28: Features)
//bb_topics > topic_type :INT (0: normal 1: sticky)
//bb_topics > topic_time : BIGINT
//bb_topics > topic_last_post_time : BIGINT
//bb_topics > topic_id : INT (primary key)
//DELETE FROM bb_users WHERE aerauser=0;
//DELETE FROM bb_user_group WHERE aerauser=0;
//DELETE FROM bb_posts WHERE aerauser=0;
//DELETE FROM bb_topics WHERE aerauser=0;
//UPDATE bb_users SET aerauser=1;
//
//
//DELETE FROM bb_users WHERE user_id>=75;# MySQL returned an empty result set (i.e. zero rows).
//DELETE FROM bb_user_group WHERE user_id>=75;# MySQL returned an empty result set (i.e. zero rows).
//DELETE FROM bb_posts WHERE poster_id>=75;# MySQL returned an empty result set (i.e. zero rows).
//DELETE FROM bb_topics WHERE topic_poster>=75;# MySQL returned an empty result set (i.e. zero rows).
//UPDATE bb_users SET aerauser=1;# 74 row(s) affected.

//SELECT * FROM bb_users, bb_posts, bb_topics, bb_user_group WHERE bb_users.aerauser=0 AND bb_users.user_id=bb_posts.poster_id AND bb_users.user_id=bb_user_group.user_id AND bb_users.user_id=bb_topics.topic_poster GROUP BY bb_users.user_id

//SELECT * FROM bb_users, bb_posts, bb_topics, bb_user_group WHERE bb_users.aerauser=0 AND bb_posts.poster_id=bb_users.user_id AND bb_user_group.user_id=bb_users.user_id AND bb_topics.topic_poster=bb_users.user_id GROUP BY bb_users.aerauser

$delonTime = time() * (60 * 60 * 24 * 7);
//$fsqldel = mysql_query("DELETE FROM bb_users, bb_posts, bb_topics, bb_user_group WHERE bb_users.aerauser=0 AND bb_users.user_id=bb_posts.poster_id AND bb_users.user_id=bb_user_group.user_id AND bb_users.user_id=bb_topics.topic_poster AND bb_posts.post_time>='".$delonTime."' AND GROUP BY bb_users.user_id", $forumconn);
//$fsql = mysql_query("SELECT * FROM bb_topics WHERE (forum_id = 6 OR forum_id = 27 OR forum_id = 28 or forum_id = 33) ORDER BY topic_id DESC LIMIT 0,7", $forumconn);
$fsql = mysql_query("select p.*, u.username from (SELECT * FROM mybb_posts ORDER BY pid DESC) as p, mybb_users u WHERE u.uid=p.uid GROUP BY p.fid ORDER BY p.pid DESC LIMIT 0,7;", $forumconn);

$body[qa] = "";
if ($fsql)
{
    while ($frow = mysql_fetch_array($fsql))
    {
        /*$body[title] = $frow[topic_title];
        $na          = "Not Available at the moment ...................."; //44 + 3
        if (strlen($body[title]) >= 40)
            $body[title] = substr($body[title], 0, 40) . "...";
        if ($frow[forum_id] == 6)
            $body[type] = "General";
        if ($frow[forum_id] == 33)
            $body[type] = "Fixes";
        if ($frow[forum_id] == 27)
            $body[type] = "Beginner";
        if ($frow[forum_id] == 28)
            $body[type] = "Feature";
        $body[qa] .= '<tr><td><a href="http://forum.perfectworld.com.my/viewtopic.php?f=' . $frow[forum_id] . '&t=' . $frow[topic_id] . '" title="' . $frow[topic_title] . '">' . $body[title] . '</a></td><td>[' . $body[type] . ']</td></tr>';
        */
        //$body[qa] .= '<tr><td><a href="http://www.perfectworld.my/viewtopic.php?f='.$frow[forum_id].'&t='.$frow[topic_id].'" title="'.$frow[topic_title].'">Temporary Disabled</a></td><td>['.$body[type].']</td></tr>';
        $body[title] = $frow[subject];
        //date('l jS \of F Y h:i:s A',$uWeb_rinfo["lastlogin"])
        $na             = "[Report] Not Available at the moment"; //9 + 24 + 3
        $body[datetime] = date('m-d', $frow["dateline"]);
        if (strlen($body[title]) >= 33)
            $body[title] = substr($body[title], 0, 33) . "...";
        $body[qa] .= '<tr><td><a href="http://forum.perfectworld.com.my/showthread.php?tid=' . $frow[tid] . '&action=lastpost" title="[Report] ' . $frow[topic_title] . '">[REPORT] ' . $body[title] . '</a></td><td>['.$body[datetime].']</td></tr>';
    }
}

$fsql     = mysql_query("select * from ae_activities WHERE ((amsg not Like '%test%') AND (amsg not Like '%:LOG%') AND (amsg not Like '%quest%') AND (amsg not Like '%logged in%') AND (amsg not Like '%admin%') AND (amsg not Like 'gm%')) and ((vstr1 not Like '%test%' AND vstr1 not Like 'admin' AND vstr1 not Like 'admin%' AND vstr1 not Like 'gm%')) ORDER BY aid DESC LIMIT 0,7;", $forumconn);
//$fsql     = mysql_query("SELECT * FROM bb_topics WHERE (forum_id != 6 AND forum_id != 27 AND forum_id != 28 AND forum_id != 33) ORDER BY topic_id DESC LIMIT 0,7", $forumconn);
$body[ts] = "";
if ($fsql)
{
    while ($frow = mysql_fetch_array($fsql))
    {
        //date('l jS \of F Y h:i:s A',$uWeb_rinfo["lastlogin"])
        $na             = "[Report] Not Available at the moment"; //9 + 24 + 3
        $feeds['text'] = "";
        if ($frow['amsg'] == "PW:LOGIN")
            $feeds['text']	= $frow['vstr1']." just logged in PWI";
        else if ($frow['amsg'] == "REGISTER")
            $feeds['text']	= $frow['vstr1']." just registered an account.";
        else if ($frow['amsg'] == "PW:LOGOUT")
            $feeds['text']	= $frow['vstr1']." just logged out from PWI";
        else
            $feeds['text']	= $frow['amsg'];

        if (strlen($feeds['text']) >= 33)
            $feeds['text'] = substr($feeds['text'], 0, 45) . "...";
        $body[ts] .= '<tr><td>' . $feeds['text'] . '</td><td></td></tr>';
        //$body[ts] .= '<tr><td><a href="http://www.perfectworld.my/viewtopic.php?f='.$frow[forum_id].'&t='.$frow[topic_id].'" title="[Report] '.$frow[topic_title].'">[REPORT] Temporary Disabled</a></td><td> ['.$body[datetime].']</td></tr>';
    }
}
?>