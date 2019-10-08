<?php
/**
 * WP CLI interface.
 *
 * @package Duplicate Post
 * @since 4.0
 */

/**
 * Class Duplicate_Post_CLI
 */
class Duplicate_Post_CLI {
	/**
	 * Duplicate a post or page.
	 *
	 * ## OPTIONS
	 *
	 * <id>...
	 * : One or more IDs of posts to duplicate.
	 *
	 * [--use-options]
	 * : Use options stored in DB as defaults.
	 *
	 * [--[no-]copytitle]
	 * : Whether to copy post title. Default: yes.
	 *
	 * [--[no-]copydate]
	 * : Whether to copy post date. Default: no.
	 *
	 * [--[no-]copystatus]
	 * : Whether to copy post status. Default: no.
	 *
	 * [--[no-]copyslug]
	 * : Whether to copy post slug. Default: no.
	 *
	 * [--[no-]copyexcerpt]
	 * : Whether to copy post excerpt. Default: yes.
	 *
	 * [--[no-]copycontent]
	 * : Whether to copy post content. Default: yes.
	 *
	 * [--[no-]copythumbnail]
	 * : Whether to copy post thumbnail. Default: yes.
	 *
	 * [--[no-]copytemplate]
	 * : Whether to copy post template. Default: yes.
	 *
	 * [--[no-]copyformat]
	 * : Whether to copy post format. Default: yes.
	 *
	 * [--[no-]copyauthor]
	 * : Whether to copy post author. Default: no.

	 * [--[no-]copypassword]
	 * : Whether to copy post password. Default: no.
	 *
	 * [--[no-]copyattachments]
	 * : Whether to copy post attachments. Default: no.
	 *
	 * [--[no-]copychildren]
	 * : Whether to copy post children. Default: no.
	 *
	 * [--[no-]copycomments]
	 * : Whether to copy post comments. Default: no.
	 *
	 * [--[no-]copycommentmeta]
	 * : Whether to copy post comment meta fields. Default: no.
	 *
	 * [--[no-]copymenuorder]
	 * : Whether to copy post menu order. Default: yes.
	 *
	 * ## EXAMPLES
	 *
	 *     # Duplicate a post
	 *     $ wp post duplicate 42
	 *     Success: Created post with ID 69.
	 *
	 * @param array $args The parameters array.
	 * @param array $assoc_args The options associative array.
	 */
	public function __invoke( $args, $assoc_args ) {
		foreach ( $args as $id ) {
			$post = get_post( $id );
			if ( isset( $assoc_args['use-options'] ) && $assoc_args['use-options'] ) {
				$new_id = duplicate_post_create_duplicate( $post, '', '', $assoc_args );
			} else {
				$new_id = duplicate_post_perform_duplication( $post, '', '', $assoc_args );
			}
			if ( is_wp_error( $new_id ) ) {
				WP_CLI::warning( $new_id->get_error_message() );
			} else {
				// Translators: .
				WP_CLI::success( sprintf( __( 'Duplicated post with ID %1$s to post with ID %2$s.', 'duplicate-post' ), $id, $new_id ) );
			}
		}
	}
}

WP_CLI::add_command( 'post duplicate', 'Duplicate_Post_CLI' );
