
<table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" align="right" valign="top">Event ID :</td>
      <td width="70%" align="left" valign="top"><input name="eid" type="text" id="eid" size="50" value="<?php echo $_POST["eid"];?>"/></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Event Name :</td>
      <td width="70%" align="left" valign="top"><input name="name" type="text" id="name" size="50" value="<?php echo $_POST["name"];?>"/></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Enable :</td>
      <td width="70%" align="left" valign="top"><select name="enable" id="select2">
      <option value=<?php echo $_POST["enable"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["enable"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Make it Auto Event :</td>
      <td width="70%" align="left" valign="top"><select name="eauto" id="select2">
      <option value=<?php echo $_POST["eauto"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["eauto"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Server Event ID (Only professional do this) :</td>
      <td width="70%" align="left" valign="top"><select name="eidgm" id="select2">
      <option selected value="<?php echo $_POST["eidgm"];?>"><?php echo $_POST["eidgm"];?></option>
      <option value="0">-EMPTY-</option>
      <option value="999">Christmas Events</option>
      <option value="2">2 - Christmas Event (Snowmans in ADC dropping celestial stones etc)</option>
      <option value="3">3 - Santa Claus City of Ethersword Elder</option>
      <option value="4">4 - Santa Claus City of Feathers Elder</option>
      <option value="5">5 - Santa Claus City of Vanished Elder</option>
      <option value="6">6 - Santa Claus Rosalind & Eunice in Ancient Dragon City</option>
      <option value="8">8 - Activate boxes in arena (GM need to be inside to start)</option>
      <option value="999"></option>
      <option value="999">Horse Race</option>
      <option value="9">9 - Reward boxes (At start/finish line)</option>
      <option value="10">10 - Flags and start npc (Giant dog)</option>
      <option value="11">11 - Cheerleaders (And arrows and bridge)</option>
      <option value="999"></option>
      <option value="999">Communication event
      <option value="12">12 - Mailboxes (Default is set to on</option>
      <option value="13">13 - Messenger Angel Chiling</option>
      <option value="14">14 - Perfect Present Ambassador (Defauld is set to on)</option>
      <option value="999"></option>
      <option value="999">Rancor Event</option>
      <option value="66">66 - Village of the Hidden Hero rancor level 20</option>
      <option value="67">67 - Cambridge Village rancor level 20</option>
      <option value="68">68 - Bamboo Village rancor level 20</option>
      <option value="69">69 - Walled Stronghold rancor level 20</option>
      <option value="70">70 - Antiquity Entreance rancor level 20</option>
      <option value="71">71 - South Stalking Stronghold rancor level 20</option>
      <option value="72">72 - Ground of Logging rancor level 20</option>
      <option value="73">73 - Vicinage Town rancor level 20</option>
      <option value="74">74 - Barbarian Village rancor level 20</option>
      <option value="75">75 - Mirror lake rancor level 40</option>
      <option value="76">76 - Orchis Sereene rancor level 40</option>
      <option value="77">77 - Allied Army Camp rancor level 40</option>
      <option value="78">78 - Fishing Village rancor level 40</option>
      <option value="79">79 - Clan of haste rancor level 50</option>
      <option value="80">80 - Town of Forwarding wind rancor level 50</option>
      <option value="81">81 - Camp of Sumor rancor level 50</option>
      <option value="82">82 - Sundown Town rancor level 50</option>
      <option value="83">83 - Town of arriving rancor level 50</option>
      <option value="84">84 - Arrow stepping Manor rancor level 70</option>
      <option value="85">85 - City of Misfortune rancor level 70</option>
      <option value="86">86 - Fangs Town rancor level 70</option>
      <option value="87">87 - Dreaming cloud Village rancor level 70</option>
      <option value="88">88 - Whetstone Stronghold rancor level 70</option>
      <option value="89">89 - Village of the Lost rancor level 90, flying</option>
      <option value="90">90 - Town of Sanctuary rancor level 90, flying</option>
      <option value="91">91 - Notting Village rancor level 90, flying</option>
      <option value="92">92 - Reckless Beauty Village rancor level 90</option>
      <option value="93">93 - Fire bathing Village rancor level 90</option>
      <option value="94">94 - South Screen Town rancor level 90</option>
      <option value="95">95 - East Screen Town rancor level 90</option>
      <option value="96">96 - North Screen Town rancor level 90</option>
      <option value="97">97 - Expeditionary Camp rancor level 100</option>
      <option value="98">98 - Snowswept Village rancor level 100</option>
      <option value="99">99 - Shattered ice rancor level 100</option>
      <option value="100">100 - Avalanche rancor level 100</option>
      <option value="103">103 - Dream Searching Port invasion</option>
      <option value="104">104 - Thousand Stream AIR invasion</option>
      <option value="999"></option>
      <option value="999">ADC invasion events</option>
      <option value="109">109 - Start final ADC invasion wave</option>
      <option value="110">110 - Start ADC invasion wave 1</option>
      <option value="111">111 - Start ADC invasion wave 2</option>
      <option value="112">112 - Start ADC invasion wave 3</option>
      <option value="113">113 - Start ADC invasion wave 4</option>
      <option value="114">114 - ADC invasion last boss outside ADC north</option>
      <option value="117">117 - ADC invasion last boss outside ADC north</option>
      <option value="118">118 - ADC invasion last boss outside ADC west</option>
      <option value="119">119 - ADC invasion last boss outside ADC south</option>
      <option value="120">120 - ADC invasion last boss outside ADC south</option>
      <option value="121">121 - ADC invasion last bosse's Leader ADC north</option>
      <option value="125">125 - NON-AGGRO Boss inside wall by ADC north gate</option>
      <option value="126">126 - General Sorely and a line of guards outside ADC.</option>
      <option value="999"></option>
      <option value="999">New Year events</option>
      <option value="127">127 - New Year Lanterns (lamps)</option>
      <option value="128">128 - New year Boss outside ADC west</option>
      <option value="129">129 - New Year NPC's in Thousand Stream City</option>
      <option value="999"></option>
      <option value="999">Other</option>
      <option value="134">134 - Puts boxes around teleporters in main cities</option>
      </select> 
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Add-ons :</td>
      <td width="70%" align="left" valign="top">
      <select name="doubleexp" id="select2">
      <option value=<?php echo $_POST["doubleexp"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["doubleexp"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> (Double EXP)<BR />
      <select name="doublesp" id="select2">
      <option value=<?php echo $_POST["doublesp"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["doublesp"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> (Double SP)<BR />
      <select name="doubleitem" id="select2">
      <option value=<?php echo $_POST["doubleitem"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["doubleitem"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> (Double Drop Items)
      </td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Day in Month :</td>
      <td width="70%" align="left" valign="top"><select name="eday" id="select2">
      <option value=<?php echo $_POST["eday"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["eday"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
        -         Start on: 
        <select name="eday_start">
        <option selected><?php echo $_POST["eday_start"];?></option>
        <option value="">-</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
        </select> 
        
        Finish on: 
        <select name="eday_end"><option selected><?php echo $_POST["eday_end"];?></option>
        <option value="">-</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
        </select> </td>
    </tr>
<tr>
      <td width="30%" align="right" valign="top">Day in Week :</td>
      <td width="70%" align="left" valign="top"><select name="ef" id="select2">
      <option value=<?php echo $_POST["ef"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["ef"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
        -         Start on: 
        <select name="ef_start"><option selected><?php echo $_POST["ef_start"];?></option>
        <option value="">-</option>
        <option value=1>Monday</option>
        <option value=2>Tuesday</option>
        <option value=3>Wednesday</option>
        <option value=4>Thursday</option>
        <option value=5>Friday</option>
        <option value=6>Saturday</option>
        <option value=7>Sunday</option>
        </select>  
        Finish on: 
        <select name="ef_end"><option selected><?php echo $_POST["ef_end"];?></option>
        <option value="">-</option>
        <option value=1>Monday</option>
        <option value=2>Tuesday</option>
        <option value=3>Wednesday</option>
        <option value=4>Thursday</option>
        <option value=5>Friday</option>
        <option value=6>Saturday</option>
        <option value=7>Sunday</option>
        </select>  </td>
    </tr>
        <tr>
      <td width="30%" align="right" valign="top">Hours :</td>
      <td width="70%" align="left" valign="top"><select name="ehh" id="select2">
      <option value=<?php echo $_POST["ehh"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["ehh"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
        -         Start on: 
        <select name="ehh_start"><option selected><?php echo $_POST["ehh_start"];?></option>
        <option value="">-</option>
        <option value="0">0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        </select>  
        Finish on: 
        <select name="ehh_end"><option selected><?php echo $_POST["ehh_end"];?></option>
        <option value="">-</option>
        <option value="0">0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        </select>  </td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Minutes :</td>
      <td width="70%" align="left" valign="top"><select name="emm" id="select2">
      <option value=<?php echo $_POST["emm"];?> selected><?php echo str_replace("1", "Enable", str_replace("0", "Disable", $_POST["emm"]));?></option>
      <option >-</option>
      <option value=0>Disable</option>
      <option value=1>Enable</option>
      </select> 
        -         Start on: 
        <select name="emm_start"><option selected><?php echo $_POST["emm_start"];?></option>
        <option value="">-</option>
        <option value="0">0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
        <option>32</option>
        <option>33</option>
        <option>34</option>
        <option>35</option>
        <option>36</option>
        <option>37</option>
        <option>38</option>
        <option>39</option>
        <option>40</option>
        <option>41</option>
        <option>42</option>
        <option>43</option>
        <option>44</option>
        <option>45</option>
        <option>46</option>
        <option>47</option>
        <option>48</option>
        <option>49</option>
        <option>50</option>
        <option>51</option>
        <option>52</option>
        <option>53</option>
        <option>54</option>
        <option>55</option>
        <option>56</option>
        <option>57</option>
        <option>58</option>
        <option>59</option></select>
        Finish on: 
        <select name="emm_end"><option selected><?php echo $_POST["emm_end"];?></option>
        <option value="">-</option>
        <option value="0">0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
        <option>32</option>
        <option>33</option>
        <option>34</option>
        <option>35</option>
        <option>36</option>
        <option>37</option>
        <option>38</option>
        <option>39</option>
        <option>40</option>
        <option>41</option>
        <option>42</option>
        <option>43</option>
        <option>44</option>
        <option>45</option>
        <option>46</option>
        <option>47</option>
        <option>48</option>
        <option>49</option>
        <option>50</option>
        <option>51</option>
        <option>52</option>
        <option>53</option>
        <option>54</option>
        <option>55</option>
        <option>56</option>
        <option>57</option>
        <option>58</option>
        <option>59</option></select>
</td>
    </tr>    <tr>
      <td width="30%" align="right" valign="top">Broadcast Message :</td>
      <td width="70%" align="left" valign="top"><p>
        <textarea name="bmsg" cols="50" rows="10" id="bmsg"><?php echo $_POST["bmsg"];?></textarea>
      </p></td>
    </tr></table>