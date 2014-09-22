<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//
/*
 * v3 - 2014-02-07 : Add REPLACE function for addtables()
// v2 - 2014-01-?? : Add TBODY function for addtables()
// fully originally written by Marhazli / marhazk ... marhazk@yahoo.com
*/
class Aera
{
    public $_errmsg = "";
    public $_msg = "";
    public $_oplink = "";
    public $_array = NULL;
    public $dbvalue = array();
    public $path = NULL;
    public $filename = "index";
    public $type = "htm";

    var $menu = "";
    var $subenu = "";
    var $chkcontent = false;
    var $chkheader = false;
    var $chkfooter = false;
    var $content = NULL;
    var $header = NULL;
    var $footer = NULL;

    public function __construct()
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        //parent::__construct();
    }

    function Test()
    {
        echo "This is successfully tested";
    }

    function errmsg($val)
    {
        $this->_errmsg = $val;
    }

    function msg($val)
    {
        $this->_msg = $val;
    }

    function oplink($val)
    {
        $this->_oplink = $val;
    }

    function oppage($link)
    {
        $link = strtolower($link);
        if (strtolower($this->op) == $link)
            return true;
        else
            return false;
    }

    function chk($val, $lenmin = 4, $lenmax = 10, $regrex = true)
    {
        // chk("TEST")
        // chk("TEST", 4)
        // chk("TEST", 4, 10)
        // chk("TEST", 4, 10, true)
        if (($lenmax >= 1) && ((strlen($val) < $lenmin) || (strlen($val) > $lenmax)))
            return false;
        else if (($regrex) && (!(preg_replace("((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})", $val))))
            return false;
        else
            return true;
    }

    function setarray($array)
    {
        $this->_array = $array;
    }

    function inpost()
    {
        $temp = "";
        if (is_array($this->_array))
        {
            $array = $this->_array;
            foreach ($array as $key => $val)
            {
                $temp .= '<input type=hidden name="' . $key . '" value="' . $val . '">' . chr(10) . chr(13);
            }
        }
        return $temp;
    }

    function logger($msg)
    {
        $time   = time();
        $result = mysql_query("INSERT INTO ae_activities (adate, amsg) VALUES ('" . $time . "', '" . $msg . "');");
        //$result = $db->query("INSERT INTO (adate, amsg) VALUES ('".$time."', '".$msg."');");
    }

    function loggerdb($db, $msg)
    {
        $time   = time();
        $result = $db->query("INSERT INTO ae_activities (adate, amsg) VALUES ('" . $time . "', '" . $msg . "');");
        //$result = $db->query("INSERT INTO (adate, amsg) VALUES ('".$time."', '".$msg."');");
    }

    function loggerdl($msg)
    {
        $time   = time();
        $result = file_get_contents("http://www.perfectworld.com.my/?/Accounts/Logger?dl=1&q=" . $msg);
        //$result = $db->query("INSERT INTO (adate, amsg) VALUES ('".$time."', '".$msg."');");
    }

    function toparams($array, $attr = array(NULL, NULL))
    {
        $_array = array();
        $num    = 0;
        foreach ($array as $row)
        {
            $_array[$num]                 = array();
            $_array[$num][$row[$attr[0]]] = $row[$attr[1]];
            $num++;
        }
        return $_array;
    }

    function addtables($name, $attr = NULL, $array = NULL, $params = NULL)
    {
        $num      = 0;
        $total    = count($attr);
        $newarray = array();
        //Default Tables Vars
        $Default['limit']       = 100;
        $Default['showid']      = FALSE;
        $Default['htmlheader']  = '';
        $Default['htmlfooter']  = '';
        $Default['style']       = '';
        $Default['showidatt']   = 'DefaultID';
        $Default['showidval']   = '#';
        $Default['prevnext']    = FALSE;
        $Default['width']       = "100%";
        $Default['border']      = 0;
        $Default['bgcolor']     = NULL;
        $Default['cellpadding'] = NULL;
        $Default['cellspacing'] = NULL;
        $Default['tbody']       = FALSE;
        //$Default['replace']     = FALSE;
        $Default['replace'] = array(
            0 => array(
                'findatt' => 'roleid',
                'findval' => '1062',
                'repatt'  => 'level',
                'repval'  => '101'
            )
        );
        $Default['column']  = 0;

        //Params
        if (is_array($params))
        {
            foreach ($params as $pkey => $pval)
            {
                $Default[$pkey] = $pval;
            }
        }
        //Assign Attribute Names
        //$newarray[$num] = $attr;
        if ($Default['showid'])
        {
            $newarray[$num][$Default['showidatt']] = $Default['showidval'];
        }
        foreach ($attr as $key => $val)
        {
            if (is_array($val))
            {
                $newarray[$num][$key] = $val['name'];
            }
            else
            {
                $newarray[$num][$key] = $val;
            }
        }

        //Replace
        $replaceid = 0;
        if (is_array($Default['replace']))
        {
            /*
             * array {
             *      [N] {
             *          find,
             *          val,
             *          targetatt,
             *          targetval
             *      }
             * }
            */
            $Replace['findatt'] = array();
            $Replace['findval'] = array();
            $Replace['repatt']  = array();
            $Replace['repval']  = array();
        }
        //Assign Row Values
        $num++;
        foreach ($array as $data)
        {
            if ($Default['showid'])
            {
                $newarray[$num][$Default['showidatt']] = $num;
            }

            $replacerow  = false;
            $replacedata = array();
            //Find if Replaced or not
            if (is_array($Default['replace']))
            {
                foreach ($data as $_rowkey => $_rowval) // key and value per ROW
                {
                    foreach ($Default['replace'] as $replace)
                    {
                        if (strtoupper($replace['findatt']) == strtoupper($_rowkey))
                        {
                            if (strtoupper($replace['findval']) == strtoupper($_rowval))
                            {
                                $replacerow  = true; //FOUND targetted ROW that need to be replace during processing
                                $replacedata = $replace;
                            }
                        }
                    }
                }
            }
            foreach ($data as $rowkey => $rowval) // PROCESSING key and value per ROW
            {
                if (isset($attr[$rowkey]))
                {
                    if (is_array($attr[$rowkey])) //will be listing in output
                    {

                        //Replace the data first
                        if (!((is_array($attr[$rowkey]['type'])) || (is_array($attr[$rowkey]['list']))) && (($replacerow) && (strtoupper($replacedata['repatt']) == strtoupper($rowkey))))
                        {
                            $rowval = $replacedata['repval'];
                        }

                        //Find First
                        if ((is_array($attr[$rowkey]['type'])) || (is_array($attr[$rowkey]['list'])))
                        {
                            foreach ($attr[$rowkey]['type'] as $hashkey => $hashval)
                            {
                                $rowval = str_replace($hashkey, $hashval, $rowval);
                            }
                            $newarray[$num][$rowkey] = $rowval;
                        }
                        else if ($attr[$rowkey]['type'] == "TIME")
                        {
                            $newarray[$num][$rowkey] = $this->gendate($rowval);
                        }
                        else if ($attr[$rowkey]['type'] == "INT")
                        {
                            $newarray[$num][$rowkey] = (int)($rowval);
                        }
                        else
                        {
                            $newarray[$num][$rowkey] = $rowval;
                        }

                        //If HTML option is detected
                        if (isset($attr[$rowkey]['html']))
                        {
                            foreach ($newarray[$num] as $htmlkey => $htmlval)
                            {
                                $newarray[$num][$rowkey] = str_replace("{" . strtoupper($htmlkey) . "}", $htmlval, $attr[$rowkey]['html']);
                                foreach ($data as $_vatt => $_vval)
                                {
                                    $newarray[$num][$rowkey] = str_replace("{" . strtoupper($_vatt) . "}", $_vval, $newarray[$num][$rowkey]);
                                }
                            }
                        }


                    }
                    else
                    {
                        if (($replacerow) && (strtoupper($replacedata['repatt']) == strtoupper($rowkey)))
                        {
                            $rowval = $replacedata['repval'];
                        }
                        $newarray[$num][$rowkey] = $rowval;
                    }
                }
            }
            if ($num >= $Default['limit'])
                break;
            $num++;
        }
        $this->_addtables($name, $newarray, $Default);
    }

    function _addtables($name, $array = NULL, $params = NULL)
    {
        // $array[index][values]
        // index = 0 = KEY
        // index = 1+ = ROWS
        $totalRows = count($array);
        $totalAttr = count($array[0]);
        $rowsNum   = 0;
        $colsNum   = 0;
        $colsTotal = (int)($params['column']);
        $page      = "";
        if (strlen($params['htmlheader']) >= 1)
            $page .= $params['htmlheader'];
        $page .= '<table width=' . $params['width'] . ' border=' . $params['border'] . ' bgcolor="' . $params['bgcolor'] . '" cellpadding="' . $params['cellpadding'] . '" cellspacing="' . $params['cellspacing'] . '"  style="' . $params['cellspacing'] . '" >';
        if ($colsTotal >= 1)
        {
            $colIndex = 0;
            foreach ($array[0] as $attr)
            {
                if ($colsNum == 1)
                    $page .= "<TR>";
                $attrbar = array("<TD><B>", "</B></TD>");
                $valbar  = array("<TD>", "</TD>");
                //$page .= $attrbar[0] . $attr . $attrbar[1] . $valbar[0]. $array[1][$colIndex] . $valbar[1];
                $page .= $attrbar[0] . $attr . $attrbar[1];
                $rowsNum = 0;
                foreach ($array as $row)
                {
                    if ($rowsNum >= 1)
                    {
                        $rcid = 0;
                        foreach ($row as $value)
                        {
                            if ($rcid == $colIndex)
                                $page .= $valbar[0] . $value . $valbar[1];
                            $rcid++;
                        }
                    }
                    $rowsNum++;
                }
                if ($colsNum >= $colsTotal)
                {
                    $page .= "</TR>";
                    $colsNum = 0;
                }
                $colIndex++;
                $colsNum++;
            }
        }
        else
        {
            if ($params['tbody'])
                $page .= '<tbody>';
            foreach ($array as $row)
            {
                if ($rowsNum == 0)
                    $topbar = array("<B>", "</B>");
                else
                    $topbar = array(NULL, NULL);

                $page .= "<TR>";
                foreach ($row as $value)
                {
                    if (($rowsNum == 0) && ($params['tbody']))
                        $page .= "<TH>";
                    else
                        $page .= "<TD>";
                    $page .= $topbar[0] . $value . $topbar[1];
                    if (($rowsNum == 0) && ($params['tbody']))
                        $page .= "</TH>";
                    else
                        $page .= "</TD>";
                }
                $page .= "</TR>";
                $rowsNum++;
            }
            if ($params['tbody'])
                $page .= '</tbody>';
        }
        $page .= "</table>";

        if (strlen($params['htmlfooter']) >= 1)
            $page .= $params['htmlfooter'];

        $dbvalue[strtoupper($name)] = $page;
        $this->push($dbvalue);
    }

    function views($file, $array)
    {
        ob_start();
        include "./application/views/designs/" . $file;
        $_file = ob_get_clean();
        return $this->ob_replace($_file, $array);
    }

    function addviews($name, $filename, $array = NULL)
    {
        $file  = $this->path;
        $file2 = $this->filename;
        $type  = $this->type;
        if (is_array($array))
        {
            ob_start();
            if (file_exists($file . "/" . $file2 . "." . $filename . "." . $type))
                include $file . "/" . $file2 . "." . $filename . "." . $type;
            else if (file_exists($file . "/" . $filename . "." . $type))
                include $file . "/" . $filename . "." . $type;
            else if (file_exists("application/views/designs/" . $filename . "." . $type))
                include "application/views/designs/" . $filename . "." . $type;
            $_file = ob_get_clean();
            //$_file = file_get_contents("./".$file."/".$file2.".".$name.".".$type);

            if (is_array($array))
            {
                $dbvalue[strtoupper($name)] = $this->ob_replace($_file, $array);
            }
            else
            {
                $dbvalue[strtoupper($name)] = $_file;
            }
        }
        else
        {
            ob_start();
            if (file_exists($file . "/" . $file2 . "." . $name . "." . $type))
                include $file . "/" . $file2 . "." . $name . "." . $type;
            else if (file_exists($file . "/" . $name . "." . $type))
                include $file . "/" . $name . "." . $type;
            else if (file_exists("application/views/designs/" . $name . "." . $type))
                include "application/views/designs/" . $name . "." . $type;
            $_file = ob_get_clean();
            //$_file = file_get_contents("./".$file."/".$file2.".".$name.".".$type);
            if (is_array($filename))
            {
                $dbvalue[strtoupper($name)] = $this->ob_replace($_file, $filename);
            }
            else
            {
                $dbvalue[strtoupper($name)] = $_file;
            }
        }
        $this->push($dbvalue);
    }

    function push($value, $value2 = NULL)
    {
        if (is_array($value))
        {
            foreach ($value as $key => $val)
            {
                if (is_numeric($key))
                    continue;
                else if (isset($this->dbvalue[$key]))
                {
                    $this->dbvalue[$key] .= $val;
                }
                else
                {
                    $this->dbvalue[$key] = $val;
                }
            }
        }
        else
        {
            if (isset($this->dbvalue[$value]))
            {
                $this->dbvalue[$value] .= $value2;
            }
            else
            {
                $this->dbvalue[$value] = $value2;
            }
        }
        $this->importcontent();
    }


    function _pushmenulinks($value)
    {
        foreach ($value as $key => $val)
        {

        }
    }
    function pushmenulinks($value)
    {
        foreach ($value as $val)
        {
            //MAIN
            if (is_array($val))
            {
                if (!($this->menucontainsubmenu($val)))
                {
                    foreach ($val as $sval)
                    {
                        //MAIN
                        if (is_array($sval))
                        {
                            if (!($this->menucontainsubmenu($sval)))
                            {
                                foreach ($sval as $dval)
                                {
                                    //MAIN
                                    if (is_array($dval))
                                    {
                                        if (!($this->menucontainsubmenu($dval)))
                                        {
                                            foreach ($dval as $eval)
                                            {
                                                //MAIN
                                                if (is_array($eval))
                                                {
                                                    $this->menu .= $this->pushoutlink($eval);
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $this->menu .= $this->pushoutlink($dval);
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $this->menu .= $this->pushoutlink($sval);
                            }
                        }
                    }
                }
                else
                {
                    $this->menu .= $this->pushoutlink($val);
                }
            }
        }
    }
    function pushoutlink($value)
    {
        if ((!is_array($value[0])) && (!is_array($value[1])))
        {
            return '<a href="'.$value[1].'">'.$value[0].'</a>';
        }
    }
    function menucontainsubmenu($value)
    {
        if ((count($value) >= 3) && (is_array($value[2])))
            return true;
        else
            return false;
    }

    function pushlinks($value)
    {
        foreach ($value as $key => $val)
        {
            if (is_numeric($key))
                continue;
            else if (isset($this->dbvalue[$key]))
            {
                $this->dbvalue["U" . $key] .= $val[1];
                $this->dbvalue["N" . $key] .= $val[0];
            }
            else
            {
                $this->dbvalue["U" . $key] = $val[1];
                $this->dbvalue["N" . $key] = $val[0];
            }
        }
    }
    function pushlinksOLD($value)
    {
        foreach ($value as $key => $val)
        {
            if (is_numeric($key))
                continue;
            else if (isset($this->dbvalue[$key]))
            {
                $this->dbvalue["U" . $key] .= $val[1];
                $this->dbvalue["N" . $key] .= $val[0];
            }
            else
            {
                $this->dbvalue["U" . $key] = $val[1];
                $this->dbvalue["N" . $key] = $val[0];
            }
        }
    }

    function page($path, $filename = "index", $type = "htm")
    {
        $this->path     = "application/views/designs/" . $path;
        $this->filename = $filename;
        $this->type     = $type;
        $this->importcontent();
    }

    function importcontent()
    {
        /*if ($this->chkcontent)
            $this->content = $this->getpage($this->content);
        else
            $this->content = $this->getpage("./".$this->path."/".$this->filename.".".$this->type);*/
        $this->chkcontent = TRUE;
    }

    function loadpage()
    {
        //$this->importcontent();
        return $this->getpage("./" . $this->path . "/" . $this->filename . "." . $this->type);
    }

    function loadheader()
    {
        $file = $this->path;
        $type = $this->type;
        $name = "./" . $file . "/header." . $type;
        return $this->getpage($name);
    }

    function loadfooter()
    {
        $file = $this->path;
        $type = $this->type;
        $name = "./application/views/designs/footer." . $type;
        return $this->getpage($name);
    }

    function getpage($name)
    {
        $db   = $this->dbvalue;
        $file = "";

        $page = file_get_contents($name);
        $page = str_replace("_ERROR_", $this->_errmsg, $page);
        $page = str_replace("_MSG_", $this->_msg, $page);
        $page = str_replace("_OPLINK_", $this->_oplink, $page);
        $page = str_replace("href=\"../../../../", "href=\"" . $file . "/", $page);
        $page = str_replace("src=\"../../../../", "src=\"" . $file . "/", $page);
        $page = str_replace("href=\"../../../", "href=\"" . $file . "/", $page);
        $page = str_replace("src=\"../../../", "src=\"" . $file . "/", $page);
        $page = str_replace("href=\"../../", "href=\"" . $file . "/", $page);
        $page = str_replace("src=\"../../", "src=\"" . $file . "/", $page);
        $page = str_replace("href=\"../", "href=\"" . $file . "/", $page);
        $page = str_replace("src=\"../", "src=\"" . $file . "/", $page);
        $page = str_replace("href=\"images/", "href=\"" . $file . "/images/", $page);
        $page = str_replace("src=\"images/", "src=\"" . $file . "/images/", $page);
        $page = str_replace("href=\"css/", "href=\"" . $file . "/css/", $page);
        $page = str_replace("src=\"css/", "src=\"" . $file . "/css/", $page);

        $page = str_replace("href=\"SpryAssets", "href=\"" . $file . "/SpryAssets", $page);
        $page = str_replace("src=\"SpryAssets", "src=\"" . $file . "/SpryAssets", $page);
        $page = str_replace("href=\"stylesheet", "href=\"" . $file . "/stylesheet", $page);
        $page = str_replace("src=\"js", "src=\"" . $file . "/js", $page);
        $page = str_replace("value=\"images", "value=\"" . $file . "/images", $page);
        $page = str_replace("value=\"swf", "value=\"" . $file . "/swf", $page);
        $page = str_replace("src=\"swf", "src=\"" . $file . "/swf", $page);

        if (is_array($db))
        {
            $page = $this->ob_replace($page, $db);
        }
        return $page;
    }

    function gendate($time)
    {
        return date('Y-m-d G:i:s', $time);
    }

    function ob_replace($var, $array)
    {
        if (is_array($array))
        {
            foreach ($array as $rkey => $rval)
            {
                $var = str_replace("__" . strtoupper((string)$rkey) . "__", (string)$rval, $var);
                $var = str_replace("_" . strtoupper((string)$rkey) . "_", (string)$rval, $var);
                $var = str_replace("{" . strtoupper((string)$rkey) . "}", (string)$rval, $var);
            }
        }
        return $var;
    }

    // Example how:
    // Coded by Marhazli bin Kipli
    //
    // $data = sql("TblName", ARRAY ("attr(array)", "value(array)"));
    // $data[0] =
    //
    function sql($table, $array, $option = NULL)
    {
        $sql   = "";
        $value = "";
        if (!is_array($option))
        {
            switch ($option)
            {
                case NULL:
                case '':
                case 'SELECT':
                case 'AND':
                case 'OR':
                case '&&':
                case '||':
                {
                    if (is_array($array))
                    {
                        $sql = " WHERE ";
                        foreach ($array as $key => $val)
                        {
                            if (strtoupper($option) == "OR")
                                $value .= "$key='$val' OR  ";
                            else
                                $value .= "$key='$val' AND ";
                        }
                        $value = substr($value, 0, (strlen($value) - 5));
                    }
                    else
                    {
                        $sql   = "";
                        $value = "";
                    }
                    $sql = "SELECT * FROM " . $table . "" . $sql . "" . $value;
                    break;
                }
                default:
                    {
                    foreach ($array as $key => $val)
                    {
                        if (is_array($val))
                        {
                            $sql .= "$key, ";
                            $_val    = $val[0];
                            $_valval = $val[1];
                            $value .= $_val . "(" . $_valval . "), ";
                        }
                        else
                        {
                            $sql .= "$key, ";
                            $value .= "'$val', ";
                        }
                    }
                    $value = substr($value, 0, (strlen($value) - 2));
                    $sql   = substr($sql, 0, (strlen($sql) - 2));
                    $sql   = "INSERT INTO " . $table . " (" . $sql . ") VALUES (" . $value . ");";
                    break;
                    }
            }
        }
        else
        {
            foreach ($array as $key => $val)
            {
                if (is_array($val))
                {
                    $_val    = $val[0];
                    $_valval = $val[1];
                    $sql .= "$key=" . $_val . "(" . $_valval . "), ";
                }
                else
                    $sql .= "$key='$val', ";
            }
            $sql = substr($sql, 0, (strlen($sql) - 2));
            if (is_array($option))
            {
                $_opt = "";
                foreach ($option as $key => $val)
                {
                    $_opt .= $key . "='" . $val . "' AND ";
                }
                $_opt = substr($_opt, 0, (strlen($_opt) - 5));
                $sql  = "UPDATE " . $table . " SET " . $sql . " WHERE " . $_opt . ";";
            }
            else
                $sql = "UPDATE " . $table . " SET " . $sql . ";";
        }
        return $sql;
    }
}

?>