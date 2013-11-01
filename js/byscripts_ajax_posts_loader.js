jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var page_number_next = parseInt(byscripts_ajax_posts_loader.page_number_next);
	
	// The maximum number of pages the current query can return.
	var page_number_max = parseInt(byscripts_ajax_posts_loader.page_number_max);
	
	// The link of the next page of posts.
	var next_link = byscripts_ajax_posts_loader.next_link;

	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(page_number_next <= page_number_max) {
		// Insert the "More Posts" link.
		$(byscripts_ajax_posts_loader.content_css_selector)
			.append('<div id="byscripts_ajax_posts_loader_placeholder_'+ page_number_next +'"></div>')
			.append('<div id="byscripts_ajax_posts_loader_trigger">{loadmore}</div>'.replace('{loadmore}', byscripts_ajax_posts_loader.load_more_str));
			
		// Remove the traditional navigation.
		$(byscripts_ajax_posts_loader.pagination_css_selector).remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#byscripts_ajax_posts_loader_trigger').click(function() {
	
		// Are there more posts to load?
		if(page_number_next <= page_number_max) {
		
			// Show that we're working.
			$(this).text(byscripts_ajax_posts_loader.loading_str);

			$('#byscripts_ajax_posts_loader_placeholder_'+ page_number_next).load(next_link + ' .post',
				function() {
					// Update page number and next_link.
					page_number_next++;
					next_link = next_link.replace(/\/page\/[0-9]?/, '/page/'+ page_number_next);
					
					// Add a new placeholder, for when user clicks again.
					$('#byscripts_ajax_posts_loader_trigger')
						.before('<div id="byscripts_ajax_posts_loader_placeholder_'+ page_number_next +'"></div>')
					
					// Update the button message.
					if(page_number_next <= page_number_max) {
						$('#byscripts_ajax_posts_loader_trigger').text(byscripts_ajax_posts_loader.load_more_str);
					} else {
						$('#byscripts_ajax_posts_loader_trigger').text(byscripts_ajax_posts_loader.no_more_str);
					}
				}
			);
		}

		return false;
	});
});