<?
require_once '/var/www/shared/5.3/autoloader.php';
Shared_Autoloader::forge()->setVersion('v1')->register();

$calendar_id = \Arr::get($config, 'calendar');
$calendar = \Prop\CP\Events\Calendar::forge($siteid, $calendar_id);
$events = $calendar->get_events('today', \Arr::get($config, 'events', '+1 month'));

?>

<div class="events">

    <div class="centre-wrap centre-wrap--centred centre-wrap--no">

        <h3 class="banner">
            <span><?= \Arr::get($config, 'title', 'Events');?></span>
        </h3>

        <? if($events) :?>
            <div class="events__slider<?= count($events) > 4 ? ' draggable' : '';?>">
                <div class="inner-slider">
                    <? $i = 0;?>
                    <? foreach($events as $date => $date_events):?>
                        <? foreach($date_events as $event):?>
                            <div class="events__slide">
                          <a href="/event?event=<?= $event->id;?>&date=<?= $event->date_start ?>">

                               <? $date = strtotime($event->date_start);?>
                                <? if(\Arr::get($config, 'link')) :?>
                                    <a href="<?= \Arr::get($config, 'link').'#'.$event->id;?>">
                                <? endif;?>
                               
                                <? if($event->image_id) :?>
                                    <? if(\Arr::get($config, 'link')) :?>
                                        <a href="<?= \Arr::get($config, 'link');?>">
                                    <? endif;?>
                                        <img zRS-src="<?= $event->image->get_src('medium');?>" alt="<?= $event->name;?>" height="185" width="265">
                                    <? if(\Arr::get($config, 'link')) :?>
                                    </a>
                                    <? endif;?>
                                <? else :?>
                                    <img zRS-src="/assets/img/regions/events/small-ph.png" alt="<?= $event->name;?>" height="185" width="265">
                                <? endif;?>

                                <div class="events__info">
                                    <div class="events__date">
                                        <a href="whats-on">
                                            <span><?= date('F', $date);?></span>
                                            <p><?= date('d', $date);?></p>
                                        </a>
                                    </div>
                                    <div class="events__title">                                       
                                        <h5>
                                            <? if(\Arr::get($config, 'link')) :?>
                                            <a href="<?= \Arr::get($config, 'link').'#'.$event->id;?>">
                                            <? endif;?>
                                            <?= \Str::truncate($event->name, 30, '...');?>
                                            <? if(\Arr::get($config, 'link')) :?>
                                            </a>
                                            <? endif;?>
                                        </h5>
                                    </div>                                    
                                </div>                                
                                </a>
                            </div>

                        <? $i++;?>
                        <? endforeach;?>
                    <? endforeach;?>
                </div>
                <? if(count($events) > 4) :?>
                <a href="javascript:void(0);" class="events__nav" data-direction="prev">l</a>
                <a href="javascript:void(0);" class="events__nav" data-direction="next">r</a>
                <? endif; ?>
            </div>

        <? else: ?>

        <p>We currently don't have any events planned, please check back soon for updates.</p>

        <? endif;?>

    </div>

</div>
