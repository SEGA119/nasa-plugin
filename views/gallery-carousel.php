<?php if( isset( $posts_array ) && $posts_array ): ?>

<div class="nasa-gallery_wrap">
	<div class="nasa-gallery">
		<?php 

			foreach( $posts_array as $post ) {

				include NASA__PLUGIN_VIEW . 'content-nasa-gallery-post.php';

			}

		?>
	</div>
</div>

<?php endif ?>