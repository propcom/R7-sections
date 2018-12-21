<div class="js-book-dmn  book  book--dmn">

    <div class="v-align">

        <div class="v-align__table">

            <div class="v-align__cell">

                <div class="book__wrapper">

                	<a href="" class="js-toggle-dmn  book__close">X</a>

                    <h3 class="book__heading"><?= Arr::get($config, 'title');?></h3>

                    <script src="https://partners.designmynight.com/pf/js?venue_id=<?= Arr::get($config, 'restaurant-id');?>"></script>

                    <? if (Arr::get($config, 'tracking-id')): ?>
                        <script>
                            DMN.val('ga_account', '<?= Arr::get($config, 'tracking-id');?>');
                        </script>
                    <? endif ?>
	                <? if (Arr::get($config, 'callback')): ?>
		                <script>
			                DMN.val('return_url', '<?= Uri::base(false) . $config['callback']; ?>?booking_complete=true');
			                DMN.val('return_method', 'post');
		                </script>
	                <? endif ?>

                </div>

            </div>

        </div>

    </div>

</div>
