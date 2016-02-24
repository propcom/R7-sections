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

            <? if(($i == 1) || ($i == 7)): ?>
                <div class="gallery__section">
            <? endif; ?>


            <div class="js-gallery-img  gallery__img--bg  gallery__img<?= $i == 5 ? ' gallery__img--large  gallery__img--large--right' : ''; ?> <?= $i == 6 ? ' gallery__img--large  gallery__img--large--left' : '';?>">
                <span class="gallery__img--bg__img" style="background-image: url(<?= $image->get_src('medium');?>);"></span>
            </div>

            <? if(($i == 4) || ($i == 10)): ?>
                </div>
            <? endif; ?>

        
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
    

   