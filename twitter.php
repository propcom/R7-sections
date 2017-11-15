<?php
$SETUP = array('USER' => \Arr::get($config, 'user', 'propellercomms'), 'MAXIMUM_ROWS' => \Arr::get($config, 'count', 10));
// DEFINES
foreach ($SETUP as $i => $v) {
	if ($i == 'DATE_FORMAT' && $v == '') {
		define("DATE_FORMAT", 'g:m A M jS'); // Default, incase left blank
	} else {
		define("$i", $v);
	}
}

include_once('/var/www/shared/twitterincludes/CacheTwitter.php');
$t = new CacheTwitter(10); // 10 min cache
$twitterAvailable = $t->twitterAvailable();
$userTimeline = $t->userTimeline(USER, MAXIMUM_ROWS);
?>

<? if (!isset($userTimeline->error) || isset($userTimeline->error) && $userTimeline->error != 'Not authorized.') : ?>

    <section class="twitter">

        <div class="centre-wrap centre-wrap--centred">

            <div class="twitter__slider<?= $config['count'] > 2 ? ' draggable' : '';?>">

                <div class="inner-slider">
                    <? if ($twitterAvailable) :?>

                        <? if ($userTimeline) :?>

                            <? foreach ($userTimeline as $tweet) : ?>

                                <div class="twitter__slide">

                                    <a href="http://twitter.com/<?= \Arr::get($config, 'user', 'propellercomms') ?>" class="twitter__slide__link" target="_blank"></a>

                                    <p><?= twitter::convertLinks($tweet->text); ?></p>

                                </div>                   

                            <? endforeach; ?>

                        <? else : ?>

                            <p>Twitter is down. Try again later.</p>

                        <? endif;?>

                    <? else :?>

                        <p>Twitter is down. Try again later</p>

                    <? endif;?>               
                </div>
                
                <? if($config['count'] > 2) :?>
                <a href="javascript:void(0);" class="twitter__nav" data-direction="prev">l</a>
                <a href="javascript:void(0);" class="twitter__nav" data-direction="next">r</a>            
                <? endif;?>
            
            </div>
            
        </div>

    </section>

<? endif; ?>

