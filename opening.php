<div class="row">

	<div class="centre-wrap centre-wrap--centred centre-wrap--no">
		
		<div class="opening">
        	
        	<div>
		        <h3 class="banner">
		            <span>Opening Times</span>
		        </h3>   
		    </div>     

	        <div class="opening__col">
		
		        <p class="text-upper">
		        	Opening Times
		        </p>

		        <ul>

			        <? if (isset($config['opening-times'])) : ?>

			        	<? $opening = $config['opening-times'];  ?>

				        <?php foreach ($opening as $key => $times): ?>
				        		
				        	<li><?= $key;?> <?=$times?></li>

				        <?php endforeach ?>

				    <? endif ?>

				</ul>

			</div>

			<div class="opening__col">
		        
		        <p class="text-upper">
		        	Opening Times
		        </p>

		        <ul>

			        <? if (isset($config['food-times'])) : ?>

			        	<? $opening = $config['food-times'];  ?>

				        <?php foreach ($opening as $key => $times): ?>
				        		
				        	<li><?= $key;?> <?=$times?></li>

				        <?php endforeach ?>

				    <? endif ?>

				</ul>
			
			</div>

		</div>
		
	</div>

</div>
