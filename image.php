<section class="image">
               
    <? if(count($config['images']) > 0) :?>
       
       <div class="image__slider">
           <div class="inner-slider" data-p="2.5">
                <? $i = 0;?>
                <? foreach($config['images'] as $image) :?>
                    <div class="image__slide">
                        <img <?= $i === 0 ? '' : 'zRS-';?>src="<?= $image;?>" alt="<?= $sitename;?>" height="415" width="2000">                       
                   </div>
                    <? $i++;?>
                <? endforeach;?>               
           </div>
       </div>
       
    <? else: ?>
       
        <div class="centre-wrap">
           
            <p>No images defined in the config, please set them up.</p>            
            
        </div>     
        
    <? endif;?>
    
</section>