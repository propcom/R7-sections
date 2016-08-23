<?php

class Instagram {

	public $result;
	public $count;
	public $error = false;

	public function __construct() {

		$this->user_id = 414143281;
		$this->count = 20;
		$this->token = '414143281.e2a9043.6d4acb839c38488f831d826bf29d32fe';

		try {

			$this->result = json_decode( $this->fetch( 'https://api.instagram.com/v1/users/'. $this->user_id .'/media/recent?count=' . $this->count . '&access_token=' . $this->token ) );

			if ( isset( $this->result->meta->error_message ) ) {

				$this->error = $this->result->meta->error_message;

			} else {

				$this->result = $this->result->data;

			}

		} catch ( Exception $e ) {

			$this->error = 'Unable to Sign Up to Instagram';

		};

	}

	public function fetch( $url ) {

		try {

			$last_modified = filemtime( DOCROOT . '/data/instagram.json' );

			if ( time() - $last_modified < ( 60 * 5 ) ) {

				$result = file_get_contents( DOCROOT . '/data/instagram.json' );

				return $result;

			}

		} catch ( Exception $e ) {
		};

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
		$result = curl_exec( $ch );
		curl_close( $ch );

		file_put_contents( DOCROOT . '/data/instagram.json', $result );

		return $result;

	}

}

$insta = new Instagram();

?>

<div class="instagram">

	<? if ( ! $insta->error ) : ?>

		<div class="instagram__slider">
			<div class="inner-slider">
				<? $i = 0; ?>
				<? foreach ( $insta->result as $photo ) : ?>

				<? if ( $i % 5 === 0 ) : ?>

				<? if ( $i != 0 ) : ?>

			</div>

			<? endif; ?>

			<div class="instagram__block instagram__large">

				<? endif; ?>

				<? if ( $i % 5 === 0 ) {
					$src = $photo->images->standard_resolution;
				} else {
					$src = $photo->images->low_resolution;
				} ?>

				<? if ( $i === 7 || $i === 19 ) : ?>

					<a href="<?= $social['instagram']; ?>" target="_blank" title="<?= $sitename; ?>" class="instagram__link">

						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" zRS-src="<?= $src->url; ?>" alt="<?= $sitename; ?>" height="<?= $src->height; ?>" width="<?= $src->width; ?>">
                            <span class="instagram__link--content">
	                            <span class="instagram__link--content--inner">
		                            <p>
			                            instagram<br/>
			                            <?= \Arr::get( $config, 'title', '#youngs_r7' ); ?>
		                            </p>
	                                <p class="follow">Follow</p>
	                            </span>
                            </span>
					</a>

				<? else : ?>

					<a href="<?= $photo->link; ?>" target="_blank" title="<?= $photo->caption->text; ?>">
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" zRS-src="<?= $src->url; ?>" alt="<?= $sitename; ?>" height="<?= $src->height; ?>" width="<?= $src->width; ?>">
					</a>

				<? endif; ?>
				<? if ( $i % 5 === 0 ) : ?>

			</div>
			<div class="instagram__block instagram__small">

				<? endif; ?>

				<? $i ++; ?>
				<? endforeach; ?>
			</div>
		</div>

	<? else : ?>

		<div class="centre-wrap">

			<p><?= $insta->error; ?></p>

		</div>

	<? endif; ?>

</div>

</div>