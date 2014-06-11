jQuery(document).ready(function($) {

	var page_number_next = parseInt(byscripts_ajax_posts_loader.page_number_next), // The number of the next page to load (/page/x/).
		page_number_max = parseInt(byscripts_ajax_posts_loader.page_number_max), // The maximum number of pages the current query can return.
		page_link_model = byscripts_ajax_posts_loader.page_link_model, // The link of the next page of posts.
		$content = $(byscripts_ajax_posts_loader.content_css_selector), // The content Element posts are inserted to
		$pagination = $(byscripts_ajax_posts_loader.pagination_css_selector), // The wordpress default pagination
		$loaderTrigger;

	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(page_number_next <= page_number_max) {
		// Insert the "More Posts" link.
		$content.append('<div id="byscripts_ajax_posts_loader_trigger">{loadmore}</div>'.replace('{loadmore}', byscripts_ajax_posts_loader.load_more_str));
		$loaderTrigger = $('#byscripts_ajax_posts_loader_trigger');
			
		// Remove the traditional navigation.
		$pagination.remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$loaderTrigger.click(function() {
		var next_link = page_link_model.replace(/\d+(\/)?$/, page_number_next + '$1');

		// Are there more posts to load?
		if(page_number_next <= page_number_max) {

			// Show that we're working.
			$(this).text(byscripts_ajax_posts_loader.loading_str);

			// Load more posts
			$.ajax({
				type : 'POST',
				url : next_link
			}).done(function(data) {
				page_number_next++;

				$loaderTrigger.before($(data).find(byscripts_ajax_posts_loader.content_css_selector).remove(byscripts_ajax_posts_loader.pagination_css_selector).html());
				$(byscripts_ajax_posts_loader.pagination_css_selector).remove();

				if(page_number_next <= page_number_max) {
					$loaderTrigger.text(byscripts_ajax_posts_loader.load_more_str);
				} else if(byscripts_ajax_posts_loader.remove_link_after_last_result) {
					$loaderTrigger.remove();
				} else {
					$loaderTrigger.text(byscripts_ajax_posts_loader.no_more_str);
				}
			}).fail(function() {
				$loaderTrigger.text(byscripts_ajax_posts_loader.error_str);
			});
		}

		return false;
	});
});
