<div class="js-book-dmn  book  book--dmn">

    <div class="centre-wrap centre-wrap--centred centre-wrap--small centre-wrap--no">
            
        <div class="book__wrapper">

        	<h3><?= Arr::get($config, 'title');?></h3>

        	<a href="" class="js-toggle-dmn  book__close">X</a>
                        
            <script src="http://partners.designmynight.com/pf/js?venue_id=<?= Arr::get($config, 'restaurant-id');?>"></script>

            <? foreach ($analytics as $tracking_code): ?>
                <script>
                    DMN.val('ga_account', '<?= $tracking_code; ?>');
                </script>
            <? endforeach; ?>

        </div>
    
    </div>

</div>