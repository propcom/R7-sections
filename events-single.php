<?
require_once '/var/www/shared/5.3/autoloader.php';
Shared_Autoloader::forge()->setVersion('v1')->register();

$calendar_id = \Arr::get($config, 'calendar');
$calendar = \Prop\CP\Events\Calendar::forge($siteid, $calendar_id);

if(isset($_GET['date'])){
    $events = $calendar->get_events($_GET['date'], 'today', 30, 'standard');
};

?>

<div class="events events--full">

    <div class="centre-wrap centre-wrap--centred centre-wrap--no">

        <h3 class="banner">
            <span><?= \Arr::get($config, 'title', 'Events');?></span>
        </h3>

        <p class="larger"><?= \Arr::get($config, 'subtitle');?></p>

        <div class="events__full">
            <div class="events__button2__back">
                <a href="/whats-on">&laquo; Back</a>
            </div>
            <? if($events) :?>    
            <? foreach($events as $event):?>
            <? if($event->id == $_GET['event']): ?>           
            <div class="events__entry3" id="<?= $event->id;?>">
                <? $date = strtotime($event->date_start);?>

                <? if($event->image_id) :?>
                <div class="events__img3">
                    <div class="js-imager" data-src="<?= $event->image->get_src('large');?>" data-alt="<?= $event->name;?>"></div>
                    <noscript>
                        <img src="<?= $event->image->get_src('large');?>" alt="<?= $event->name;?>" height="185" width="265">                                
                    </noscript>                                
                </div>
                <? else :?>
                <div class="events__img3">
                    <div class="js-imager" data-class="fit" data-src="/assets/img/regions/events/small-ph.png" data-alt="<?= $event->name;?>"></div>
                    <noscript>
                        <img src="/assets/img/regions/events/small-ph.png" class="fit" alt="<?= $event->name;?>" height="185" width="265">                                
                    </noscript>                               
                </div>
                <? endif;?>

                <div class="events__full-info3">
                    <div class="events__date3" id="<?= date('d', $date);?>">
                        <span><?= date('F', $date);?></span>
                        <p><?= date('d', $date);?></p>
                    </div>
                    <div class="events__title3">
                        <h5><?= $event->name;?></h5>
                        <? if(strtotime($event->date_start) != strtotime($event->date_end)) :?>
                        <p class="events__start"><?= date('g.iA', strtotime($event->date_start));?> - <?= date('g.iA', strtotime($event->date_end));?></p>                                    
                        <? else :?>                                
                        <p class="events__start"><?= date('g.iA', strtotime($event->date_start));?></p>                                
                        <? endif;?>
                    </div>                        
                    <div class="events__content3">
                        <?= $event->description;?>

                        <? if($event->booking_link || $event->more_info_link) :?>
                        <div class="events__buttons">
                            <? if($event->booking_link) :?>
                            <a class="button__button--small" href="<?= $event->booking_link;?>" target="_blank">Buy Tickets</a>                                        
                            <? endif;?>
                            <? if($event->more_info_link) :?>
                            <a class="button__button--small" href="<?= $event->more_info_link;?>" target="_blank">Read More</a>                                        
                            <? endif;?>
                        </div>
                        <? endif;?>
                    </div>
                </div>
            </div>
            <? endif;?>
            <? endforeach;?>
            <? else: ?>

            <p>We currently don't have any events planned, please check back soon for updates.</p>

            <? endif;?>
        </div>

    </div>

</div>