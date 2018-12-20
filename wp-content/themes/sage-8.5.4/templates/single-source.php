<li class="sources-list__item">
<!-- 		  				<span class="source-item__count">
		(<?php //echo $count; ?>)
	</span>	 -->		  			
	<?php if($source['title']): ?>
	<span class="item__title">
		<?php echo $source['title']; ?>
	</span>
	<?php endif; ?>
	<?php if($source['link']): ?>
		<a href="<?php echo $source['link']['url']; ?>" target="<?php echo $source['link']['target']; ?>">
			<?php if(!empty($source['link']['title'])): ?>
				<?php echo $source['link']['title']; ?>
			<?php else: ?>
				<?php echo $source['link']['url']; ?>
			<?php endif; ?>
		</a>
	<?php endif; ?>
	<?php if($source['file']): ?>
		<a href="<?php echo $source['file']['url']; ?>" target="_blank">
			<?php echo $source['file']['title']; ?> <ion-icon name="document"></ion-icon>
		</a>
	<?php endif; ?>		  			
</li>