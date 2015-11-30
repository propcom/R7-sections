<?
require_once '/var/www/shared/5.3/autoloader.php';
Shared_Autoloader::forge()->setVersion('v1')->register();

$calendar_id = \Arr::get($config, 'calendar');
$calendar = \Prop\CP\Events\Calendar::forge($siteid, $calendar_id);

$get_month = (isset($_GET['month']) ? date('M', strtotime($_GET['month'])) : date('M'));

$event_month = (isset($_GET['month']) ? date('M Y', strtotime($_GET['month'])) : date('M Y'));

if(time() > strtotime('+1 month', strtotime($event_month))) {
    
    $event_month = date('M Y', strtotime('+1 year', strtotime($event_month)));
    
}

$events = $calendar->get_events($event_month, 'last day of this month');

?>

<div class="events events--full">
    
    <div class="centre-wrap centre-wrap--centred centre-wrap--no">
       
        <h3 class="banner">
            <span><?= \Arr::get($config, 'title', 'Events');?></span>
        </h3>
        
        <p class="larger"><?= \Arr::get($config, 'subtitle');?></p>
        
        <div class="events__full" id="events-container">
            <div class="events__months">
                <ul>
                    <? for($m = 1; $m <= 12; $m++) :?>
                    <? $month = date('M', mktime(0, 0, 0, $m, 1, date('Y')));?>
                    <li><a href="/<?= \Arr::get($config, 'url', 'events');?>?month=<?= $month;?>#events-container"<?= $month === $get_month ? ' class="active"' : '';?>><?= $month;?> &rarr;</a></li>
                    <? endfor; ?>                    
                </ul>                
            </div>
        <? if($events) :?>    
            <? foreach($events as $date => $date_events):?>                    
                <? foreach($date_events as $event):?>
                    <? $date = strtotime($event->date_start);?>
                    <div class="events__entry2  <? if(date('d', $date) != date('d')): ?>events__entry2__past<? endif; ?>" id="<?= $event->id;?>">
                        <a href="/event?event=<?= $event->id;?>&date=<?= $event->date_start ?>">

                        <? if($event->image_id) :?>
                            <div class="events__img2">
                                <div class="js-imager" data-src="<?= $event->image->get_src('large');?>" data-alt="<?= $event->name;?>"></div>
                                <noscript>
                                    <img src="<?= $event->image->get_src('large');?>" alt="<?= $event->name;?>" height="185" width="265">                                
                                </noscript>                                
                            </div>
                        <? else :?>
                            <div class="events__img2">
                                <div class="js-imager" data-class="fit" data-src="/assets/img/regions/events/small-ph.png" data-alt="<?= $event->name;?>"></div>
                                <noscript>
                                    <img src="/assets/img/regions/events/small-ph.png" class="fit" alt="<?= $event->name;?>" height="185" width="265">                                
                                </noscript>                               
                            </div>
                        <? endif;?>

                        <div class="events__full-info2">
                            <div class="events__date2" id="<?= date('d', $date);?>">
                                <span><?= date('F', $date);?></span>
                                <p><?= date('d', $date);?></p>
                            </div>
                            <div class="events__title2">
                                <h5><?= $event->name;?></h5>
                                <? if(strtotime($event->date_start) != strtotime($event->date_end)) :?>
                                    <p class="events__start"><?= date('g.iA', strtotime($event->date_start));?> - <?= date('g.iA', strtotime($event->date_end));?></p>                                    
                                <? else :?>                                
                                    <p class="events__start"><?= date('g.iA', strtotime($event->date_start));?></p>                                
                                <? endif;?>
                            </div>                        
                            <div class="events__content2">
                                <?
                                    if (strlen($event->description) >= 151) {
                                        echo substr($event->description, 0, 150). " ... " ;
                                    }
                                    else {
                                        echo $event->description;
                                    }

                                ?>
                                
                                <? if($event->booking_link || $event->more_info_link) :?>
                                    <div class="events__buttons">
                                        <? if($event->booking_link) :?>
                                            <a class="button__button" href="<?= $event->booking_link;?>" target="_blank">Book</a>                                        
                                        <? endif;?>
                                        <? if($event->more_info_link) :?>
                                            <a class="button__button" href="<?= $event->more_info_link;?>" target="_blank">Read More</a>                                        
                                        <? endif;?>
                                    </div>
                                <? endif;?>
                            </div>
                        </div>
                        </a>
                    </div>
                <? endforeach;?>
            <? endforeach;?>
        <? else: ?>
        
        <p>We currently don't have any events planned for <span class="highlight"><?= date('F Y', strtotime($event_month));?></span>, please check back soon for updates.</p>
        
        <? endif;?>
        </div>
        
    </div>
    
</div>