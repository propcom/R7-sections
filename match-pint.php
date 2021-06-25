<?php
function get_matchpint($barID) {

    $matchesGroupedByDate = [];

    $xml = file_get_contents( 'http://www.matchpint.co.uk/bar-feed-' . $barID );

    $dom = new DOMDocument;
    $dom->loadXML($xml);

    $items = $dom->getElementsByTagName('item');

    $matches = array();

    foreach( $items as $item ) {

        $match = array();

        if ( $item->childNodes->length ) {

            foreach( $item->childNodes as $i ) {

                $match[$i->nodeName] = $i->nodeValue;

            }

            $timestamp = strtotime($match['dc:date']);

            $day = date('l jS F', $timestamp);
            $am_or_pm = date('A', $timestamp);
            $time = date('g.i', $timestamp);

            $match['am_or_pm'] = $am_or_pm;
            $match['time'] = $time;

            $matchesGroupedByDate[$day][] = $match;

        }

    }

    return $matchesGroupedByDate;

}
$id_matchpint = \Arr::get( $config, 'id_matchpint' );
$days = get_matchpint($id_matchpint);
?>
<section class="region  region--matchpint">

<div class="matchpint">

    <div class="centre-wrap centre-wrap--centred">
        <h3 class="banner matchpint__wptitle">
            <span><?= \Arr::get($config, 'title', 'LIVE SPORT');?></span>
        </h3>
        <? if ( $days ) : ?>

            <? foreach ($days as $day => $matches) : ?>

                <div class="matchpint__day">

                    <h3 class="matchpint__heading"><?= $day ?></h3>
                    
                    <div class="matchpint__group">

                        <? foreach ($matches as $match) : ?>
                                
                            <div class="matchpint__item">

                                <div class="matchpint__details">
                                    
                                    <h3 class="matchpint__sport">
                                        <?= $match['sport'] ?>
                                    </h3>

                                    <h6 class="matchpint__description">
                                        <?= $match['description'] ?>
                                    </h6>

                                </div>

                                <img class="matchpint__team matchpint__team--1" src="<?= $match['team1'] ?>" />

                                <h3 class="matchpint__title">
                                    <?= $match['title'] ?>
                                </h3>

                                <img class="matchpint__team matchpint__team--2" src="<?= $match['team2'] ?>" />

                                <h3 class="matchpint__time">
                                    <?= $match['time'] ?><span><?= $match['am_or_pm'] ?></span> Kick off
                                </h3>

                            </div>

                        <? endforeach; ?>
                        
                    </div>

                </div>

            <? endforeach; ?>

        <? endif; ?>

    </div>

</div>

</section>