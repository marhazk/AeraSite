<?php
//$swfwidth = 370;
//$swfheight = 400;
$swfwidth = 600;
$swfheight = 649;
?>
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="<?=$swfwidth?>" height="<?=$swfheight?>" id="zoom" align="middle">
        <param name="allowScriptAccess" value="always" />
        <param name="allowFullScreen" value="false" />
        <param name="movie" value="images/zoomlocal.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#666666" />
        <embed src="images/zoomlocal.swf" quality="high" bgcolor="#666666" width="<?=$swfwidth?>" height="<?=$swfheight?>" name="zoom" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
    </object><br><p align=center><a href="images/zoomlocal.swf">Run FullScreen</a></p>
<?php
define('BASEPATH', '/');
include "/home/content/09/12012109/html/domains/perfectworld.com.my/application/libraries/Aera.php";
$aera   = new Aera();
$limits = 20;
$aera->push('CONTENT', "<HR>");
$textcrb = '
<BR><B>CRB Keyword</b>
<BR><img src="http://www.perfectworld.com.my/images/3crb.gif" style="width:12px; height=12px;"> - 3x Damages/Defenses System + BP
<BR><img src="http://www.perfectworld.com.my/images/4crb.gif" style="width:12px; height=12px;"> - 4x Damages/Defenses System + BP
<BR><img src="http://www.perfectworld.com.my/images/5crb.gif" style="width:12px; height=12px;"> - 5x Damages/Defenses System + BP
<BR><img src="http://www.perfectworld.com.my/images/6crb.gif" style="width:12px; height=12px;"> - 6x Damages/Defenses System + BP
<BR><img src="http://www.perfectworld.com.my/images/7crb.gif" style="width:12px; height=12px;"> - 7x Damages/Defenses System + BP
    ';

