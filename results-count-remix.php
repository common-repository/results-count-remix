<?php
/*
Plugin Name: Results Count Remix
Plugin URI: http://rickbeckman.org/freebies/results-count-remix/
Description: Adds to search results and archive pages the total number of posts available as well as an indicator as to which batch of posts are currently being displayed, for example "11-20 of 124." This plugin is a remix of <a href="http://wordpress.org/extend/plugins/results-count">Results Count</a> by Matthew Taylor, and it is optimized for <a href="http://get-thesis.com/">the Thesis theme framework</a>.
Version: 1.0
Author: Rick Beckman
Author URI: http://rickbeckman.org/
*/

function results_count_remix() {
	if (is_search() || is_archive()) {
		global $posts_per_page, $wpdb, $paged, $wp_query;

		$numposts = $wp_query->found_posts;

		if (0 < $numposts)
			$numposts = number_format($numposts);

		if (empty($paged))
			$paged = 1;

		$startpost = ($posts_per_page * $paged) - $posts_per_page + 1;

		if (($startpost + $posts_per_page - 1) >= $numposts)
			$endpost = $numposts;
		else
			$endpost = $startpost + $posts_per_page - 1;

		if ($numposts != 1)
			$plural_posts = true;
		if ($numposts > $posts_per_page)
			$plural_pages = true;

		// Handle category archives
		if (is_category()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost,' of ', $numposts, ' entries categorized:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries categorized:</p>';
				else
					echo '<p>One entry categorized:</p>';
			}
		
			echo '<h1>', single_cat_title('', false), '</h1>';
		}

		// Handle monthly archives
		if (is_month()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost, ' of ', $numposts, ' entries from the month of:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries from the month of:</p>';
				else
					echo '<p>One entry from the month of:</p>';
			}

			echo '<h1>', get_the_time('F Y'), '</h1>';
		}

		// Handle daily archives
		elseif (is_day()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost, ' of ', $numposts, ' entries from the day of:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries from the day of:</p>';
				else
					echo '<p>One entry from the day of:</p>';
			}

			echo '<h1>', get_the_time('F j, Y'), '</h1>';
		}

		// Handle yearly archives
		elseif (is_year()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost, ' of ', $numposts, ' entries from the year:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries from the year:</p>';
				else
					echo '<p>One entry from the year:</p>';
			}

			echo '<h1>', get_the_time('F Y'), '</h1>';
		}

		// Handle tag archives
		elseif (is_tag()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost,' of ', $numposts, ' entries tagged:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries tagged:</p>';
				else
					echo '<p>One entry tagged:</p>';
			}
		
			echo '<h1>', single_tag_title('', false), '</h1>';
		}

		// Handle author archives
		elseif (is_author()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost,' of ', $numposts, ' entries by:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' entries by:</p>';
				else
					echo '<p>One entry by:</p>';
			}
		
			echo '<h1>', get_author_name(get_query_var('author')), '</h1>';
		}

		// Handle search results
		elseif (is_search()) {
			if ($plural_pages)
				echo '<p>', $startpost, '&ndash;', $endpost,' of ', $numposts, ' results for the search query:</p>';
			else {
				if ($plural_posts)
					echo '<p>', $numposts, ' results for the search query:</p>';
				else
					echo '<p>One result for the search query:</p>';
			}
		
			echo '<h1>', attribute_escape(get_search_query()), '</h1>';
		}
	}
}

?>