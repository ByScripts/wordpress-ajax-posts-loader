<div class="wrap">
	<?php echo screen_icon() ?>
	<h2><?php echo sprintf(__('%s Settings', $this->identifier), 'ByScripts Ajax Posts Loader') ?></h2>

	<form method="post" action="options.php">
		<?php settings_fields($this->prefix('settings')); ?>
		<?php do_settings_sections($this->prefix('settings')); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="<?php echo $this->prefix('content_css_selector')?>"><?php _e('Content CSS selector', $this->identifier) ?></label></th>
					<td>
						<input name="<?php echo $this->prefix('content_css_selector')?>" id="<?php echo $this->prefix('content_css_selector')?>" type="text" value="<?php echo get_option($this->prefix('content_css_selector'), '#content') ?>" class="regular-text code">
						<p class="description"><?php _e('This is the HTML element where your posts are loaded.<br>If your list of post is in &lt;div id="main"&gt;&lt;/div&gt;, set this parameter to #main', $this->identifier) ?></p>
					</td>
				</tr>
				<tr>
					<th><label for="<?php echo $this->prefix('pagination_css_selector')?>"><?php _e('Pagination CSS selector', $this->identifier) ?></label></th>
					<td>
						<input name="<?php echo $this->prefix('pagination_css_selector')?>" id="<?php echo $this->prefix('pagination_css_selector')?>" type="text" value="<?php echo get_option($this->prefix('pagination_css_selector'), '.pagination') ?>" class="regular-text code">
						<p class="description"><?php _e('This is the HTML element which contains the site navigation/pagination.<br>If your page selector is in &lt;div class="my-pagination"&gt;&lt;/div&gt;, set this parameter to .my-pagination', $this->identifier) ?></p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input name="<?php echo $this->prefix('remove_link_after_last_result')?>" id="<?php echo $this->prefix('remove_link_after_last_result')?>" type="checkbox" <?php echo get_option($this->prefix('remove_link_after_last_result'), false) ? 'checked="checked"' : '' ?>>
						<label for="<?php echo $this->prefix('remove_link_after_last_result')?>"><?php _e('Remove link after last result', $this->identifier) ?></label>
						<p class="description"><?php _e('Whether to remove or not the "Load more posts" link if there is no more results to load.', $this->identifier) ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php submit_button() ?>
	</form>
</div>