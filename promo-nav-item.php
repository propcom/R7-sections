<? if ( isset($promo) && $promo && $promo->navigation_item->nav_item_status == true):

	$item_type = $promo->navigation_item->nav_item_type;
	$text      = $promo->navigation_item->nav_item_text;
	$page_link = $promo->navigation_item->nav_item_page_link;
	$url       = $promo->navigation_item->nav_item_url;
	$file      = $promo->navigation_item->nav_item_file; ?>

	<? if( $item_type == 'internal' ): ?>

		<li>
			<a href="<?= $page_link ?>"><?= $text ?></a>
		</li>

	<? elseif( $item_type == 'external' ): ?>

		<li>
			<a href="<?= $url ?>" target="_blank" class="js-event-tracker" data-tracking-category="navigation promo item" data-tracking-action="Click" data-tracking-label="Navigation promo button"><?= $text ?></a>
		</li>

	<? elseif( $item_type == 'file' ): ?>

		<li>
			<a href="<?= $file ?>" target="_blank"><?= $text ?></a>
		</li>

	<? elseif( $item_type == 'design-my-night-popup' ): ?>

		<li>
			<a href="javascript:void(0);" target="_blank" class="js-popup" data-popup="book"><?= $text ?></a>
		</li>

	<? endif ?>

<? endif ?>