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
					<td><input name="<?php echo $this->prefix('content_css_selector')?>" id="<?php echo $this->prefix('content_css_selector')?>" type="text" value="<?php echo get_option($this->prefix('content_css_selector'), '#content') ?>" class="regular-text code"></td>
				</tr>
				<tr>
					<th><label for="<?php echo $this->prefix('pagination_css_selector')?>"><?php _e('Pagination CSS selector', $this->identifier) ?></label></th>
					<td> <input name="<?php echo $this->prefix('pagination_css_selector')?>" id="<?php echo $this->prefix('pagination_css_selector')?>" type="text" value="<?php echo get_option($this->prefix('pagination_css_selector'), '.pagination') ?>" class="regular-text code"></td>
				</tr>
			</tbody>
		</table>
		<?php submit_button() ?>
	</form>
</div>