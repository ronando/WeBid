<table border="0" cellpadding="0" cellspacing="0" class="base-width">
	<tr>
		<td width="22%" valign="top" class="columL">
		<!-- <div class="titTable1 rounded-right">
			<?php echo ((isset($this->_rootref['L_276'])) ? $this->_rootref['L_276'] : ((isset($MSG['276'])) ? $MSG['276'] : '{ L_276 }')); ?>
		</div> -->
		<div class="catlist">
			<ul>
			    <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>browse.php?id=0"><?php echo ((isset($this->_rootref['L_277'])) ? $this->_rootref['L_277'] : ((isset($MSG['277'])) ? $MSG['277'] : '{ L_277 }')); ?></a>
				<?php $_cat_list_count = (isset($this->_tpldata['cat_list'])) ? sizeof($this->_tpldata['cat_list']) : 0;if ($_cat_list_count) {for ($_cat_list_i = 0; $_cat_list_i < $_cat_list_count; ++$_cat_list_i){$_cat_list_val = &$this->_tpldata['cat_list'][$_cat_list_i]; ?>
					<!-- <span style="background-color:<?php echo $_cat_list_val['COLOUR']; ?>"> <a href="browse.php?id=<?php echo $_cat_list_val['ID']; ?>"><?php echo $_cat_list_val['IMAGE']; echo $_cat_list_val['NAME']; ?></a> <?php echo $_cat_list_val['CATAUCNUM']; ?> </span> -->
				    <a href="browse.php?id=<?php echo $_cat_list_val['ID']; ?>"><?php echo $_cat_list_val['NAME']; echo $_cat_list_val['CATAUCNUM']; ?></a>  

				<?php }} ?>
			</ul>
			
		</div></td>
		<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="maincolum">
			<tr>
				<?php $_featured_count = (isset($this->_tpldata['featured'])) ? sizeof($this->_tpldata['featured']) : 0;if ($_featured_count) {for ($_featured_i = 0; $_featured_i < $_featured_count; ++$_featured_i){$_featured_val = &$this->_tpldata['featured'][$_featured_i]; ?>
				<div class="grid">
					<div class="grid-thumb"  style="background-image:url('<?php echo $_featured_val['IMAGE']; ?>')">
					</div>
					<div class="grid-title" align="center">
						<p style="width: 100%;"  align="center"><?php echo $_featured_val['BID']; ?></p>
						<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_featured_val['ID']; ?>"><?php echo $_featured_val['TITLE']; ?></a>
					</div>
				</div><?php }} ?>
			</tr>
			<?php if ($this->_rootref['B_HOT_ITEMS']) {  ?>
			<tr>
				<td class="titTable4"><?php echo ((isset($this->_rootref['L_279'])) ? $this->_rootref['L_279'] : ((isset($MSG['279'])) ? $MSG['279'] : '{ L_279 }')); ?></td>
			</tr>
			<tr>
				<td class="table2"><?php $_hotitems_count = (isset($this->_tpldata['hotitems'])) ? sizeof($this->_tpldata['hotitems']) : 0;if ($_hotitems_count) {for ($_hotitems_i = 0; $_hotitems_i < $_hotitems_count; ++$_hotitems_i){$_hotitems_val = &$this->_tpldata['hotitems'][$_hotitems_i]; ?>
				<div class="grid">
					<div class="grid-thumb"  style="background-image:url('<?php echo $_hotitems_val['IMAGE']; ?>')">
					</div>
					<div class="grid-title" align="center">
						<p style="width: 100%;"  align="center"><?php echo $_hotitems_val['BID']; ?></p>
						<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_hotitems_val['ID']; ?>"><?php echo $_hotitems_val['TITLE']; ?></a>
					</div>
				</div><?php }} ?></td>
			</tr>
			<?php } if ($this->_rootref['B_AUC_LAST']) {  ?>
			<tr>
				<td class="titTable4"><?php echo ((isset($this->_rootref['L_278'])) ? $this->_rootref['L_278'] : ((isset($MSG['278'])) ? $MSG['278'] : '{ L_278 }')); ?></td>
			</tr>
			<tr>
				<td class="table2 loose"><?php $_auc_last_count = (isset($this->_tpldata['auc_last'])) ? sizeof($this->_tpldata['auc_last']) : 0;if ($_auc_last_count) {for ($_auc_last_i = 0; $_auc_last_i < $_auc_last_count; ++$_auc_last_i){$_auc_last_val = &$this->_tpldata['auc_last'][$_auc_last_i]; ?>
				<p style="display:block;" <?php echo $_auc_last_val['BGCOLOUR']; ?>>
					<?php echo $_auc_last_val['DATE']; ?> <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_auc_last_val['ID']; ?>"><?php echo $_auc_last_val['TITLE']; ?></a>
				</p><?php }} ?></td>
			</tr>
			<?php } if ($this->_rootref['B_AUC_ENDSOON']) {  ?>
			<tr>
				<td class="titTable4"><?php echo ((isset($this->_rootref['L_280'])) ? $this->_rootref['L_280'] : ((isset($MSG['280'])) ? $MSG['280'] : '{ L_280 }')); ?></td>
			</tr>
			<tr>
				<td class="table2 loose"><?php $_end_soon_count = (isset($this->_tpldata['end_soon'])) ? sizeof($this->_tpldata['end_soon']) : 0;if ($_end_soon_count) {for ($_end_soon_i = 0; $_end_soon_i < $_end_soon_count; ++$_end_soon_i){$_end_soon_val = &$this->_tpldata['end_soon'][$_end_soon_i]; ?>
				<p  style="display:block;" <?php echo $_end_soon_val['BGCOLOUR']; ?>>
					<?php echo $_end_soon_val['DATE']; ?> <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_end_soon_val['ID']; ?>"><?php echo $_end_soon_val['TITLE']; ?></a>
				</p><?php }} ?></td>
			</tr>
			<?php } ?>
		</table></td>
	</tr>
</table>