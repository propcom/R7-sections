<div class="cta">
	<div class="centre-wrap centre-wrap--centred">
		<? if (isset($config['regions']) && $config['regions']) :?>
			<? $i = 0;?>

			<? foreach ($config['regions'] as $region) :?>
				<div class="cta__region<?= ($i + 1) % 3 === 0 ? ' last' : '';?>">
					<img src="<?= \Arr::get($region, 'image');?>" alt="<?= \Arr::get($region, 'title');?>" class="scale-with-grid">

					<h5><?= \Arr::get($region, 'title', 'Default');?></h5>

					<? $content = \Arr::get($region, 'content', 'Default content, please add your own.'); ?>

					<? if (is_string($content)): ?>
						<p><?= \Str::truncate($content, 200, '...');?></p>
					<? elseif (is_array($content)): ?>
						<? foreach ($content as $line): ?>
							<p><?= $line; ?></p>
						<? endforeach; ?>
					<? endif; ?>

					<? if (isset($region['button'])) :?>
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
