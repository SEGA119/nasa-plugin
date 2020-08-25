<?php if( isset( $post->ID ) ): ?>
	<?php echo get_the_post_thumbnail( $post->ID, 'nasa_thumb' ); ?>
<?php endif; ?>