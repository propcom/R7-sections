<? 

    require_once '/var/www/shared/5.3/autoloader.php';
    Shared_Autoloader::forge()->setVersion('v1')->register();
    
    $gallery_id = \Arr::get($config, 'gallery');
    $sub_title = \Arr::get($config, 'subtitle');
    $gallery = \Prop\CP\Galleries\Gallery::forge($siteid, $gallery_id);
    $albums = $gallery->get_albums();

?>


<section class="gallery">
    
    <div class="centre-wrap centre-wrap--centred">
        <h1 class="banner">
            <span>Gallery</span>
        </h1>
        <? if($sub_title): ?>
            <p><?= $sub_title; ?></p>
            <br>
        <? endif; ?>
    </div>

    <? $images = array(); ?>
    
    <? foreach ($albums as $album) : ?>

        <? $image_set = $album->images();?>

        <? foreach($image_set as $image): ?>

            <? array_push($images, $image); ?>
        
        <? endforeach; ?>

    <? endforeach; ?>

    <div class="js-gallery">

        <? $i = 1; ?>

        <? foreach($images as $index => $image): ?>

            <? if(($i == 1) || ($i == 7)): ?>
                <div class="gallery__section">
            <? endif; ?>

            <div class="js-gallery-img  gallery__img--bg  gallery__img<?= $i == 5 ? ' gallery__img--large  gallery__img--large--right' : ''; ?> <?= $i == 6 ? ' gallery__img--large  gallery__img--large--left' : '';?>" data-slide_index="<?= $index ?>">
                <span class="gallery__img--bg__img" style="background-image: url(<?= $image->get_src('medium');?>);"></span>
            </div>

            <? if(($i == 4) || ($i == 10) || ($index == count($images)-1)): ?>
                </div>
            <? endif; ?>
            
            <? $i++;?>

            <? if ($i == 11) : $i = 1; endif ?>

        <? endforeach;?>

    </div>
        
    <div class="gallery__full">

        <div class="gallery__slider">
            
            <div class="inner-slider">
                
                <? foreach($images as $image) :?>
                    
                    <img zRS-src="<?= $image->get_src('x-large');?>" alt="<?= $sitename;?>">

                <? endforeach;?>            

            </div>

            <a href="javascript:void(0);" class="gallery__nav prev">l</a>
            <a href="javascript:void(0);" class="gallery__nav next">r</a>
            
        </div> 

    </div>
    
</section>