//Top Rank
$query = mysql_query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.battlepower DESC, r.level DESC, r.reputation DESC LIMIT 0,$limits");
if ($query)
{
    $tables = array(
        'name'           => array(
            'name' => "Character Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME} <img src="http://www.perfectworld.com.my/images/{ONLINE2}online.gif" style="width:10px; height=10px;"></a>'
        ),
        'level'          => array(
            'name' => "Level",
            'type' => 'INT'
        ),
        'battlepowerlvl' => array(
            'name' => "BP Level (EXP)",
            'html' => '{BATTLEPOWERLVL} ({BATTLEPOWERPCT}%)'
        ),
        'reborn'         => array(
            'name' => "CRB",
            'html' => '<img src="http://www.perfectworld.com.my/images/{REBORN}crb.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'guildname'      => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={GUILDID}">{GUILDNAME}</a>'
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
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Top Players (ALL)</h1>',
        'htmlfooter'  => '',
        'bgcolor'     => '#FFFFFF',
        'border'      => 1,
        'cellpadding' => 3,
        'cellspacing' => 0
    );
    $values = array();
    while ($row = mysql_fetch_array($query))
    {
        $values[] = $row;
    }
    $aera->addtables("content", $tables, $values, $params);
    $aera->push('CONTENT', $textcrb);
    $aera->push('CONTENT', "<HR>");
}
//BattlePowersLVL
$query4 = mysql_query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.battlepowerlvl DESC LIMIT 0,$limits");
if ($query4)
{
    $replace      = array(
        0 => array(
            'findatt' => 'NULL',
            'findatt' => 'NULL',
            'findatt' => 'NULL',
            'findatt' => 'NULL'
        )
    );
    $tables4      = array(
        'name'           => array(
            'name' => "Character Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'battlepowerlvl' => array(
            'name' => "BP Level",
            'type' => 'INT'
        ),
        'battlepowerpct' => array(
            'name' => "BP Exp",
            'html' => '{BATTLEPOWERPCT}%'
        ),
        'reborn'         => array(
            'name' => "CRB",
            'html' => '<img src="http://www.perfectworld.com.my/images/{REBORN}crb.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'guildname'      => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={GUILDID}">{GUILDNAME}</a>'
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
    $params4      = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Top BattlePowers Level</h1>',
        'htmlfooter'  => '',
        'bgcolor'     => '#FFFFFF',
        'border'      => 1,
        'cellpadding' => 3,
        'cellspacing' => 0
    );
    $query4values = array();
    while ($row = mysql_fetch_array($query4))
    {
        $query4values[] = $row;
    }
    $aera->addtables("content", $tables4, $query4values, $params4);
    $aera->push('CONTENT', "<HR>");
}
//CELESTIAL REBORN
$query4 = mysql_query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND r.reborn>=1 ORDER BY r.battlepowerlvl DESC LIMIT 0,$limits");
if ($query4)
{
    $tables4      = array(
        'name'           => array(
            'name' => "Character Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'level'          => array(
            'name' => "Level",
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
        'guildname'      => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={GUILDID}">{GUILDNAME}</a>'
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
    $params4      = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Top Celestial Reborn</h1>',
        'htmlfooter'  => '',
        'bgcolor'     => '#FFFFFF',
        'border'      => 1,
        'cellpadding' => 3,
        'cellspacing' => 0
    );
    $query4values = array();
    while ($row = mysql_fetch_array($query4))
    {
        $query4values[] = $row;
    }
    $aera->addtables("content", $tables4, $query4values, $params4);
    $aera->push('CONTENT', "<HR>");
}

//New Character
$query5 = mysql_query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.create_time DESC LIMIT 0,$limits");
if ($query5)
{
    $tables5      = array(
        'name'           => array(
            'name' => "Character Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'create_time'    => "Created Time",
        'level'          => array(
            'name' => "Level",
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
        'reborn'         => array(
            'name' => "CRB",
            'html' => '<img src="http://www.perfectworld.com.my/images/{REBORN}crb.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'guildname'      => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={GUILDID}">{GUILDNAME}</a>'
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
    $params5      = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>New Characters</h1>',
        'htmlfooter'  => '',
        'bgcolor'     => '#FFFFFF',
        'border'      => 1,
        'cellpadding' => 3,
        'cellspacing' => 0
    );
    $query5values = array();
    while ($row = mysql_fetch_array($query5))
    {
        $query5values[] = $row;
    }
    $aera->addtables("content", $tables5, $query5values, $params5);
    $aera->push('CONTENT', "<HR>");
}

if ($gmuser)
{
//Last Login
    $query6 = mysql_query("select r.*, o.name AS oname, g.name as gname from roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 ORDER BY r.lastlogin_time DESC LIMIT 0,$limits");
    if ($query6)
    {
        $tables6      = array(
            'name'           => array(
                'name' => "Character Name",
                'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
            ),
            'lastlogin_time' => "Last Login Time",
            'level'          => array(
                'name' => "Level",
                'type' => 'INT'
            ),
            'online2'        => array(
                'name' => "Online",
                'html' => '<img src="http://www.perfectworld.com.my/images/{ONLINE2}online.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
            ),
            'battlepowerlvl' => array(
                'name' => "BP Level",
                'type' => 'INT'
            ),
            'battlepowerpct' => array(
                'name' => "BP Exp",
                'html' => '{BATTLEPOWERPCT}%'
            ),
            'reborn'         => array(
                'name' => "CRB",
                'html' => '<img src="http://www.perfectworld.com.my/images/{REBORN}crb.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
            ),
            'guildname'      => array(
                'name' => "Guild Name",
                'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={GUILDID}">{GUILDNAME}</a>'
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
        $params6      = array(
            'limit'       => $limits,
            'showid'      => TRUE,
            'htmlheader'  => '<h1>Last Login Players</h1>',
            'htmlfooter'  => '',
            'bgcolor'     => '#FFFFFF',
            'border'      => 1,
            'cellpadding' => 3,
            'cellspacing' => 0
        );
        $query6values = array();
        while ($row = mysql_fetch_array($query6))
        {
            $query6values[] = $row;
        }
        $aera->addtables("content", $tables6, $query6values, $params6);
        $aera->push('CONTENT', $textcrb);
        $aera->push('CONTENT', "<HR>");
    }
}
echo $aera->dbvalue['CONTENT'];
?>