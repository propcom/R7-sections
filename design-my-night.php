<div class="popup-bg" data-popup="book"></div>

<div class="popup" data-popup="book">
    <div class="v-center">
        <div class="v-center__table">
            <div class="v-center__cell">
                <div class="popup__content">
                    <a href="" class="popup__close">X</a>
            <script src="http://partners.designmynight.com/pf/js?venue_id=<?= Arr::get($config, 'restaurant-id');?>"></script>

            <? foreach ($analytics as $tracking_code): ?>
            <script>
                DMN.val('ga_account', '<?= $tracking_code; ?>');
            </script>
            <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
