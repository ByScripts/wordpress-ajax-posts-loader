<?php
/**
 * Plugin Name: ByScripts AJAX Posts Loader
 * Plugin URI: http://git.byscripts.info/wordpress-ajax-posts-loader
 * Description: Load the next page of posts with AJAX.
 * Text Domain: byscripts_ajax_posts_loader
 * Domain Path: /lang
 * Version: 0.2
 * Author: ByScripts
 * Author URI: http://www.byscripts.info/
 * License: MIT
 */

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2013 ByScripts.info
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class ByScriptsAjaxPostsLoader
{
	public $identifier = 'byscripts_ajax_posts_loader';

	public function __construct() {
		add_action('template_redirect', array($this, 'init'));
		add_action('admin_init', array($this, 'adminInit'));
		add_action('admin_menu', array($this, 'adminMenu'));
		add_filter(sprintf('plugin_action_links_%s', plugin_basename(__FILE__)), array($this, 'settingsLink'));
		load_plugin_textdomain($this->identifier, false, dirname(plugin_basename(__FILE__)) . '/lang/');

		// Small hack to make the string visible in PoEdit (I18n)
		__('Load the next page of posts with AJAX.');
	}

	public function init() {
		global $wp_query;

		// Don't load script on singular pages
		if(is_singular()) { return; }

		// Enqueue JS and CSS
		wp_enqueue_script(
			$this->identifier,
			plugin_dir_url(__FILE__) . 'js/' . $this->identifier . '.js',
			array('jquery'),
			'1.0',
			true
		);

		// Max number of pages
		$page_number_max = $wp_query->max_num_pages;

		// Next page to load
		$page_number_next = (get_query_var('paged') > 1) ? get_query_var('paged') + 1 : 2;
		
		// Add some parameters for the JS.
		wp_localize_script(
			$this->identifier,
			$this->identifier,
			array(
				'page_number_next' => $page_number_next,
				'page_number_max' => $page_number_max,
				'next_link' => next_posts($page_number_max, false),
				'load_more_str' => __('Load more news', $this->identifier),
				'loading_str' => __('Loading...', $this->identifier),
				'no_more_str' => __('No more news to load', $this->identifier),
				'content_css_selector' => get_option($this->prefix('content_css_selector'), '#content'),
				'pagination_css_selector' => get_option($this->prefix('pagination_css_selector'), '.pagination'),
				'remove_link_after_last_result' => get_option($this->prefix('remove_link_after_last_result'), false)
			)
		);
	}

	/**
	 * Prefixes a string with an unique identifier 
	 *
	 * @var string $str
	 * @return string
	 */
	private function prefix($string) {
		return $this->identifier . '_' . $string;
	}

	public function adminInit() {
		$this->registerSettings();
	}

	public function registerSettings() {
		register_setting($this->prefix('settings'), $this->prefix('content_css_selector'));
		register_setting($this->prefix('settings'), $this->prefix('pagination_css_selector'));
		register_setting($this->prefix('settings'), $this->prefix('remove_link_after_last_result'));
	}

	public function adminMenu() {
		add_options_page('ByScripts Ajax Posts Loader', 'Ajax Posts Loader', 'manage_options', $this->identifier, array($this, 'settingsPage') );
	}

	public function settingsPage() {
		if(!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', $this->identifier));
		}

		include dirname(__FILE__) . '/templates/settings.php';
	}

	public function settingsLink($links) {
		$link = sprintf('<a href="options-general.php?page=%s">%s</a>', $this->identifier, __('Settings', $this->identifier));
		array_unshift($links, $link);
		return $links;
	}
}

new ByScriptsAjaxPostsLoader();