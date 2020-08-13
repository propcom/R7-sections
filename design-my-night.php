<div class="js-book-dmn  book  book--dmn">

    <div class="v-align">

        <div class="v-align__table">

            <div class="v-align__cell">

                <div class="book__wrapper">

                	<a href="" class="js-toggle-dmn  book__close">X</a>

                    <h3 class="book__heading"><?= Arr::get($config, 'title');?></h3>

                    <link rel="stylesheet" type="text/css" href="//onsass.designmynight.com?theme=default">

					<script 
						src="//widgets.designmynight.com/bookings-partner.min.js"
						dmn-booking-form="true"
						venue="<?= Arr::get($config, 'restaurant-id');?>"
						hide-offers="false"
						hide-powered-by="false"
						search-venues="false"
						monday-first="true"
						custom-source="Own Website"
						google-analytics-code="<?= Arr::get($config, 'tracking-id');?>"
						return-url="<?= Uri::base(false) . $config['callback']; ?>?booking_complete=true"
						ref="book-region"
						show-type-first="true"
                        >
					</script>

                </div>

            </div>

        </div>

    </div>

</div>
