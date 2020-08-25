<?php

namespace NasaPlugin;

class Repository
{
	
	public const POST_TYPE = 'post-nasa-gallery';
	
    public function all() : array {
	
		return get_posts( array(
			'numberposts' => -1,
			'post_type' => self::POST_TYPE
		));
		
	}
	
	public function last( $number_of_posts ) {
		
		return get_posts( array(
			'numberposts' => $number_of_posts,
			'post_type' => self::POST_TYPE,
		));		
		
	}

    public function create( $options ) {
				
		$post_id = wp_insert_post( array(
			'post_type' => self::POST_TYPE,
			'post_title' => isset( $options['post_title'] ) ? $options['post_title'] : '',
			'post_status' => 'publish'
		));		
		
		if( isset( $options['post_thumbnail'] ) ) {
			if( $thumbnail_id = save_image_from_url($options['post_thumbnail']) ) {
				set_post_thumbnail( $post_id, $thumbnail_id );				
			}
		}
		
	}

    public function update( $options ) {
		
		/**
		 * Logic to update post goes here..
		 */
		
		return TRUE;
		
	}

    public function delete( $id ) {
		
		/**
		 * Logic to delete post goes here..
		*/
		
		return TRUE;
		
	}
	
	public static function destroy() {
		
		$posts_array = get_posts( array(
			'numberposts' => -1,
			'post_type' => self::POST_TYPE,
			'post_status' => 'any'
		));
		
		foreach( $posts_array as $post ) {
			
			$post_id = $post->ID;
			
			$thumb_id = get_post_thumbnail_id( $post_id );
			
			wp_delete_attachment( $thumb_id, TRUE );			
			wp_delete_post( $post_id, TRUE );
			
		}
		
	}
	
	public static function init() {
		
		add_action( 'init', array( 'NasaPlugin\Repository', 'register_post_type' ) );
		
	}
	
	public static function register_post_type() {
		
		$labels = array(
			'name'               => _x( 'NASA Gallery', 'post type general name', 'nasa-plugin' ),
			'singular_name'      => _x( 'NASA Gallery Post', 'post type singular name', 'nasa-plugin' ),
			'menu_name'          => _x( 'NASA Gallery', 'admin menu', 'nasa-plugin' ),
			'name_admin_bar'     => _x( 'Post', 'add new on admin bar', 'nasa-plugin' ),
			'add_new'            => _x( 'Add New', 'nasa-post', 'nasa-plugin' ),
			'add_new_item'       => __( 'Add New Post', 'nasa-plugin' ),
			'new_item'           => __( 'New Post', 'nasa-plugin' ),
			'edit_item'          => __( 'Edit Post', 'nasa-plugin' ),
			'view_item'          => __( 'View Post', 'nasa-plugin' ),
			'all_items'          => __( 'All Posts', 'nasa-plugin' ),
			'search_items'       => __( 'Search Posts', 'nasa-plugin' ),
			'parent_item_colon'  => __( 'Parent Posts:', 'nasa-plugin' ),
			'not_found'          => __( 'No Posts found in Gallery.', 'nasa-plugin' ),
			'not_found_in_trash' => __( 'No Posts found in Gallery Trash.', 'nasa-plugin' )
		);

		$args = array(
			'labels'             => $labels,
				'description'        => __( 'Description.', 'nasa-plugin' ),
			'public'             => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui'            => TRUE,
			'show_in_menu'       => TRUE,
			'query_var'          => TRUE,
			'rewrite'            => array( 'slug' => 'nasa-gallery', 'with_front' => TRUE ),
			'capability_type'    => 'post',
			'has_archive'        => TRUE,
			'hierarchical'       => FALSE,
			'menu_position'      => 5,
			'menu_icon'			 => 'dashicons-groups',
			'supports'           => array( 'title', 'thumbnail', )
		);

		register_post_type( self::POST_TYPE, $args );				
		
	}
		
}