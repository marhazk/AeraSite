var sb = 0;
var sba = 0;
var sb2 = 0;
var sba2 = 0;
var getID = function(i){ return document.getElementById(i); }
function mychg(m){
    if(m>=0 && m<=100) {
	getID("lm"+m).style.display=getID("lm"+m).style.display=="block"?"none":"block";
	getID("father"+m).className=getID("father"+m).className=="off"?"on":"off";
	}
	else{
			if(getID("new_"+m).className =="new_"+m+"_on"){
					for(i=101;i<getID('new_all').getElementsByTagName('dl').length+101;i++){
					getID("new_c_"+i).style.display = "none";
					getID("new_"+i).className = "new_"+i;
					}
				}
			else{
					for(i=101;i<getID('new_all').getElementsByTagName('dl').length+101;i++){
					getID("new_c_"+i).style.display = "none";
					getID("new_"+i).className = "new_"+i;
					}
				getID("new_"+m).className = "new_"+m+"_on";
				getID("new_c_"+m).style.display="block";
				}
		}
}

function chgall(){
	t=getID("p_left").getElementsByTagName("dl").length;
getID("side_menu").innerHTML =  getID("side_menu").innerHTML=="Expand All [+]" ? "Close All [-]": "Expand All [+]";
if(getID("side_menu").innerHTML=="Expand All [+]")
{
	for(i=1;i<t+1;i++){
		getID("lm"+i).style.display = "none"
		getID("father"+i).className = "off"
		}
}
else{
		for(i=1;i<t+1;i++){
		getID("lm"+i).style.display = "block"
		getID("father"+i).className = "on"
		}
	}

}

function mychg2(m){
    if(sba2==1) {
	sbb=getID("rm"+m).style.display;
	getID("rm"+m).style.display=sbb=="none"?"block":"none";
	getID("r_title"+m).getElementsByTagName("span")[0].className=getID("r_title"+m).getElementsByTagName("span")[0].className==""?"on_tab":"";
	}
	else {
    if(sb2!=0){ 
	getID("rm"+sb2).style.display="none";
	getID("r_title"+sb2).getElementsByTagName("span")[0].className="";
	}
    if(sb2!=m){
        getID("rm"+m).style.display="block";
		getID("r_title"+m).getElementsByTagName("span")[0].className="on_tab";
        sb2=m;
    }
    else sb2=0;
	}
}



//FAQ页面函数调用
function expandIt(el) {
        obj = document.getElementById("page" + el);
        obj2 = document.getElementById("main" + el);
        if (obj.style.display == "none") {
            obj.style.display = "block";
        }
        else {
            obj.style.display = "none";
        }
}


