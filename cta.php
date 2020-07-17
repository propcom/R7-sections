<div class="cta">

	<div class="centre-wrap centre-wrap--centred">

		<?
			if ( isset( $promo ) && !empty($promo->r7_header) ) {

				$new = [
					'title' 	=> $promo->r7_header,
					'content' 	=> $promo->r7_sub_header,
					'image' 	=> $promo->r7_template_image,
					'button' 	=> [
						'text' 		=> $promo->r7_button_copy ?: $promo->promo_button1_text,
						'link' 		=> $promo->venue_override_link ?: $promo->promo_button1_link,
					],
				];

				$config['regions'][2] = $new;
			}
		?>

		<? if ( isset( $config['regions'] ) && $config['regions'] ) : ?>

			<? $i = 0;?>
			<? $num_of_regions = count($config['regions']); ?>

			<? foreach ( $config['regions'] as $region ) : ?>

				<div class="cta__region<?= ($i + 1) % $num_of_regions === 0 ? ' last' : '';?>">

					<img src="<?= \Arr::get( $region, 'image' ); ?>" alt="<?= \Arr::get( $region, 'title' ); ?>" class="scale-with-grid">

					<h5><?= \Arr::get( $region, 'title', 'Default' );?></h5>

					<? $content = \Arr::get( $region, 'content', 'Default content, please add your own.' ); ?>

					<? if ( is_string ( $content ) ) : ?>

						<p>
							<?= \Str::truncate( html_entity_decode($content), 200, '...' ); ?>
						</p>

					<? elseif ( is_array ( $content ) ) : ?>

						<? foreach ( $content as $line ) : ?>

							<p>
								<?= $line; ?>
							</p>

						<? endforeach; ?>

					<? endif; ?>

					<? if ( isset( $region['button'] ) ) : ?>

						<a href="<?= $region['button']['link']; ?>" class="cta__button<?= isset($region['button']['class']) ? $region['button']['class'] : null; ?>" title="<?= $region['button']['text']; ?>" <?= isset($region['button']['attributes']) ? $region['button']['attributes'] : 'target="_blank"'; ?>>
							<?= $region['button']['text']; ?>
						</a>

					<? endif;?>

				</div>

				<? $i++;?>

			<? endforeach;?>

		<? else: ?>

			<p>
				CTA: Please set up some regions in your config.
			</p>

		<? endif;?>

	</div>

</div>
