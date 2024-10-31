=== Results Count Remix ===
Contributors: KingdomGeek
Donate link: http://tinyurl.com/5jyam4
Tags: headers, meta, information, archives, search
Requires at least: 2.3
Tested up to: 2.6.2
Stable tag: trunk

Adds both the number of displayed posts as well as the total number of returned posts to search and archive pages. 

== Description ==

Adds to search results and archive pages the total number of posts available as well as an indicator as to which batch of posts are currently being displayed, for example "11-20 of 124." This plugin is a remix of [Results Count](http://wordpress.org/extend/plugins/results-count) by Matthew Taylor, and it is optimized for [the Thesis theme framework](http://get-thesis.com/).

Say you have a category named "Videos" with 432 posts; visiting the third page of that archive would show you posts 21-30 (assuming 10 posts per page); with this plugin, this information would be available to your users at a glance:

`<p>21–30 of 432 entries categorized:</p>
<h1>Videos</h1>`

Search results and the following archive types are taken into account by this plugin: day, month, year, author, category, and tag.

== Installation ==

After you have downloaded the file and extracted the `results-count-remix/` directory from the archive...

1. Upload the entire `results-count-remix/` directory to the `wp-content/plugins/` directory.
1. Activate the plugin through the Plugins menu in WordPress.
1. Place `<?php if (function_exists('results_count_remix')) results_count_remix(); ?>` in your templates where you would like the information to appear. If you are using the Thesis theme, skip this step, and see below.

Suggested templates to add the code to, if your theme has them: `author.php`, `archive.php`, `date.php`, `category.php`, `tag.php`, and `search.php`

You may also add the code to your theme's `index.php` file, in case it is used for any of your archives or for search results.

= Thesis Users =

As this plugin has been packaged specifically for the Thesis theme, it's appropriate that Thesis users have special instructions. Instead of placing `results_count_remix()` in various files, Thesis users may do the following.

Open `custom/custom_functions.php` in your Thesis theme directory, and add this code:

<pre><code>if (function_exists('results_count_remix')) {
	remove_action('thesis_hook_archive_info', 'thesis_default_archive_info');
	add_action('thesis_hook_archive_info', 'results_count_remix');
}</code></pre>


== Frequently Asked Questions ==

= Why are search terms and archive names wrapped in H1 tags? =

While this plugin will work with any theme, it has been specifically tweaked to work best with [Thesis](http://get-thesis.com/). Appropriate markup has been used accordingly.

== Screenshots ==

1. A tag archive with multiple results.