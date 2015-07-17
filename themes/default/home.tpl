<table border="0" cellpadding="0" cellspacing="0" class="base-width">
	<tr>
		<td width="22%" valign="top" class="columL">
		<!-- <div class="titTable1 rounded-right">
			{L_276}
		</div> -->
		<div class="catlist">
			<ul>
			    <a href="{SITEURL}browse.php?id=0">{L_277}</a>
				<!-- BEGIN cat_list -->
					<!-- <span style="background-color:{cat_list.COLOUR}"> <a href="browse.php?id={cat_list.ID}">{cat_list.IMAGE}{cat_list.NAME}</a> {cat_list.CATAUCNUM} </span> -->
				    <a href="browse.php?id={cat_list.ID}">{cat_list.NAME}{cat_list.CATAUCNUM}</a>  

				<!-- END cat_list -->
			</ul>
			
		</div></td>
		<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="maincolum">
			<tr>
				<!-- BEGIN featured -->
				<div class="grid">
					<div class="grid-thumb"  style="background-image:url('{featured.IMAGE}')">
					</div>
					<div class="grid-title" align="center">
						<p style="width: 100%;"  align="center">{featured.BID}</p>
						<a href="{SITEURL}item.php?id={featured.ID}">{featured.TITLE}</a>
					</div>
				</div><!-- END featured -->
			</tr>
			<!-- IF B_HOT_ITEMS -->
			<tr>
				<td class="titTable4">{L_279}</td>
			</tr>
			<tr>
				<td class="table2"><!-- BEGIN hotitems -->
				<div class="grid">
					<div class="grid-thumb"  style="background-image:url('{hotitems.IMAGE}')">
					</div>
					<div class="grid-title" align="center">
						<p style="width: 100%;"  align="center">{hotitems.BID}</p>
						<a href="{SITEURL}item.php?id={hotitems.ID}">{hotitems.TITLE}</a>
					</div>
				</div><!-- END hotitems --></td>
			</tr>
			<!-- ENDIF -->
			<!-- IF B_AUC_LAST -->
			<tr>
				<td class="titTable4">{L_278}</td>
			</tr>
			<tr>
				<td class="table2 loose"><!-- BEGIN auc_last -->
				<p style="display:block;" {auc_last.BGCOLOUR}>
					{auc_last.DATE} <a href="{SITEURL}item.php?id={auc_last.ID}">{auc_last.TITLE}</a>
				</p><!-- END auc_last --></td>
			</tr>
			<!-- ENDIF -->
			<!-- IF B_AUC_ENDSOON -->
			<tr>
				<td class="titTable4">{L_280}</td>
			</tr>
			<tr>
				<td class="table2 loose"><!-- BEGIN end_soon -->
				<p  style="display:block;" {end_soon.BGCOLOUR}>
					{end_soon.DATE} <a href="{SITEURL}item.php?id={end_soon.ID}">{end_soon.TITLE}</a>
				</p><!-- END end_soon --></td>
			</tr>
			<!-- ENDIF -->
		</table></td>
	</tr>
</table>