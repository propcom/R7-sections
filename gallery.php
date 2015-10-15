<? 

    require_once '/var/www/shared/5.3/autoloader.php';
    Shared_Autoloader::forge()->setVersion('v1')->register();
    
    $gallery_id = \Arr::get($config, 'gallery');
    $gallery = \Prop\CP\Galleries\Gallery::forge($siteid, $gallery_id);
    $albums = $gallery->get_albums();

?>

<section class="gallery">
    
    <div class="centre-wrap centre-wrap--centred">
       
    <h3 class="banner"><span><?= Arr::get($config, 'title', 'Gallery');?></span></h3>
        
    <? $a = 0;?>
    <? foreach($albums as $album) :?>
    <div class="gallery__content" data-album="<?= $a;?>">
        <? $images = $album->images();?>
        <? $i = 0;?>
        <? foreach($images as $image) :?>
        <div class="gallery__img<?= ($i + 1) % 3 === 0 ? ' last' : '';?>">
            <div class="js-imager" data-src="<?= $image->get_src('medium');?>" data-height="400" data-width="600"></div>
            <noscript>
                <img src="<?= $image->get_src();?>" alt="<?= $sitename;?>">                    
            </noscript>
        </div>
        <? $i++;?>
        <? endforeach;?>
    </div>
    <? $a++;?>
    <? endforeach;?>
        
    </div>
    
    <div class="gallery__full">
    <? foreach($albums as $album) :?>
        <div class="gallery__slider">
            <div class="inner-slider">
            <? $images = $album->images();?>
            <? foreach($images as $image) :?>
                <img zRS-src="<?= $image->get_src('x-large');?>" alt="<?= $sitename;?>">
            <? endforeach;?>            
            </div>

            <a href="javascript:void(0);" class="gallery__nav prev">l</a>
            <a href="javascript:void(0);" class="gallery__nav next">r</a>
            
        </div>    
    <? endforeach;?>
    </div>
    
</section>
    

   