<?php
/**
 * /admin/index.php
 *
 * This file is part of DomainMOD, an open source domain and internet asset manager.
 * Copyright (c) 2010-2017 Greg Chetcuti <greg@chetcuti.com>
 *
 * Project: http://domainmod.org   Author: http://chetcuti.com
 *
 * DomainMOD is free software: you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * DomainMOD is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with DomainMOD. If not, see
 * http://www.gnu.org/licenses/.
 *
 */
?>
<?php
include("../_includes/start-session.inc.php");
include("../_includes/init.inc.php");

require_once(DIR_ROOT . "classes/Autoloader.php");
spl_autoload_register('DomainMOD\Autoloader::classAutoloader');

$system = new DomainMOD\System();

include(DIR_INC . "head.inc.php");
include(DIR_INC . "config.inc.php");
include(DIR_INC . "software.inc.php");
include(DIR_INC . "settings/admin-main.inc.php");
include(DIR_INC . "database.inc.php");

$system->authCheck($web_root);
$system->checkAdminUser($_SESSION['s_is_admin'], $web_root);
?>
<?php include(DIR_INC . 'doctype.inc.php'); ?>
<html>
<head>
    <title><?php echo $system->pageTitle($software_title, $page_title); ?></title>
    <?php include(DIR_INC . "layout/head-tags.inc.php"); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<?php include(DIR_INC . "layout/header.inc.php"); ?>
<a href="<?php echo $web_root; ?>/admin/settings/">System Settings</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/defaults/">System Defaults</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/users/">Users</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/domain-fields/">Custom Domain Fields</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/ssl-fields/">Custom SSL Fields</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/scheduler/">Task Scheduler</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/maintenance/">Maintenance</a><BR><BR>
<a href="<?php echo $web_root; ?>/admin/info/">System Information</a><BR>
<?php include(DIR_INC . "layout/footer.inc.php"); ?>
</body>
</html>
