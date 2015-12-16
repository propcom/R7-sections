<div class="youtube">
    <div class="centre-wrap">        
       
        <? /* https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=<?= \Arr::get($config, 'playlist');?>&key=<?= \Arr::get($config, 'authKey');?> */?>
       
        <div class="youtube__border">
            <h4><?= \Arr::get($config, 'title', 'Default Title');?></h4>
            <div class="youtube__wrapper">
                <div id="player" class="youtube__player"></div>            
            </div>
        </div>
        
        <div class="youtube__buttons">
            <a href="gqp8PBBgZHw" class="button__button active">Example</a>
            <a href="fPkSzMyvbdM" class="button__button">Example</a>
            <a href="cJBM7Zg4lYc" class="button__button">Example</a>
            <a href="I1aRl-GKZOU" class="button__button">Example</a>
            <a href="iACoI3Y6vOM" class="button__button">Example</a>
            <a href="DZeVZ9gyq68" class="button__button">Example</a>
            <a href="lWrljqfWbV0" class="button__button">Example</a>
            <a href="L--T4LQViGw" class="button__button">Example</a>
        </div>
        
    </div>
</div>