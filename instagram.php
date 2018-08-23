<?php

$instagram = new Instagram\InstagramFeed(\Arr::get( $insta_cfg, 'user_id' ));
$posts = $instagram->getPosts(\Arr::get( $insta_cfg, 'count', 30 ) );

?>

<div class="instagram">

    <? if ( !empty($posts) && !array_key_exists('message', $posts)) : ?>

        <div class="instagram__slider">
            <div class="inner-slider">
                <? $i = 0; ?>
                <? foreach ( $posts as $photo ) : ?>

                <? if ( $i % 5 === 0 ) : ?>

                <? if ( $i != 0 ) : ?>

            </div>

            <? endif; ?>

            <div class="instagram__block instagram__large">

                <? endif; ?>

                <? if ( $i % 5 === 0 ) {
                    $src = $photo->images->standard_resolution;
                } else {
                    $src = $photo->images->low_resolution;
                } ?>

                <? if ( $i === 7 || $i === 19 ) : ?>

                    <a href="<?= $social['instagram']; ?>" target="_blank" title="<?= $sitename; ?>" class="instagram__link">

                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" zRS-src="<?= $src->url; ?>" alt="<?= $sitename; ?>" height="<?= $src->height; ?>" width="<?= $src->width; ?>">
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

                <? else : ?>

                    <a href="<?= $photo->link; ?>" target="_blank" title="<?= $photo->caption ? $photo->caption->text : '-' ?>">
                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" zRS-src="<?= $src->url; ?>" alt="<?= $sitename; ?>" height="<?= $src->height; ?>" width="<?= $src->width; ?>">
                    </a>

                <? endif; ?>
                <? if ( $i % 5 === 0 ) : ?>

            </div>
            <div class="instagram__block instagram__small">

                <? endif; ?>

                <? $i ++; ?>
                <? endforeach; ?>
            </div>
        </div>

    <? endif; ?>

</div>
