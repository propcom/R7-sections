<section class="button">

    <div class="centre-wrap centre-wrap--centred">
       
        <? foreach($config as $button) :?>
        
            <a href="<?= \Arr::get($button, 'link', '/');?>" class="button__button  <?= \Arr::get($button, 'class', '');?>" title="<?= \Arr::get($button, 'label', 'Default');?>"><?= \Arr::get($button, 'label', 'Default');?></a>
            
        <? endforeach; ?>
       
    </div>
    
</section>