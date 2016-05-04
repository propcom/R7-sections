<?

	require_once '/var/www/shared/5.3/autoloader.php';
	Shared_Autoloader::forge()->setVersion('v1')->register();

	$group_id = \Arr::get($config, 'group');
	$menu_group = \Prop\CP\Menus\Group::forge($siteid, $group_id);

    function contains($str, array $arr)
    {
        foreach($arr as $a) {
            if (stripos($str,$a) !== false) return true;
        }
        return false;
    }

?>
    
<div class="centre-wrap">

    <div class="menu">

        <nav class="menu__nav">
            <? $i = 0;?>
            <? $c = count($menu_group->menu_options_urls);?>

            <? foreach($menu_group->menu_options_urls as $url => $title) :?>
                           
                <? 
            
                $class = 'food';
            
                if(contains($title, ['lunch', 'dinner', 'food', 'main'])) {
                 
                    $class = 'food';
    
                } elseif(contains($title, ['wine', 'drinks', 'beer', 'drink'])) {
                    
                    $class = 'drink';
                    
                } elseif(contains($title, ['sunday'])) {
                    
                    $class = 'sunday';
                    
                } elseif(contains($title, ['kids', 'kid'])) {
                    
                    $class = 'kids';
                    
                } elseif(contains($title, ['brunch', 'breakfast', 'snack', 'snacks'])) {
                    
                    $class = 'brunch';
                    
                } ?>
               
                <? if(is_numeric($url)) :?>
                    <a class="<?= $class;?> <?= ($i + 1) % 3 === 0 ? 'last ' : '';?><?= $c >= 3 ? 'float ' : '';?>button__button  button__button--menu<?= $i === 0 ? ' active' : '' ?>" href="javascript:void(0);"><?= $title?></a>                    
                <? else :?>
                    <a class="<?= ($i + 1) % 3 === 0 ? 'last ' : '';?><?= $c >= 3 ? 'float ' : '';?>button__button  button__button--menu pdf" href="<?= $url ?>" target="_blank"><?= $title?></a>
                <? endif;?>
                <? $i++;?>
            <? endforeach;?>
        </nav>
        <div class="menu__container content__overlay">
            <div class="inner-slider">
                <? $i = 0;?>
                <? foreach($menu_group->menus as $menu) :?>
                <div class="menu__container--sub<?= $i == 0 ? ' active' : '';?>">
                <? switch ($menu->menu_type) : case 'pdf' :?><? break;?>                
                <? case 'itemised' :?>
                <? foreach($menu->categories as $items) : ?>
                    
                    <div class="menu__cat-title">
                        <h3><?= $items['name'];?></h3>
                        <div class="menu__entry--info">
                            <? foreach($items['columns'] as $cell) : ?>

                                <p><?= strip_tags($cell);?></p>

                            <? endforeach;?>
                        </div>
                    </div>
                    

                    <? foreach($items['items'] as $item) :?>

                        <div class="menu__entry">
                            <div class="menu__entry--description">
                                <p class="title">
                                    <?= strip_tags($item['name']);?>
                                </p>
                                <p>
                                    <?= strip_tags($item['description']);?>
                                </p>
                            </div>
                        
                            <div class="menu__entry--info menu__entry--cat">
                                <? if($item['cells'][0] !== ''): foreach($items['columns'] as $cell) : ?>

                                    <p><?= strip_tags($cell);?></p>

                                <? endforeach; endif; ?>
                            </div>

                            <div class="menu__entry--info">
                            <? foreach($item['cells'] as $cell) : ?>

                                <p><?= strip_tags($cell);?></p>

                            <? endforeach;?>
                            </div>

                        </div>

                    <? endforeach;?>

                <? endforeach;?>

                <? break;?>

                <? case 'text' :?>

                    <? default :?>

                    <h1><?= $menu->name;?></h1>                    
                    <p><?= $menu->content;?></p>

                <? break;?>               

                <? endswitch;?>

            </div>
            <? $i++;?>
            <? endforeach;?>
            </div>				
        </div>
    </div>

</div>
