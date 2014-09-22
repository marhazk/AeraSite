<!-- Main -->
<div id="main">
    <div id="main-bot">
        <div class="cl">&nbsp;</div>
        <!-- Content -->
        <div id="content">

            <div class="block">
                <div class="block-bot">
                    <div class="head">
                        <div class="head-cnt">

                            <h3>Main <?php echo $title; ?></h3>

                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                    <div class="row-articles articles">
                        <div class="cl">&nbsp;</div>
                        <div class="article">
                            <div style="color: white; padding-left: 10px; padding-right: 10px">
                                <div style="padding:5px 5px 5px 5px; background:#1B1B1B"><p>Total Chars : <?php echo $t_human + $t_akkan;?><br/>
                                    Total Human : <?php echo $t_human;?><br/>
                                    Total Ak'kan : <?php echo $t_akkan;?><br/>
                                    Current Registered Accounts: <?php echo $t_acc; ?><br/>
                                </p><p>&nbsp</p><p><strong>Information : </strong>Online status is approximately 5 minutes delay.</p></div>
                                <p>&nbsp</p>
                                <table style="text-align: center; width: 100%; border: 1px solid #1B1B1B">
                                    <thead>
                                    <tr>
                                        <th
                                            style=" background-color: #a0a0a0; color: #262727">Online?
                                        </th>
                                        <th
                                            style=" background-color: #a0a0a0; color: #262727">Char
                                            Name
                                        </th>
                                        <th
                                            style="background-color: #a0a0a0; color: #262727">Level
                                        </th>
                                        <th
                                            style=" background-color: #a0a0a0; color: #262727">Nation
                                        </th>
                                        <th
                                            style=" background-color: #a0a0a0; color: #262727">Class
                                        </th>
                                        <th
                                            style=" background-color: #a0a0a0; color: #262727">Medal
                                        </th>
                                        <th
                                            style="background-color: #a0a0a0; color: #262727">Fame
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($stat as $row)
                                    {
                                        $p_class = null;
                                        $p_race = null;
                                        switch ($row->Race)
                                        {
                                            case 0:
                                                $p_race = "Human";
                                                break;
                                            case 1:
                                                $p_race = "Ak'kan";
                                                break;
                                            default:
                                                break;
                                        }

                                        switch ($row->Class)
                                        {
                                            case 1:
                                                $p_class = "Fighter";
                                                break;
                                            case 2:
                                                $p_class = "Rouge";
                                                break;
                                            case 3:
                                                $p_class = "Mage";
                                                break;
                                            case 4:
                                                $p_class = "Acolyte";
                                                break;
                                            case 5:
                                                $p_class = "Defender";
                                                break;
                                            case 6:
                                                $p_class = "Warrior";
                                                break;
                                            case 7:
                                                $p_class = "Assassin";
                                                break;
                                            case 8:
                                                $p_class = "Archer";
                                                break;
                                            case 9:
                                                $p_class = "Sorcerer";
                                                break;
                                            case 10:
                                                $p_class = "Enchanter";
                                                break;
                                            case 11:
                                                $p_class = "Priest";
                                                break;
                                            case 12:
                                                $p_class = "Cleric";
                                                break;
                                            case 17:
                                                $p_class = "Combatant";
                                                break;
                                            case 20:
                                                $p_class = "Attacker";
                                                break;
                                            case 19:
                                                $p_class = "Templar";
                                                break;
                                            case 21:
                                                $p_class = "Gunner";
                                                break;
                                            case 18:
                                                $p_class = "Officiator";
                                                break;
                                            case 22:
                                                $p_class = "Rune Ofc.";
                                                break;
                                            case 23:
                                                $p_class = "Life Ofc.";
                                                break;
                                            case 24:
                                                $p_class = "Shadow Ofc.";
                                                break;
                                            default:
                                                break;

                                        }

                                        $online = false;
                                        foreach ($o_char as $row2)
                                        {
                                            if ($row2->cid == $row->CID)
                                            {
                                                $online = true;
                                                break;
                                            }
                                        }
                                        echo "<tr>";
                                        if ($online)
                                        {
                                            echo "<td style='color: greenyellow'>ONLINE</td>";
                                        }
                                        else
                                        {
                                            echo "<td></td>";
                                        }

                                        echo "<td>" . $row->Name . "</td>";
                                        echo "<td>" . $row->Level . "</td>";
                                        echo "<td>" . $p_race . "</td>";
                                        echo "<td>" . $p_class . "</td>";
                                        echo "<td>" . $row->Medal . "</td>";
                                        echo "<td>" . $row->Fame . "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }

                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="cl">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>

