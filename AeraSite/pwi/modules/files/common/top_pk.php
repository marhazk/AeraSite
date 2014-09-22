<?php
define('BASEPATH', '/');
include "/home/content/09/12012109/html/domains/perfectworld.com.my/application/libraries/Aera.php";
$aera   = new Aera();
$limits = 100;
$aera->push('CONTENT', "<HR>");
//Top Guilds
$query = mysql_query("select cname, f.fid, f.fname, r.roleid, r.name, fa.fid as chfid, fa.fname as chfname, ra.roleid as chroleid, ra.name as chname FROM cities c, factions f, roles r, factions fa, roles ra WHERE c.owner=f.fid AND r.roleid=f.masterid AND c.challenger=fa.fid AND ra.roleid=fa.masterid ORDER BY fa.fid DESC, f.fid DESC LIMIT 0,$limits");
if ($query)
{
    $tables = array(
        'cname'   => "City Name",
        'fname'   => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={FID}">{FNAME}</a>'
        ),
        'name'    => array(
            'name' => "Guild Master",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'chfname' => array(
            'name' => "Attacker Guild",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={CHFID}">{CHFNAME}</a>'
        ),
        'chname'  => array(
            'name' => "Attacker Guild Master",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={CHROLEID}">{CHNAME}</a>'
        ),
    );
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>List of Cities</h1>',
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
    $aera->push('CONTENT', "<HR>");
}
//Top Conquerors
$query = mysql_query("select f.*, r.*, COUNT(c.owner) as total FROM factions f, roles r, cities c WHERE r.roleid=f.masterid AND c.owner=f.fid AND f.fid!=0 GROUP BY f.fid ORDER BY COUNT(c.owner) DESC;");
if ($query)
{
    $tables = array(
        'fname'       => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={FID}">{FNAME}</a>'
        ),
        'flevel'      => "Level",
        'member_size' => "Total Members",
        'name'        => array(
            'name' => "Guild Master",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'total'       => "Total Cities"
    );
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Conquerors</h1>',
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
    $aera->push('CONTENT', "<HR>");
}
//Top PK
//$query = mysql_query("SELECT r.*, o.name AS oname, g.name as gname, p.* FROM (SELECT attacker, COUNT(attacker) AS ckills, MAX(pdate) AS pdate FROM pkmode WHERE type>=1 AND attacker >= 1 AND roleid>=1 GROUP BY attacker HAVING ( COUNT(attacker) > 0 )) AS p, roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND r.roleid=p.attacker ORDER BY p.ckills DESC LIMIT 0,$limits");
$query = mysql_query("SELECT r.*, o.name AS oname, g.name as gname, p.* FROM (SELECT attacker, COUNT(attacker) AS ckills, MAX(pdate) AS pdate FROM pkmode WHERE type>=1 AND attacker >= 1 AND roleid>=1 GROUP BY attacker HAVING ( COUNT(attacker) > 0 )) AS p, roles r, gender g, occupations o WHERE r.gender=g.id AND r.occupation=o.id AND r.userid!=32 AND r.roleid=p.attacker ORDER BY r.bounty DESC, p.ckills DESC LIMIT 0,$limits");
if ($query)
{
    $tables = array(
        'name'           => array(
            'name' => "Character Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
        'bounty' => array(
            'name' => "Bounty",
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
        'reborn'          => array(
            'name' => "CRB",
            'html' => '<img src="http://www.perfectworld.com.my/images/{REBORN}crb.gif" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'oname'          => array(
            'name' => "Class",
            'html' => '<img src="http://pwi.perfectworld.com.my/WEB-INF/img/{ONAME}.png" alt="{ONAME}" title="{ONAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'gname'          => array(
            'name' => "Gender",
            'html' => '<img src="http://pwi.perfectworld.com.my/images/{GNAME}2.png" alt="{GNAME}" title="{GNAME}" style="width:12px; height=12px; display: block; margin-left: auto; margin-right: auto;">'
        ),
        'ckills'         => "Total Kills",
        'pdate'          => "Last PvP"
    );
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Top Killers</h1>',
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
    $aera->push('CONTENT', "<HR>");
}
//Top Guild
$query = mysql_query("select f.*, r.* FROM factions f, roles r WHERE r.roleid=f.masterid AND f.fid!=0 ORDER BY f.member_size DESC");
if ($query)
{
    $tables = array(
        'fname'       => array(
            'name' => "Guild Name",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/faction&gid={FID}">{FNAME}</a>'
        ),
        'flevel'      => "Level",
        'member_size' => "Total Members",
        'name'        => array(
            'name' => "Guild Master",
            'html' => '<a target=_blank href="http://pwi.perfectworld.com.my/?op=common/character&rid={ROLEID}">{NAME}</a>'
        ),
    );
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Top Guilds</h1>',
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
    $aera->push('CONTENT', "<HR>");
}
echo $aera->dbvalue['CONTENT'];
?>