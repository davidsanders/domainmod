<?php
/**
 * /_includes/layout/pagination-large-mode.inc.php
 *
 * This file is part of DomainMOD, an open source domain and internet asset manager.
 * Copyright (c) 2010-2025 Greg Chetcuti <greg@greg.ca>
 *
 * Project: http://domainmod.org   Author: https://greg.ca
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
<div class="pagination_menu_block">
    <div class="pagination_menu_block_inner">
        <?php echo $navigate[2]; ?>&nbsp;
        <?php if ($total_rows) {
            echo sprintf(_('(Listing %s of %s)'), $navigate[1], number_format($total_rows));
        } ?>
    </div>
</div>
<div class="domainmod-css-clear-both"></div>
<BR>
