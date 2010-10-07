<?php
// Domain Manager - A web-based application written in PHP & MySQL used to manage a collection of domain names.
// Copyright (C) 2010 Greg Chetcuti
// 
// Domain Manager is free software; you can redistribute it and/or modify it under the terms of the GNU General
// Public License as published by the Free Software Foundation; either version 2 of the License, or (at your
// option) any later version.
// 
// Domain Manager is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
// implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
// for more details.
// 
// You should have received a copy of the GNU General Public License along with Domain Manager. If not, please 
// see http://www.gnu.org/licenses/
?>
<?php
session_start();
include("_includes/config.inc.php");
include("_includes/database.inc.php");
include("_includes/software.inc.php");
include("_includes/auth/auth-check.inc.php");
$page_title = "DNS Profile Breakdown";
$software_section = "dns";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$software_title?> :: <?=$page_title?></title>
<?php include("_includes/head-tags.inc.php"); ?>
</head>
<body>
<?php include("_includes/header.inc.php"); ?>
<?php
$sql = "select id, name, number_of_servers
		from dns
		where active = '1'
		order by name asc";
$result = mysql_query($sql,$connection);
?>
This is a breakdown of the DNS Profiles that are currently in use.
<BR><BR>
<strong>Number of Active DNS Profiles:</strong> <?=mysql_num_rows($result)?>

<?php if (mysql_num_rows($result) > 0) { ?>
<BR><BR>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
	<td width="300">
    	<font class="subheadline">Profile Name</font>
    </td>
	<td width="150">
    	<font class="subheadline"># of Servers</font>
    </td>
	<td>
    	<font class="subheadline"># of Domains</font>
    </td>
</tr>
<?php while ($row = mysql_fetch_object($result)) { ?>
<tr height="20">
    <td>
		<a class="subtlelink" href="edit/dns.php?dnsid=<?=$row->id?>"><?=$row->name?></a>
	</td>
    <td>
        <a class="subtlelink" href="edit/dns.php?dnsid=<?=$row->id?>"><?=$row->number_of_servers?></a>
	</td>
	<td>
    	<?php
		$sql2 = "select count(*) as total_count
				 from domains
				 where dns_id = '$row->id'
				 and active = '1'";
		$result2 = mysql_query($sql2,$connection);
		while ($row2 = mysql_fetch_object($result2)) {
			$total_dns_count = $row2->total_count;
		}
		?>
        <a class="nobold" href="domains.php?dnsid=<?=$row->id?>"><?=number_format($total_dns_count)?></a>
    </td>
</tr>
<?php } ?>
</table>
<?php } ?>
<?php include("_includes/footer.inc.php"); ?>
</body>
</html>