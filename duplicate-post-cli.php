<?php
/**
 * Just a few sample commands to learn how WP-CLI works
 */
class Duplicate_Post_CLI {
	/**
	 * Duplicate a post or page.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The post/page ID.
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
	 *     # Schedule a new cron event.
	 *     $ wp cron event schedule cron_test
	 *     Success: Scheduled event with hook 'cron_test' for 2016-05-31 10:19:16 GMT.
	 *
	 *     # Schedule new cron event with hourly recurrence.
	 *     $ wp cron event schedule cron_test now hourly
	 *     Success: Scheduled event with hook 'cron_test' for 2016-05-31 10:20:32 GMT.
	 *
	 *     # Schedule new cron event and pass associative arguments.
	 *     $ wp cron event schedule cron_test '+1 hour' --foo=1 --bar=2
	 *     Success: Scheduled event with hook 'cron_test' for 2016-05-31 11:21:35 GMT.
	 */
	public function __invoke( $args, $assoc_args ) {
		WP_CLI::line( 'Duplicating post with ID ' . $args[0] );
		$post = get_post( $args[0] );
		$new_id = duplicate_post_perform_duplication( $post, '', '', $assoc_args );
		if ( is_wp_error( $new_id ) ) {
			WP_CLI::line( $new_id->get_error_message() );
		} else {
			WP_CLI::line( 'Created post with ID ' . $new_id );
		}
	}
}

WP_CLI::add_command( 'post duplicate', 'Duplicate_Post_CLI' );
