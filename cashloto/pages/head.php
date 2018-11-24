<?
////пользователей
function total_users($db)
{		
$baseuser = mysql_query("SELECT COUNT(`user_id`) FROM `p_users` ",$db) or die(mysql_error());
$row = mysql_fetch_row($baseuser);
return $total = $row[0];

}


////пользователей за сегодня
function total_users_today($db)
{
$data_today = date("Y-m-d");		
$baseuser = mysql_query("SELECT COUNT(`user_id`) FROM `p_users` WHERE `reg_date`='{$data_today}'",$db) or die(mysql_error());
$row = mysql_fetch_row($baseuser);
return $total = $row[0];

}

////выплачено
function total_payments($db)
{
$all_out = mysql_query("select SUM(`summa`) from `p_payments`",$db) or die(mysql_error());
$row3 = mysql_fetch_row($all_out);
return $all_out_total = $row3[0]+0;

}


////проведено лотерей
function total_loto($db)
{
$select = mysql_query("select `total_game` from `p_roulette_stat`",$db) or die(mysql_error());
$row = mysql_fetch_array($select);
return $row['total_game'];

}
?>





		<div class="header">
		<table width="100%">
		<tr>
		<td width="18%">
		<a style="text-decoration: none;" href="/">
        <? echo $site_logo?>
		<? echo $site_slogan?>
		</a>
		</td>
		
		<td class="stats" width="13%">
		<i class="fa fa-group" style="font-size: 22px !important; color: #FF6A00; padding-top: 9px;"></i> <? echo total_users($db)?><br/><span style="font-size: 12px; color: #fff;">Пользователей</span>
		</td>
		<td class="stats" width="13%">
		<i class="fa fa-user-plus" style="font-size: 22px !important; color: #FF6A00; padding-top: 9px;"></i> <? echo total_users_today($db)?><br/><span style="font-size: 12px; color: #fff;">Новых сегодня</span>
		</td>
		<td class="stats" width="13%">
		<i class="fa fa-rocket" style="font-size: 22px !important; color: #FF6A00; padding-top: 9px;"></i> <? echo total_payments($db)?><br/><span style="font-size: 12px; color: #fff;">Выплачено</span>
		</td>
		<td class="stats" width="13%">
		<i class="fa fa-pie-chart" style="font-size: 22px !important; color: #FF6A00; padding-top: 9px;"></i> <? echo total_loto($db)?><br/><span style="font-size: 12px; color: #fff;">Проведено лотерей</span>
		</td>
	
		
		<td class="pub_vk" width="18%" style="text-align: center;">
		<a style="font-size: 12px;" class="pub_btn" href="<? echo $site_vk_pub?>" target="_blank"><i class="fa fa-vk"></i> Наша группа ВКонтакте</a>
		</td>
		
		
		
		</tr>
		</table>
		
		</div>