<?php

$instagram = new Instagram\InstagramFeed(\Arr::get( $insta_cfg, 'user_id' ));
$posts = $instagram->getPosts();

?>

<div class="instagram">

    <? if ( !empty($posts) && !array_key_exists('message', $posts)) : ?>

        <div class="instagram__slider">
            <div class="inner-slider">
                <? $i = 0; ?>
                <? foreach ( $posts as $photo ) : ?>
					<div class="instagram__block instagram__large">

						<a href="<?= $social['instagram']; ?>" target="_blank" title="<?= $sitename; ?>" class="instagram__link">

							<img src="<?= $photo['src']; ?>" zRS-src="<?= $photo['src']; ?>" alt="<?= $sitename; ?>">
							<span class="instagram__link--content">
								<span class="instagram__link--content--inner">
									<p>
										instagram<br/>
										<?= \Arr::get( $config, 'title', '#youngs_r7' ); ?>
									</p>
									<p class="follow">Follow</p>
								</span>
							</span>
						</a>

					</div>

					<? $i++ ?>

				<? endforeach; ?>

            </div>

        </div>

    <? endif; ?>

</div>
