<section class="button">

    <div class="centre-wrap centre-wrap--centred">
       
        <? foreach($config as $button) :?>
        
            <a href="<?= \Arr::get($button, 'link', '/');?>" class="button__button" title="<?= \Arr::get($button, 'label', 'Default');?>"><?= \Arr::get($button, 'label', 'Default');?>
                <span class="button__button__dots"></span>
            </a>
            
        <? endforeach; ?>
       
    </div>
    
</section>