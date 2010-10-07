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
include("../_includes/config.inc.php");
include("../_includes/database.inc.php");
include("../_includes/software.inc.php");
include("../_includes/auth/auth-check.inc.php");
include("../_includes/timestamps/current-timestamp-basic.inc.php");
$software_section = "segments";

$segid = $_GET['segid'];

// 'Delete Domain' Confirmation Variables
$del = $_GET['del'];
$really_del = $_GET['really_del'];

// Form Variables
$new_name = $_POST['new_name'];
$new_description = $_POST['new_description'];
$new_segment = $_POST['new_segment'];
$new_notes = $_POST['new_notes'];
$new_segid = $_POST['new_segid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($new_name != "" && $new_segment != "") {

		$lines = explode("\r\n", $new_segment);
		$number_of_domains = count($lines);

		$new_segment_formatted = "'" . $new_segment;
		$new_segment_formatted = $new_segment_formatted . "'";
		$new_segment_formatted = preg_replace("/\r\n/", "','", $new_segment_formatted);
		$new_segment_formatted = str_replace (" ", "", $new_segment_formatted);
		$new_segment_formatted = trim($new_segment_formatted);
		$new_segment_formatted = addslashes($new_segment_formatted);

		$sql = "update segments
				set name = '$new_name',
					description = '$new_description',
					segment = '$new_segment_formatted',
					number_of_domains = '$number_of_domains',
					notes = '$new_notes',
					update_time = '$current_timestamp'
				where id = '$new_segid'";
		$result = mysql_query($sql,$connection) or die(mysql_error());
		
		$new_name = stripslashes($new_name);
		$new_description = stripslashes($new_description);
		$new_segment = stripslashes($new_segment);
		$new_notes = stripslashes($new_notes);

		$segid = $new_segid;
		
		$_SESSION['session_result_message'] = "Segment Updated<BR>";

	} else {
	
		if ($new_name == "") $_SESSION['session_result_message'] .= "Please Enter The Segment Name<BR>";
		if ($new_segment == "") $_SESSION['session_result_message'] .= "Please Enter The Segment<BR>";

	}

} else {

	$sql = "select name, description, segment, notes
			from segments
			where id = '$segid'";
	$result = mysql_query($sql,$connection);
	
	while ($row = mysql_fetch_object($result)) { 
	
		$new_name = $row->name;
		$new_description = $row->description;
		$new_segment = $row->segment;
		$new_notes = $row->notes;
	
	}

$new_segment = preg_replace("/', '/", "\r\n", $new_segment);
$new_segment = preg_replace("/','/", "\r\n", $new_segment);
$new_segment = preg_replace("/'/", "", $new_segment);

}

if ($del == "1") {

	$_SESSION['session_result_message'] = "Are You Sure You Want To Delete This Segment?<BR><BR><a href=\"$PHP_SELF?segid=$segid&really_del=1\">YES, REALLY DELETE THIS SEGMENT</a><BR>";

}

if ($really_del == "1") {

	$sql = "delete from segments where id = '$segid'";
	$result = mysql_query($sql,$connection);
	
	$_SESSION['session_result_message'] = "Segment Deleted<BR>";
	
	header("Location: ../segments.php");
	exit;

}
$page_title = "Editting A Segment";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$software_title?> :: <?=$page_title?></title>
<?php include("../_includes/head-tags.inc.php"); ?>
</head>
<body>
<?php include("../_includes/header.inc.php"); ?>
<form name="form1" method="post" action="<?=$PHP_SELF?>">
<strong>Segment Name:</strong><BR><BR>
<input name="new_name" type="text" value="<?php if ($new_name != "") echo stripslashes($new_name); ?>" size="50" maxlength="255">
<BR><BR>
<strong>Description:</strong><BR><BR>
<textarea name="new_description" cols="60" rows="5"><?php if ($new_description != "") echo stripslashes($new_description); ?></textarea>
<BR><BR>
<strong>Segment:</strong><BR><BR>
Enter the domains one per line.<BR><BR>
<textarea name="new_segment" cols="60" rows="5"><?php if ($new_segment != "") echo stripslashes($new_segment); ?></textarea>
<BR><BR>
<strong>Notes:</strong><BR><BR>
<textarea name="new_notes" cols="60" rows="5"><?=stripslashes($new_notes)?></textarea>
<BR><BR><BR>
<input type="hidden" name="new_segid" value="<?=$segid?>">
<input type="submit" name="button" value="Update This Segment &raquo;">
</form>
<BR><BR>
<a href="<?=$PHP_SELF?>?segid=<?=$segid?>&del=1">DELETE THIS SEGMENT</a>
<?php include("../_includes/footer.inc.php"); ?>
</body>
</html>