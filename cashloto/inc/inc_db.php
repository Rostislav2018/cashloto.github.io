<?
$db = mysql_connect ("localhost","zqkdyrvw_ll","")or die(mysql_error()); //хост, пользователь бд, пароль
mysql_select_db("zqkdyrvw_ll",$db); //база
mysql_query("SET NAMES utf8");





function postr2($num,$link,$p,$count,$db,$sk) 
{
$skybase1 = mysql_query("SELECT COUNT(*) FROM ".$count."",$db);
$temp = mysql_fetch_array($skybase1);
$rezult[30] = $temp[0];
$vsegop = (($rezult[30]-1)/$num)+1;
$vsegop =  intval($vsegop);
$p = intval($p);
if(empty($p) or $p <= 0) $p = 1;
if($p > $vsegop) $p = $vsegop;
$start = $p * $num - $num;
if ($start < 0) { $start = 0;}
if ($p > $sk) $rezult[0] = '<a class="nav" href="'.$link.'?p=1">1</a> ';
if ($p !=1) $rezult[20] = '<a class="nav" title=предидущая  href="'.$link.'?p='. ($p-1) .'"><</a> ';
if ($vsegop > 1 and ($p-1) > $sk) { $rezult[1] = '<span class="ser"> ... </span> '; }
$p2 = $vsegop - $p;
if ($vsegop > 1 and ($p2-1) >= $sk) { $rezult[2] = ' <span class="ser"> ... </span>'; }
if ((($p-1)+$sk) < $vsegop) $rezult[14] = ' <a class="nav" href="'.$link.'?p=' .$vsegop. '">'.$vsegop.'</a>';
if ($p != $vsegop) $rezult[21] =' <a class="nav" title="следующая" href='.$link.'?p='. ($p+1) .'>></a> ';
if($p-5 > 0 && $sk >= 6) $rezult[3] = ' <a class="nav" href='.$link.'?p='.($p-5).'>'.($p-5).'</a> ';
if($p-4 > 0 && $sk >= 5) $rezult[4] = ' <a class="nav" href='.$link.'?p='.($p-4).'>'.($p-4).'</a> ';
if($p-3 > 0 && $sk >= 4) $rezult[5] = ' <a class="nav" href='.$link.'?p='.($p-3).'>'.($p-3).'</a> ';
if($p-2 > 0 && $sk >= 3) $rezult[6] = ' <a class="nav" href='.$link.'?p='.($p-2).'>'.($p-2).'</a> ';
if($p-1 > 0 && $sk >= 2) $rezult[7] = ' <a class="nav" href='.$link.'?p='.($p-1).'>'.($p-1).'</a> ';
if($p+5 <= $vsegop && $sk >= 6) $rezult[8] = ' <a class="nav" href='.$link.'?p='.($p+5).'>'.($p+5).'</a> ';
if($p+4 <= $vsegop && $sk >= 5) $rezult[9] = ' <a class="nav" href='.$link.'?p='.($p+4).'>'.($p+4).'</a> ';
if($p+3 <= $vsegop && $sk >= 4) $rezult[10] = ' <a class="nav" href='.$link.'?p='.($p+3).'>'.($p+3).'</a> ';
if($p+2 <= $vsegop && $sk >= 3) $rezult[11] = ' <a class="nav" href='.$link.'?p='.($p+2).'>'.($p+2).'</a> ';
if($p+1 <= $vsegop && $sk >= 2) $rezult[12] = ' <a class="nav" href='.$link.'?p='.($p+1).'>'.($p+1).'</a> ';
$rezult[15] = $start; $rezult[16] = $num; $rezult[17] = $vsegop;
return $rezult;
}





function vpostr2($rezult,$p) 
{
Error_Reporting(E_ALL & ~E_NOTICE);
if(empty($p) or $p <= 0) $p = 1;
echo '<center><div class="navbar">';
echo $rezult[20].$rezult[0].$rezult[1].$rezult[3].$rezult[4].$rezult[5].$rezult[6].$rezult[7].'<span class="nav"><strong>'.intval($p).'</strong></span>'.$rezult[12].$rezult[11].$rezult[10].$rezult[9].$rezult[8].$rezult[2].$rezult[14].$rezult[21];
echo '</div><br />';
}
?>