<?
//Include the header
show_header('Ratio Requirements');
?>
<div class="thin">
	<div class="header">
		<h2 class="center">Ratio Rules</h2>
	</div>
	<div class="box pad">
		<p>
			Your ratio is the amount you have uploaded divided by the amount you have downloaded.
		</p>
		<p>
			To maintain leeching privileges, we require that you maintain a ratio above a minimum ratio. This is called your "required ratio". If your upload/download ratio goes below your required ratio, your account will be given a two week period to fix it before you lose your ability to download. This is called "ratio watch".
		</p>
		<p>
			The required ratio is <strong>NOT the extra amount of ratio you need to gain</strong>. It is the <strong>minimum</strong> required ratio you must maintain.
		</p>
		<p>
			Your required ratio is unique, and is calculated from the amount you have downloaded, and the percentage of your snatched torrents which you are still seeding.
		</p>
		<p>
			<strong>It is not necessary to know how this ratio is calculated. What you need to know is that downloading makes the required ratio go up (bad) and seeding your snatches forever makes your required ratio go down (good). You can view your required ratio in the site header (it is the "Required" value). You want a high ratio, and a low required ratio.</strong>
		</p>
		<p>
			The exact formula for calculating the required ratio is provided merely for the curious. It is done in three steps.
		</p>
		<p>
			The first step is by determining how high and how low your required ratio can be. This is determined by looking up how much you have downloaded from the following table:
		</p>

		<table>
			<tr class="colhead">
				<td><span title="These units are actually in base 2, not base 10. For example, there are 1,024 MB in 1 GB.">Amount downloaded</span></td>
				<td>Required ratio (0% seeded)</td>
				<td>Required ratio (100% seeded)</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] < 5*1024*1024*1024)?'a':'b'?>">
				<td>0-5 GB</td>
				<td>0.00</td>
				<td>0.00</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 5*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 10*1024*1024*1024)?'a':'b'?>">
				<td>5-10 GB</td>
				<td>0.15</td>
				<td>0.00</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 10*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 20*1024*1024*1024)?'a':'b'?>">
				<td>10-20 GB</td>
				<td>0.20</td>
				<td>0.00</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 20*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 30*1024*1024*1024)?'a':'b'?>">
				<td>20-30 GB</td>
				<td>0.30</td>
				<td>0.05</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 30*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 40*1024*1024*1024)?'a':'b'?>">
				<td>30-40 GB</td>
				<td>0.40</td>
				<td>0.10</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 40*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 50*1024*1024*1024)?'a':'b'?>">
				<td>40-50 GB</td>
				<td>0.50</td>
				<td>0.20</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 50*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 60*1024*1024*1024)?'a':'b'?>">
				<td>50-60 GB</td>
				<td>0.60</td>
				<td>0.30</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 60*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 80*1024*1024*1024)?'a':'b'?>">
				<td>60-80 GB</td>
				<td>0.60</td>
				<td>0.40</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 80*1024*1024*1024 && $LoggedUser['BytesDownloaded'] < 100*1024*1024*1024)?'a':'b'?>">
				<td>80-100 GB</td>
				<td>0.60</td>
				<td>0.50</td>
			</tr>
			<tr class="row<?=($LoggedUser['BytesDownloaded'] >= 100*1024*1024*1024)?'a':'b'?>">
				<td>100+ GB</td>
				<td>0.60</td>
				<td>0.60</td>
			</tr>
		</table>
		
		<p>
			For example, if you have downloaded 25 GB, your required ratio will be somewhere between 0.05 and 0.30.
		</p>
		<p>
			To get this range of requirements to a more precise number, what we do is take the required ratio (0% seeded) for your download band, multiply it by <img style="vertical-align: middle" src="static/blank.gif" alt="1 &#45; &#40;Seeding&#47;Snatched&#41;" onload="if (this.src.substr(this.src.length-9,this.src.length) == 'blank.gif') { this.src = 'http://chart.apis.google.com/chart?cht=tx&amp;chf=bg,s,FFFFFF00&amp;chl=1-%5Cfrac%7BSeeding%7D%7BSnatched%7D&amp;chco=' + hexify(getComputedStyle(this.parentNode,null).color); }" />, and round it up to the required ratio (100% seeded) if need be. Therefore, your required ratio will always lie between the 0% seeded and 100% seeded requirements, depending on the percentage of torrents you are seeding.
		</p>
		<p>
			In the formula, "snatched" is the number of <strong>non-deleted unique snatches</strong> (complete downloads) you have made (so if you snatch a torrent twice, it only counts once, and if it is then deleted, it's not counted at all). "Seeding" is the average number of torrents you've seeded over at least 72 hours in the past week. If you've seeded less than 72 hours in the past week, the "seeding" value will go down (which is bad).
		</p>
		<p>
			Thus, if you have downloaded less than 20 GB, and you are seeding 100% of your snatches, you will have <strong>no required ratio</strong>. If you have downloaded less than 5 GB, then no matter what percentage of snatches you are seeding, you will have no required ratio.
		</p>
		<p>
			If you stop seeding for an entire week, your required ratio will be the "required ratio (0% seeded)" for your download band. Your required ratio will go down once you start seeding again.
		</p>
		<p>
			Take note how, as your download increases, the <strong>0% seeded and 100% seeded required ratios begin to taper together</strong>. They meet at 100 GB of download, meaning that after you have downloaded 100 GB, your ratio requirement will be 0.60, no matter what percentage of your snatches you are seeding. 
		</p>

		<h3>Important information you should know</h3>
		<p>
			If your ratio does not meet your required ratio, you will be put on ratio watch. You will have <strong>two weeks</strong> to get your ratio above your required ratio - <strong>failure to do so will result in your downloading privileges being automatically disabled</strong>.
		</p>
		<p>
			If you download over <span title="This is in base 2, so it is actually 10,240 MB">10 GB</span> while you are on ratio watch, your downloading privileges will be disabled.
		</p>
		<p>
			Everyone gets to download their first 5 GB before ratio watch kicks in.
		</p>
		<p>
			<strong>To get out of ratio watch, you must either raise your ratio by uploading more, or lower your required ratio by seeding more. Your ratio MUST be above your required ratio.</strong>
		</p>
		<p>
			If you have lost your downloading privileges, your new required ratio will be the 0% seeded ratio. You will re-gain your downloading privileges once your ratio is above that required ratio.
		</p>
		<p>
			The ratio watch system is completely automatic and cannot be altered by staff.
		</p>

	</div>
<? include('jump.php'); ?>
</div>
<?
show_footer();
?>
