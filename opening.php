<div class="row">

	<div class="centre-wrap centre-wrap--centred centre-wrap--no">
		
		<div class="opening">
        	
        	<div>
		        <h3 class="banner">
		            <span>Opening Times</span>
		        </h3>   
		    </div>

		    <?php foreach($config as $key => $data): ?>

	        <div class="opening__col">
		
			        <p class="text-upper">
			        	<?= $key ?>
			        </p>

			        <ul>

				        <? if (isset($config[$key])) : ?>

				        	<? $opening = $config[$key];  ?>

					        <?php foreach ($opening as $key => $times): ?>
					        		
					        	<li><?= $key;?>: <?=$times?></li>

					        <?php endforeach ?>

					    <? endif ?>

					</ul>

				</div>

			<?php endforeach; ?>

		</div>
		
	</div>

</div>
