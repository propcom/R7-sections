<? 

    require_once '/var/www/shared/5.3/autoloader.php';
    Shared_Autoloader::forge()->setVersion('v1')->register();
    
    $gallery_id = \Arr::get($config, 'gallery');
    $sub_title = \Arr::get($config, 'sub_title');
    $gallery = \Prop\CP\Galleries\Gallery::forge($siteid, $gallery_id);
    $albums = $gallery->get_albums();

?>


<section class="gallery">
    
    <div class="centre-wrap centre-wrap--centred">
        <h1 class="banner">
            <span>Gallery</span>
        </h1>
        <? if($sub_title): ?>
            <h2>
                <span><?= $sub_title; ?></span>
            </h2>
        <? endif; ?>
    </div>

    <? $a = 0;?>
    
    <? foreach ($albums as $album) : ?>

        <div class="js-gallery">

            <? $images = $album->images();?>
            
            <? $i = 1; ?>
            
            <? foreach($images as $index => $image) :?>

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

        <? $a++;?>

    <? endforeach;?>
        
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
    

   