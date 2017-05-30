<div class="js-book-dmn  book  book--dmn">

    <div class="v-align">

        <div class="v-align__table">

            <div class="v-align__cell">

                <div class="book__wrapper">

                	<a href="" class="js-toggle-dmn  book__close">X</a>

                    <h3 class="book__heading"><?= Arr::get($config, 'title');?></h3>

                    <script src="http://partners.designmynight.com/pf/js?venue_id=<?= Arr::get($config, 'restaurant-id');?>"></script>

                    <? if (Arr::get($config, 'tracking-id')): ?>
                        <script>
                            DMN.val('ga_account', '<?= Arr::get($config, 'tracking-id');?>');
                        </script>
                    <? endif ?>

                </div>

            </div>

        </div>

    </div>

</div>
