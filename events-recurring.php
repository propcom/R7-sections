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

<div class="events">
    
    <div class="centre-wrap centre-wrap--centred centre-wrap--no">
       
        <h1 class="banner">
            <span><?= \Arr::get($config, 'title', 'Events');?></span>
        </h1>
        
        <p class="larger"><?= \Arr::get($config, 'subtitle');?></p>
        
        <div class="">

            <? $todaysDate = time();?>

            <? if($events) :?>    
                
                <? foreach(\EventManager::forge($events)->get_events() as $date => $date_events):?>                    
                    
                    <? foreach($date_events as $event):?>
                        <? if($event->recurrance || !\EventManager::is_recurring($event)){ continue; } ?>
                        <? $date = strtotime($event->date_start);?>
                        
                        <div class="details__box  details__box--event" id="<?= $event->id;?>">

                            <? if($event->image_id) :?>
                                <div class="js-imager" data-src="<?= $event->image->get_src('large');?>" data-class="scale-with-grid" data-alt="<?= $event->name;?>"></div>
                                <noscript>
                                    <img src="<?= $event->image->get_src('large');?>" alt="<?= $event->name;?>" class="scale-with-grid">                                
                                </noscript>                                
                            <? else :?>
                                <div class="js-imager" data-class="scale-with-grid" data-src="/assets/img/regions/events/small-ph.png" data-alt="<?= $event->name;?>"></div>
                                <noscript>
                                    <img src="/assets/img/regions/events/small-ph.png" class="scale-with-grid" alt="<?= $event->name;?>">                      
                                </noscript>                               
                            <? endif;?>

                            <h3 class="details__box__title  details__box__title--event">Every <?= date('l', $date);?></h3>

                            <div class="details__box__content  details__box__content--event">
                                
                                <h5 class="details__box__content__event-title"><?= $event->name;?></h5>

                                <?= $event->description;?>
                                    
                            </div>

                        </div>

                    <? endforeach;?>

                <? endforeach;?>

            <? else: ?>
            
            <p>We currently don't have any events planned for <span class="highlight"><?= date('F Y', strtotime($event_month));?></span>, please check back soon for updates.</p>
            
            <? endif;?>
        </div>
        
    </div>
    
</div>