//问吧调用
function setWBtxt(){
if(wb_m==0) return;
var wbt = Array();
var wbl = Array();
for(i=1;i<4;i++){
	wbt[i] = Array();
	wbl[i] = Array();
	for(j=1;j<20;j++){
		wbt[i][j] = Array();
		wbl[i][j] = Array();
		}
	}
wbt[1][1][1] = "Login Screen problem?";
wbl[1][1][1] = "http://help.91.com/answer/2009/07/30/16860.shtml";
wbt[1][1][2] = "Cannot connect to auto patch.";
wbl[1][1][2] = "http://help.91.com/answer/2009/07/17/15564.shtml";
wbt[1][1][3] = "How I change my password?";
wbl[1][1][3] = "http://help.91.com/answer/2009/07/17/15563.shtml";
wbt[1][1][4] = "i can't open the game or play it plz help";
wbl[1][1][4] = "http://help.91.com/answer/2009/07/10/15061.shtml";
wbt[1][1][5] = "account access";
wbl[1][1][5] = "http://help.91.com/answer/2009/07/04/14711.shtml";

wbt[1][2][1] = "How I can get IslandPrice?";
wbl[1][2][1] = "http://help.91.com/answer/2009/07/20/15769.shtml";
wbt[1][2][2] = "How instill update this game in my computer?";
wbl[1][2][2] = "http://help.91.com/answer/2009/06/23/12321.shtml";
wbt[1][2][3] = "easy lvlin";
wbl[1][2][3] = "http://help.91.com/answer/2009/06/26/13196.shtml";
wbt[1][2][4] = "i can't open the game or play it plz help";
wbl[1][2][4] = "http://help.91.com/answer/2009/07/10/15061.shtml";
wbt[1][2][5] = "Equation in a white box when game starts";
wbl[1][2][5] = "http://help.91.com/answer/2009/01/16/1203.shtml";

wbt[1][3][1] = "How instill update this game in my computer?";
wbl[1][3][1] = "http://help.91.com/answer/2009/06/23/12321.shtml";
wbt[1][3][2] = "i can't open the game or play it plz help";
wbl[1][3][2] = "http://help.91.com/answer/2009/07/10/15061.shtml";
wbt[1][3][3] = "Honor position";
wbl[1][3][3] = "http://help.91.com/answer/2009/07/31/16920.shtml";
wbt[1][3][4] = "Keep getting an error message";
wbl[1][3][4] = "http://help.91.com/answer/2009/07/28/16685.shtml";
wbt[1][3][5] = "windows 7";
wbl[1][3][5] = "http://help.91.com/answer/2009/07/09/15001.shtml";


wbt[1][4][1] = "Honor position";
wbl[1][4][1] = "http://help.91.com/answer/2009/07/31/16920.shtml";
wbt[1][4][2] = "Keep getting an error message";
wbl[1][4][2] = "http://help.91.com/answer/2009/07/28/16685.shtml";
wbt[1][4][3] = "manniquins";
wbl[1][4][3] = "http://help.91.com/answer/2009/07/21/15885.shtml";
wbt[1][4][4] = "upgrade";
wbl[1][4][4] = "http://help.91.com/answer/2009/07/19/15723.shtml";
wbt[1][4][5] = "Screen Resolution";
wbl[1][4][5] = "http://help.91.com/answer/2009/07/05/14753.shtml";

wbt[1][5][1] = "Why am i being timed?";
wbl[1][5][1] = "http://help.91.com/answer/2009/07/30/16889.shtml";
wbt[1][5][2] = "i think the fire is the Strong one nowe !";
wbl[1][5][2] = "http://help.91.com/answer/2009/07/04/14710.shtml";
wbt[1][5][3] = "I dont know how to use this divine thunder";
wbl[1][5][3] = "http://help.91.com/answer/2009/07/16/15532.shtml";
wbt[1][5][4] = "i still can't fly";
wbl[1][5][4] = "http://help.91.com/answer/2009/07/01/14500.shtml";
wbt[1][5][5] = "Mage skill";
wbl[1][5][5] = "http://help.91.com/answer/2009/07/15/15435.shtml";


wbt[1][6][1] = "Why am i being timed?";
wbl[1][6][1] = "http://help.91.com/answer/2009/07/30/16889.shtml";
wbt[1][6][2] = "i think the fire is the Strong one nowe !";
wbl[1][6][2] = "http://help.91.com/answer/2009/07/04/14710.shtml";
wbt[1][6][3] = "I dont know how to use this divine thunder";
wbl[1][6][3] = "http://help.91.com/answer/2009/07/16/15532.shtml";
wbt[1][6][4] = "i still can't fly";
wbl[1][6][4] = "http://help.91.com/answer/2009/07/01/14500.shtml";
wbt[1][6][5] = "Mage skill";
wbl[1][6][5] = "http://help.91.com/answer/2009/07/15/15435.shtml";

wbt[1][7][1] = "Why am i being timed?";
wbl[1][7][1] = "http://help.91.com/answer/2009/07/30/16889.shtml";
wbt[1][7][2] = "i think the fire is the Strong one nowe !";
wbl[1][7][2] = "http://help.91.com/answer/2009/07/04/14710.shtml";
wbt[1][7][3] = "I dont know how to use this divine thunder";
wbl[1][7][3] = "http://help.91.com/answer/2009/07/16/15532.shtml";
wbt[1][7][4] = "i still can't fly";
wbl[1][7][4] = "http://help.91.com/answer/2009/07/01/14500.shtml";
wbt[1][7][5] = "Mage skill";
wbl[1][7][5] = "http://help.91.com/answer/2009/07/15/15435.shtml";

wbt[1][8][1] = "Why am i being timed?";
wbl[1][8][1] = "http://help.91.com/answer/2009/07/30/16889.shtml";
wbt[1][8][2] = "i think the fire is the Strong one nowe !";
wbl[1][8][2] = "http://help.91.com/answer/2009/07/04/14710.shtml";
wbt[1][8][3] = "I dont know how to use this divine thunder";
wbl[1][8][3] = "http://help.91.com/answer/2009/07/16/15532.shtml";
wbt[1][8][4] = "i still can't fly";
wbl[1][8][4] = "http://help.91.com/answer/2009/07/01/14500.shtml";
wbt[1][8][5] = "Mage skill";
wbl[1][8][5] = "http://help.91.com/answer/2009/07/15/15435.shtml";


wbt[2][1][1] = "Honor position";
wbl[2][1][1] = "http://help.91.com/answer/2009/07/31/16920.shtml";
wbt[2][1][2] = "Keep getting an error message";
wbl[2][1][2] = "http://help.91.com/answer/2009/07/28/16685.shtml";
wbt[2][1][3] = "manniquins";
wbl[2][1][3] = "http://help.91.com/answer/2009/07/21/15885.shtml";
wbt[2][1][4] = "upgrade";
wbl[2][1][4] = "http://help.91.com/answer/2009/07/19/15723.shtml";
wbt[2][1][5] = "Screen Resolution";
wbl[2][1][5] = "http://help.91.com/answer/2009/07/05/14753.shtml";

wbt[2][2][1] = "I dont know how to use this divine thunder";
wbl[2][2][1] = "http://help.91.com/answer/2009/07/16/15532.shtml";
wbt[2][2][2] = "i still can't fly";
wbl[2][2][2] = "http://help.91.com/answer/2009/07/01/14500.shtml";
wbt[2][2][3] = "Warrior Skill";
wbl[2][2][3] = "http://help.91.com/answer/2009/05/18/4094.shtml";
wbt[2][2][4] = "Plz help!!! using normal mage skills (not XP!)";
wbl[2][2][4] = "http://help.91.com/answer/2008/12/04/811.shtml";
wbt[2][2][5] = "How to get flight skill?";
wbl[2][2][5] = "http://help.91.com/answer/2008/09/25/440.shtml";

wbt[2][3][1] = "super jade sword price";
wbl[2][3][1] = "http://help.91.com/answer/2009/08/03/17251.shtml";
wbt[2][3][2] = "What does the exp stone do?";
wbl[2][3][2] = "http://help.91.com/answer/2009/08/02/17133.shtml";
wbt[2][3][3] = "Where is the place where i can find super stones.";
wbl[2][3][3] = "http://help.91.com/answer/2009/08/02/17130.shtml";
wbt[2][3][4] = "How do i get eps fast without donating??";
wbl[2][3][4] = "http://help.91.com/answer/2009/08/01/17103.shtml";
wbt[2][3][5] = "VOLCANO BOSSES";
wbl[2][3][5] = "http://help.91.com/answer/2009/07/28/16706.shtml";

wbt[2][4][1] = "how can i get eps in the game?";
wbl[2][4][1] = "http://help.91.com/answer/2009/07/04/14663.shtml";
wbt[2][4][2] = "what is th best way to collect money ?";
wbl[2][4][2] = "http://help.91.com/answer/2009/07/04/14665.shtml";
wbt[2][4][3] = "What Should I Have To Make My Weapon Have Light?";
wbl[2][4][3] = "http://help.91.com/answer/2009/07/14/15373.shtml";
wbt[2][4][4] = "Mage skill";
wbl[2][4][4] = "http://help.91.com/answer/2009/07/15/15435.shtml";
wbt[2][4][5] = "F-Soul";
wbl[2][4][5] = "http://help.91.com/answer/2009/07/23/16206.shtml";


wbt[2][5][1] = "Are mouses better then super euds?";
wbl[2][5][1] = "http://help.91.com/answer/2008/09/22/89.shtml";
wbt[2][5][2] = "Where is the volcano and Adam?";
wbl[2][5][2] = "http://help.91.com/answer/2008/09/23/209.shtml";
wbt[2][5][3] = "Why fc n cc very hard to drop from spider????";
wbl[2][5][3] = "http://help.91.com/answer/2008/09/23/223.shtml";
wbt[2][5][4] = "What is the best way to get a 15-star pet?";
wbl[2][5][4] = "http://help.91.com/answer/2008/09/28/536.shtml";
wbt[2][5][5] = "portal in gobi";
wbl[2][5][5] = "http://help.91.com/answer/2008/12/29/1085.shtml";


wbt[2][6][1] = "Are mouses better then super euds?";
wbl[2][6][1] = "http://help.91.com/answer/2008/09/22/89.shtml";
wbt[2][6][2] = "Where is the volcano and Adam?";
wbl[2][6][2] = "http://help.91.com/answer/2008/09/23/209.shtml";
wbt[2][6][3] = "Why fc n cc very hard to drop from spider????";
wbl[2][6][3] = "http://help.91.com/answer/2008/09/23/223.shtml";
wbt[2][6][4] = "What is the best way to get a 15-star pet?";
wbl[2][6][4] = "http://help.91.com/answer/2008/09/28/536.shtml";
wbt[2][6][5] = "portal in gobi";
wbl[2][6][5] = "http://help.91.com/answer/2008/12/29/1085.shtml";

wbt[2][7][1] = "Are mouses better then super euds?";
wbl[2][7][1] = "http://help.91.com/answer/2008/09/22/89.shtml";
wbt[2][7][2] = "Where is the volcano and Adam?";
wbl[2][7][2] = "http://help.91.com/answer/2008/09/23/209.shtml";
wbt[2][7][3] = "Why fc n cc very hard to drop from spider????";
wbl[2][7][3] = "http://help.91.com/answer/2008/09/23/223.shtml";
wbt[2][7][4] = "What is the best way to get a 15-star pet?";
wbl[2][7][4] = "http://help.91.com/answer/2008/09/28/536.shtml";
wbt[2][7][5] = "portal in gobi";
wbl[2][7][5] = "http://help.91.com/answer/2008/12/29/1085.shtml";


wbt[2][8][1] = "Demon Cases Quest";
wbl[2][8][1] = "http://help.91.com/answer/2009/08/01/17002.shtml";
wbt[2][8][2] = "Unable to get my eq to upgrade in the lvl 9 upgrade quest";
wbl[2][8][2] = "http://help.91.com/answer/2009/07/15/15453.shtml";
wbt[2][8][3] = "Smashing Easter Eggs";
wbl[2][8][3] = "http://help.91.com/answer/2009/04/17/3048.shtml";
wbt[2][8][4] = "Summon 3 eudemons quest";
wbl[2][8][4] = "http://help.91.com/answer/2008/12/03/806.shtml";
wbt[2][8][5] = "open the 4th hatcher quest";
wbl[2][8][5] = "http://help.91.com/answer/2008/09/28/593.shtml";

wbt[2][9][1] = "Demon Cases Quest";
wbl[2][9][1] = "http://help.91.com/answer/2009/08/01/17002.shtml";
wbt[2][9][2] = "Unable to get my eq to upgrade in the lvl 9 upgrade quest";
wbl[2][9][2] = "http://help.91.com/answer/2009/07/15/15453.shtml";
wbt[2][9][3] = "Smashing Easter Eggs";
wbl[2][9][3] = "http://help.91.com/answer/2009/04/17/3048.shtml";
wbt[2][9][4] = "Summon 3 eudemons quest";
wbl[2][9][4] = "http://help.91.com/answer/2008/12/03/806.shtml";
wbt[2][9][5] = "open the 4th hatcher quest";
wbl[2][9][5] = "http://help.91.com/answer/2008/09/28/593.shtml";


wbt[3][1][1] = "Why am i being timed?";
wbl[3][1][1] = "http://help.91.com/answer/2009/07/30/16889.shtml";
wbt[3][1][2] = "i think the fire is the Strong one nowe !";
wbl[3][1][2] = "http://help.91.com/answer/2009/07/04/14710.shtml";
wbt[3][1][3] = "Mini Map.";
wbl[3][1][3] = "http://help.91.com/answer/2009/06/29/14325.shtml";
wbt[3][1][4] = "blessing and characters?";
wbl[3][1][4] = "http://help.91.com/answer/2009/04/28/3507.shtml";
wbt[3][1][5] = "Can you have samesex courtship?";
wbl[3][1][5] = "http://help.91.com/answer/2009/02/28/1885.shtml";

wbt[3][2][1] = "eudemons";
wbl[3][2][1] = "http://help.91.com/answer/2009/08/03/17230.shtml";
wbt[3][2][2] = "My eudemon wont gain any exp";
wbl[3][2][2] = "http://help.91.com/answer/2009/08/02/17142.shtml";
wbt[3][2][3] = "How can i get a gift for my eudemons.";
wbl[3][2][3] = "http://help.91.com/answer/2009/08/02/17129.shtml";
wbt[3][2][4] = "Paladin Wings";
wbl[3][2][4] = "http://help.91.com/answer/2009/07/14/15345.shtml";
wbt[3][2][5] = "what is the best way to up your eud stars?";
wbl[3][2][5] = "http://help.91.com/answer/2009/07/04/14666.shtml";

wbt[3][3][1] = "What is the requirement of making a legion?";
wbl[3][3][1] = "http://help.91.com/answer/2008/12/04/815.shtml";
wbt[3][3][2] = "Legion question";
wbl[3][3][2] = "http://help.91.com/answer/2008/12/03/810.shtml";
wbt[3][3][3] = "How is a 610 pt crystal made?";
wbl[3][3][3] = "http://help.91.com/answer/2008/09/28/559.shtml";
wbt[3][3][4] = "family prizes";
wbl[3][3][4] = "http://help.91.com/answer/2008/09/26/470.shtml";
wbt[3][3][5] = "What is the point of A Family?";
wbl[3][3][5] = "http://help.91.com/answer/2008/12/04/849.shtml";

wbt[3][4][1] = "What is the requirement of making a legion?";
wbl[3][4][1] = "http://help.91.com/answer/2008/12/04/815.shtml";
wbt[3][4][2] = "Legion question";
wbl[3][4][2] = "http://help.91.com/answer/2008/12/03/810.shtml";
wbt[3][4][3] = "How is a 610 pt crystal made?";
wbl[3][4][3] = "http://help.91.com/answer/2008/09/28/559.shtml";
wbt[3][4][4] = "family prizes";
wbl[3][4][4] = "http://help.91.com/answer/2008/09/26/470.shtml";
wbt[3][4][5] = "What is the point of A Family?";
wbl[3][4][5] = "http://help.91.com/answer/2008/12/04/849.shtml";


wbt[3][5][1] = "If I got a mentor and he expels me...";
wbl[3][5][1] = "http://help.91.com/answer/2008/12/04/835.shtml";
wbt[3][5][2] = "When will the connection between mentor and apprentice end?";
wbl[3][5][2] = "http://help.91.com/answer/2008/12/04/817.shtml";
wbt[3][5][3] = "Quick mentor questions";
wbl[3][5][3] = "http://help.91.com/answer/2008/12/03/807.shtml";
wbt[3][5][4] = "MENTOR POTENCY";
wbl[3][5][4] = "http://help.91.com/answer/2008/09/28/575.shtml";
wbt[3][5][5] = "Leave Mentor?";
wbl[3][5][5] = "http://help.91.com/answer/2008/09/28/571.shtml";

wbt[3][6][1] = "Castle Population Growth";
wbl[3][6][1] = "http://help.91.com/answer/2009/01/26/1323.shtml";
wbt[3][6][2] = "Castle gate";
wbl[3][6][2] = "http://help.91.com/answer/2009/01/22/1258.shtml";
wbt[3][6][3] = "What is the point of a Castle and how do you get one?";
wbl[3][6][3] = "http://help.91.com/answer/2008/12/04/848.shtml";
wbt[3][6][4] = "castle system ?";
wbl[3][6][4] = "http://help.91.com/answer/2008/09/28/574.shtml";
wbt[3][6][5] = "Booted Going to Castle Area";
wbl[3][6][5] = "http://help.91.com/answer/2008/09/27/523.shtml";

wbt[3][7][1] = "What does the exp stone do?";
wbl[3][7][1] = "http://help.91.com/answer/2009/08/02/17133.shtml";
wbt[3][7][2] = "How Do you get violet stones";
wbl[3][7][2] = "http://help.91.com/answer/2009/04/13/2929.shtml";
wbt[3][7][3] = "Where can you get the Red Stones?";
wbl[3][7][3] = "http://help.91.com/answer/2008/12/04/838.shtml";
wbt[3][7][4] = "composing violet, reds stones";
wbl[3][7][4] = "http://help.91.com/answer/2008/09/28/588.shtml";
wbt[3][7][5] = "Violet stones, whats the point?";
wbl[3][7][5] = "http://help.91.com/answer/2008/09/28/572.shtml";


wbt[3][8][1] = "is there any way to be vip for free?";
wbl[3][8][1] = "http://help.91.com/answer/2009/07/04/14670.shtml";
wbt[3][8][2] = "How to be a god in eudemons";
wbl[3][8][2] = "http://help.91.com/answer/2009/07/28/16700.shtml";
wbt[3][8][3] = "VIP";
wbl[3][8][3] = "http://help.91.com/answer/2008/12/26/1073.shtml";
wbt[3][8][4] = "What the services is VIP have?";
wbl[3][8][4] = "http://help.91.com/answer/2009/01/08/1150.shtml";
wbt[3][8][5] = "How can i to be VIP?";
wbl[3][8][5] = "http://help.91.com/answer/2009/01/08/1149.shtml";


wbt[3][9][1] = "My eudemon acount was hacked...";
wbl[3][9][1] = "http://help.91.com/answer/2009/07/10/15060.shtml";
wbt[3][9][2] = "why i cant open thisi email in the game ?";
wbl[3][9][2] = "http://help.91.com/answer/2009/07/04/14675.shtml";
wbt[3][9][3] = "How i can release the banded account?";
wbl[3][9][3] = "http://help.91.com/answer/2009/07/21/15992.shtml";
wbt[3][9][4] = "How I change my password?";
wbl[3][9][4] = "http://help.91.com/answer/2009/07/17/15563.shtml";
wbt[3][9][5] = "account access";
wbl[3][9][5] = "http://help.91.com/answer/2009/07/04/14711.shtml";


wbt[3][10][1] = "How to be a divine";
wbl[3][10][1] = "http://help.91.com/answer/2009/09/01/24049.shtml";
wbt[3][10][2] = "I would like to know information about divine path.";
wbl[3][10][2] = "http://help.91.com/answer/2009/07/28/16699.shtml";
wbt[3][10][3] = "Please describe the Divine Mount - Icy Unicorn";
wbl[3][10][3] = "http://help.91.com/answer/2009/06/05/4821.shtml";
wbt[3][10][4] = "What does Loyalty Godship - represents?";
wbl[3][10][4] = "http://help.91.com/answer/2009/06/05/4819.shtml";
wbt[3][10][5] = "What is the best way to get your eudemons stars quick?";
wbl[3][10][5] = "http://help.91.com/answer/2009/06/05/4815.shtml";


for(k=1;k<wbt[wb_n][wb_m].length;k++){
	document.writeln("<a href=\""+ wbl[wb_n][wb_m][k] +"\" target=\"_blank\">"+ wbt[wb_n][wb_m][k] +"<\/a><br \/>");
	}
}
//截图调用
function setJTtxt(){
  var jsurl = "http://p.images.91.com/album91e_js/special/eo_ss_"
  var jstag ="<script language=\"JavaScript\" type=\"text\/javascript\""
  var jietu = jstag+" src=""+jsurl+wb_n+wb_m+".js"+"/"><\/script>"
  document.writeln(jietu);
}



//搜索栏JS

	function dhmenuchg(obj,n){
		var dhdiv = obj.getElementsByTagName("div")[0];
		var dhul = obj.getElementsByTagName("ul")[0];
		dhdiv.className = n==1?"dh_topdiv_on":"dh_topdiv";
		dhul.style.display = n==1?"block":"none";
	}
	function dhmenuchg2(obj,n){
		
		var dhul = obj.getElementsByTagName("ul")[0];
		var dha = obj.getElementsByTagName("a")[0];
		obj.style.position = n==1?"relative":"";
		dhul.style.display = n==1?"block":"none";
		dha.className = n==1?"dh_a_on":"";
	}