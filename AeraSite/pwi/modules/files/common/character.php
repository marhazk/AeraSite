<?php
define('BASEPATH', '/');
include "/home/content/09/12012109/html/domains/perfectworld.com.my/application/libraries/Aera.php";
$aera   = new Aera();
$rid    = $_REQUEST['rid'];
$limits = 20;
$aera->push('CONTENT', "<HR>");
//Top Rank
$query = mysql_query("select * FROM roles WHERE roleid=$rid LIMIT 0,1");
if ($query)
{
    $tables = array(
        name             => "Character Name",
        race             => "Race",
        gender           => "Gender",
        create_time      => "Last Created Time",
        lastlogin_time   => "Last Logged In Time",
        'level'            => "Level",
        exp              => "Experiences",
        sp               => "Skill Points",
        skills_size      => "Skills Level",
        hp               => "Hit Point",
        mp               => "Magic Point",
        posx             => "Position X",
        posy             => "Position Y",
        posz             => "Position Z",
        pariah_time      => "PK Point",
        money            => "Pocket Money",
        storehouse_money => "Bank Money",
        reputation       => "Reputation",
        vitality         => "Vitality",
        energy           => "Inteligence",
        strength         => "Strength",
        agility          => "Agility",
        max_hp           => "Max HP",
        max_mp           => "Max MP",

        hp_gen           => "HP Generating Speeds",
        mp_gen           => "MP Generating Speeds",
        walk_speed       => "Walk Speeds",
        run_speed        => "Run Speeds",
        swim_speed       => "Swim Speeds",
        flight_speed     => "Flight Speeds",
        damage_low       => "Damage Low",
        damage_high      => "Damage High",
        attack_speed     => "Attack Speeds",
        attack_range     => "Attack Range",
        attack           => "Attack Level",
        defense          => "Defences Level"
    );
    $params = array(
        'limit'       => $limits,
        'showid'      => TRUE,
        'htmlheader'  => '<h1>Character Info</h1>',
        'htmlfooter'  => '',
        'bgcolor'     => '#FFFFFF',
        'border'      => 1,
        'cellpadding' => 3,
        'cellspacing' => 0,
        'column'      => 2
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