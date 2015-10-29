<div class="cta">
    
    <div class="centre-wrap centre-wrap--centred">
        
        <? if(isset($config['regions']) && $config['regions']) :?>
            
                <? $i = 0;?>
                <? foreach($config['regions'] as $region) :?>

                <div class="cta__region<?= ($i + 1) % 3 === 0 ? ' last' : '';?>">

                    <img src="<?= \Arr::get($region, 'image');?>" alt="<?= \Arr::get($region, 'title');?>" class="scale-with-grid">

                    <h5><?= \Arr::get($region, 'title', 'Default');?></h5>
                    <p><?= \Str::truncate(\Arr::get($region, 'content', 'Default content, please add your own.'), 200, '...');?></p>

                    <? if(isset($region['button'])) :?>
                   
                    <a href="<?= $region['button']['link'];?>" class="cta__button" title="<?= $region['button']['text'];?>"><?= $region['button']['text'];?></a>

                    <? endif;?>
               
                </div>           
                <? $i++;?>
            <? endforeach;?>
        
        <? else: ?>
      
          <p>CTA: Please set up some regions in your config.</p>
      
        <? endif;?>  
        
    </div>
    
</div>