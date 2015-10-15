<div class="facilities">
    
    <div class="centre-wrap centre-wrap--centred centre-wrap--no">
              
        <div class="facilities__full">
            
            <? $facilities = \Arr::get($config, 'facility');?>

            <? if($facilities && count($facilities > 0)) :?>
            
                <? foreach($facilities as $name => $info) :?>

                <div class="facilities__entry">

                    <div class="facilities__img">
                        <div class="js-imager" data-src="/assets/img/regions/facilities/small-ph.png" data-alt="<?= $sitename;?>"></div>
                        <noscript>
                            <img src="/assets/img/regions/facilities/small-ph.png" alt="<?= $sitename;?>" height="185" width="265">                                
                        </noscript>                               
                    </div>

                    <div class="facilities__full-info">

                        <div class="facilities__title">
                            <h5><?= $name;?></h5>
                        </div>                        
                        <div class="facilities__content">
                            
                            <? try { ?>                            
                            <?= \View::forge(APPPATH.'/views/section_content/facilities/'.\Arr::get($info, 'content'));?>
                            <? } catch(Exception $e) {?>                                
                                <p>Content not found. Please specifiy a content region in your config, or check that your path is correct.</p>                            
                            <?}?>
                            <? $table = \Arr::get($info, 'table');?>
                            <? if($table) :?>
                            <div class="facilities__table">
                                <div class="facilities__table--row">
                                    <? $c = count($table['columns']);?>                                   
                                    <? foreach($table['columns'] as $column) :?>
                                        <div class="facilities__table--cell facilities__table--cell--<?=$c;?>">
                                            <?= $column;?>
                                        </div>                             
                                    <? endforeach;?>
                                </div>
                                <? foreach($table['rows'] as $row): ?>
                                    <div class="facilities__table--row">
                                        <? $c = count($row);?>
                                        <? foreach($row as $field) :?>
                                            <div class="facilities__table--cell facilities__table--cell--<?=$c;?>">
                                                <?= $field;?>
                                            </div>
                                        <? endforeach;?>
                                    </div>
                                <? endforeach;?>
                            </div>                            
                            <? endif;?>
                            <div class="facilities__buttons">
                                <a class="button__button" href="<?= \Arr::get($config, 'button', '#enquire');?>">Hire Enquiry</a>
                            </div>
                        </div>
                    </div>

                </div>

                <? endforeach;?>
                
            <? else :?>
               
                <p>Please set up some facilities.</p>
                
            <? endif;?>           
                    
        </div>
        
    </div>
    
</div>