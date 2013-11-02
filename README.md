Wordpress Ajax Posts Loader
===========================

Description
-----------

This [Wordpress](http://wordpress.org) plugin allows you to load the next page of posts with AJAX.

It's based on Wordpress "posts per page" settings.

If your blog displays 5 posts per page, each click on "Load more posts" will load 5 more posts.

Configuration
-------------

You will need to configure the plugin to suit your website structure.

* **Content CSS selector**: It's the CSS selector of the element at the bottom of which the "Load more posts" link will be added. (Default: `#content`)

* **Pagination CSS selector**: It's the CSS selector of the pagination element which will be removed when the plugin is loaded. (Default: `.pagination`)

* **Remove link after last result**: When checked, the "Load more posts" link will be removed after retrieving the last results. Else its label is replaced with "No more posts to load" (Default: `false`)

Installation
------------
1. Upload the plugin in `/wp-content/plugins directory`.
2. Activate it through the 'Plugin' menu in Wordpress admin.
3. Go to `Settings > Ajax Posts Loader` to configure the plugin.
4. Open you CSS file and add styles to `#byscripts_ajax_posts_loader` element.

Changelog
---------
0.2 : Add option to remove link after the last results
0.1 : First version

License
-------

This plugin is released under the [MIT License](http://opensource.org/licenses/MIT).
