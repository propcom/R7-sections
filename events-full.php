<?
	require_once '/var/www/shared/5.3/autoloader.php';
	Shared_Autoloader::forge()->setVersion( 'v1' )->register();

	$calendar_id = \Arr::get( $config, 'calendar' );
	$calendar    = \Prop\CP\Events\Calendar::forge( $siteid, $calendar_id );

	$get_month   = ( isset( $_GET['month'] ) ? date( 'M', strtotime( $_GET['month'], strtotime( 'first day of this month' ) ) ) : date( 'M' ) );
	$event_month = ( isset( $_GET['month'] ) ? date( 'd M Y', strtotime( $_GET['month'], strtotime( 'first day of this month' ) ) ) : date( 'M Y' ) );

	$month_days = cal_days_in_month( CAL_GREGORIAN, ( date( 'n', strtotime( $event_month ) ) ), ( date( 'Y', strtotime( $event_month ) ) ) );

	if ( time() > strtotime('+'.$month_days.'days', strtotime($event_month)) ) {

		$event_month = date( 'M Y', strtotime( '+1 year', strtotime( $event_month ) ) );

	}

	$events = $calendar->get_events( $event_month, 'last day of this month', 100 );

?>

<div class="events events--full events--margin">

	<div class="centre-wrap centre-wrap--centred centre-wrap--no">

		<? if ( \Arr::get( $config, 'title' ) ) : ?>

			<h1 class="banner">
				<span><?= \Arr::get( $config, 'title' ); ?></span>
			</h1>

		<? endif ?>

		<p class="larger"><?= \Arr::get( $config, 'subtitle' ); ?></p>

		<div class="events__container events__container--narrow">
			<div class="events__months">
				<ul>
					<? for ( $m = 1; $m <= 12; $m ++ ) : ?>
						<? $month = date( 'M', mktime( 0, 0, 0, $m, 1, date( 'Y' ) ) ); ?>
						<li><a href="/<?= \Arr::get( $config, 'url', 'events' ); ?>?month=<?= $month; ?>"<?= $month === $get_month ? ' class="active"' : ''; ?>><?= $month; ?></a></li>
					<? endfor; ?>
				</ul>
			</div>

			<? $todaysDate = time(); ?>

			<? if ( $events ) : ?>
				<? foreach ( $events as $date => $date_events ): ?>
					<? foreach ( $date_events as $event ): ?>


						<? $date = strtotime( $event->date_start ); ?>

						<div class="events__entry  <? if ( $date < $todaysDate ) : ?> events__entry--past <? endif ?>" id="<?= $event->id; ?>">


							<? if ( $event->image_id ) : ?>
								<div class="events__img  js-bg" data-bg="<?= $event->image->get_src( 'large' ); ?>"></div>
							<? else : ?>
								<div class="events__img">
									<div class="js-imager" data-class="fit" data-src="/assets/img/regions/events/small-ph.png" data-alt="<?= $event->name; ?>"></div>
									<noscript>
										<img src="/assets/img/regions/events/small-ph.png" class="fit" alt="<?= $event->name; ?>" height="185" width="265">
									</noscript>
								</div>
							<? endif; ?>

							<div class="events__full-info">
								<div class="events__date events__date--small" id="<?= date( 'd', $date ); ?>">
									<span><?= date( 'F', $date ); ?></span>
									<p><?= date( 'd', $date ); ?></p>
									<span><?= date( 'Y', $date ); ?></span>
								</div>
								<div class="events__title">
									<h5><?= $event->name; ?></h5>
									<? if ( strtotime( $event->date_start ) != strtotime( $event->date_end ) ) : ?>
										<p class="events__start"><?= date( 'g.iA', strtotime( $event->date_start ) ); ?> - <?= date( 'g.iA', strtotime( $event->date_end ) ); ?></p>
									<? else : ?>
										<p class="events__start"><?= date( 'g.iA', strtotime( $event->date_start ) ); ?></p>
									<? endif; ?>
								</div>
								<div class="events__content">
									<?= $event->description; ?>

									<? if ( $event->booking_link || $event->more_info_link ) : ?>
										<div class="events__buttons">
											<? if ( $event->booking_link ) : ?>
												<a class="button__button button__button--narrow" href="<?= $event->booking_link; ?>" target="_blank">Book</a>
											<? endif; ?>
											<? if ( $event->more_info_link ) : ?>
												<a class="button__button button__button--narrow" href="<?= $event->more_info_link; ?>" target="_blank">Read More</a>
											<? endif; ?>
										</div>
									<? endif; ?>
								</div>
							</div>
						</div>
					<? endforeach; ?>
				<? endforeach; ?>
			<? else: ?>

				<p>We currently don't have any events planned for <span class="highlight"><?= date( 'F Y', strtotime( $event_month ) ); ?></span>, please check back soon for updates.</p>

			<? endif; ?>

			<p class="events__disclaimer">
                Please be advised that Young’s only sells tickets for events through our official partner DesignMyNight, using their online event ticketing software Tonic – any tickets presented from other event ticketing providers will not be accepted.
            </p>
            
		</div>

	</div>

</div>