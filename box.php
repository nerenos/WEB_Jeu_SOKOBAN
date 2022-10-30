<style>
.careline{display: block;height: 35px;}
.care{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: red; overflow: hidden;background-image: url('images/wall.gif');}
.finish{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: grey; overflow: hidden;background-image: url('images/finish.gif');}
.player{display: block; height: 35px; width: 35px; border-radius: 15px; position: relative;background-image: url('images/player.gif');background-position:0px 70px}
.box{display: block; height: 35px; width: 35px; border-radius: 5px; background-color: blue; position: relative;background-image: url('images/box.gif');}
.trap{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: black; overflow: hidden; background-image: url('images/trap.gif');}
.buket{display: inline-block; height: 35px; width: 35px; border-radius: 5px; overflow: hidden; position: relative;background-image: url('images/buket.gif');background-position:0px 0px}
.hearth{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: transparent; position: relative;background-image: url('images/hearth.gif');background-position:0px 0px}
.breakhearth{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: transparent; position: relative;background-image: url('images/hearth.gif');background-position:35px 0px}
</style>
<?php
session_start();
if (!isset($_SESSION['level'])) {
  $_SESSION['level'] = 0;
  $_SESSION['maxhearth'] = 3;
  $_SESSION['hearth'] = 3;
}

for($i = 0;$i < $_SESSION['maxhearth'];$i++){
echo "<div class=\"";
if($i >= $_SESSION['hearth']){echo "break";}
echo "hearth\"></div>";
}
$level = $_SESSION['level'];
$file = 'level/l'.$level.'.txt';
$levelbackground = file($file);
echo "<div class=\"level\">";
for($i = 0; $i < 15; $i++){
echo "<div class=\"careline\">";
for($j = 0; $j < 15; $j++){
$bgd = substr($levelbackground[$i], $j, 1);
$ii = $i;
$jj = $j;
if($i<10){$ii = '0'.$i;}
if($j<10){$jj = '0'.$j;}
switch($bgd){
case 0:
echo "<div id=\"c".$jj.$ii."\" class=\"trap\"></div>";
break;
case 1:
echo "<div id=\"c".$jj.$ii."\" class=\"care\"></div>";
break;
case 2:
echo "<div id=\"c".$jj.$ii."\" class=\"finish\"></div>";
break;
case 3:
echo "<div id=\"c".$jj.$ii."\" class=\"buket\"></div>";
break;
}
}
echo "</div>";
}
echo "<div id=\"player\" class=\"player\"></div><div id=\"box\" class=\"box\"></div>";
echo "</div>";
?>
<script language="javascript">
var tablevel = new Array;
<?php
for($i = 0; $i < 15; $i++){
echo "var tabcol".$i."=new Array;";
for($j = 0; $j < 15; $j++){
$bgd = substr($levelbackground[$j], $i, 1);
echo "tabcol".$i."[".$i.",".$j."]=".$bgd.";";
}
echo "tablevel[".$i."]=tabcol".$i.";";
}
echo "var poslvxi =".intval($levelbackground[15]).";";
echo "var poslvyi =".intval($levelbackground[16]).";";
echo "var poslvbxi =".intval($levelbackground[17]).";";
echo "var poslvbyi =".intval($levelbackground[18]).";";
?>
var dist;
var poslvx = poslvxi;
var poslvy = poslvyi;
var poslvbx = poslvbxi;
var poslvby = poslvbyi;
var bop = true;
var posbx = 35*poslvbxi;
var posby = -560+35*poslvbyi;
var box = document.getElementById('box');
var posx = 35*poslvxi;
var posy = -525+35*poslvyi;
var player = document.getElementById('player');

</script>
<script type="text/javascript" src="js/functions.js"></script>
<script language="javascript">
move(box, posbx, posby);
move(player, posx, posy);
document.onkeydown = applyKey;
</script>