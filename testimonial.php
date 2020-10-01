<div class="testimonial">

	<div class="centre-wrap centre-wrap--centred">

        <h1>Testimonials</h1>

		<? if ( isset( $config['regions'] ) && $config['regions'] ) : ?>

			<? $i = 0;?>
			<? $num_of_regions = count($config['regions']); ?>

			<? foreach ( $config['regions'] as $region ) : ?>

				<div class="testimonial__region<?= ($i + 1) % $num_of_regions === 0 ? ' last' : '';?>">

					<? $content = \Arr::get( $region, 'content', 'Default content, please add your own.' ); ?>

					<? if ( is_string ( $content ) ) : ?>

						<p>
							<?= html_entity_decode($content) ?>
						</p>

                        <h6><?= \Arr::get( $region, 'attestant', 'Default' );?></h6>

					<? endif; ?>

				</div>

				<? $i++;?>

			<? endforeach;?>

		<? else: ?>

			<p>
				Testimonial: Please set up some regions in your config.
			</p>

		<? endif;?>

	</div>

</div>
