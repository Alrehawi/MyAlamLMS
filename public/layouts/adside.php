	<div class="adside">
		<div class="adv_tbl_green"><font class="gray_button_button_white"><?php echo read_xmls('/site/frontendend/titles/friends')?></font></div>
		<div class="adv_arrow_green"></div>
		<div class="pics_wrapper">
			<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FMr-eMartcom%2F181409541912385&width=280&height=300&colorscheme=light&show_faces=true&border_color=white&stream=false&header=false&appId=182559451810250" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:258px;" allowTransparency="true"></iframe>
		</div>
		<div style="clear:both;"></div>
		
		<?php
		$ads_class='';
		$ads_class_orang=array("adv_tbl_orange","gray_button_button_black","adv_arrow_orange");
		$ads_class_green=array("adv_tbl_green","gray_button_button_white","adv_arrow_green");
		$adsections = AdSection::find_all('id ASC','WHERE publish=1');
		foreach($adsections as $adsection):
		if($ads_class==$ads_class_orang)$ads_class=$ads_class_green; else $ads_class=$ads_class_orang;
		?>
			<div class="<?php echo $ads_class[0];?>">
				<font class="<?php echo $ads_class[1];?>"><?php echo AdSection::find_viewed_language('title' , $adsection->id , AdSection::$trans_key)?></font>
			</div>
			<div class="<?php echo $ads_class[2];?>"></div>
			<?php
			$ads=Ad::find_by_adsec($adsection->id , ' ORDER BY RAND() LIMIT 1 ');
			?>
				<a href="<?php echo $ads[0]->url;?>" target="<?php echo $ads[0]->target;?>">
					<img src="<?php echo Photographs::get_image($ads[0]->photo , 'larg'); ?>" title="<?php echo Ad::find_viewed_language('title' , $ads[0]->id , 'ad')?>" width="300"  border="0" />
				</a>
			<!-- Divider -->
			<div style="clear:both; height:10px"></div>	
		<?php endforeach;?>
	
		<div align="center"><img src="images/stc_ban.jpg" width="300" height="88" /></div>			
	</div>