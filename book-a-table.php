<div class="book">

    <div class="centre-wrap centre-wrap--centred centre-wrap--small centre-wrap--no">

        <div class="book__wrapper">

            <a href="javscript:void(0);" class="anchor" id="booking"></a>

            <h3><?= Arr::get($config, 'title');?></h3>
            <p><?= Arr::get($config, 'subtitle');?></p>

            <script type="text/javascript" src="https://bda.bookatable.com/deploy/lbui.direct.min.js"></script>
            <script type="text/javascript">

                LBDirect_Embed({

                    connectionid : "<?= Arr::get($config, 'console');?>",
                    preselect  :  {

                       sessionid  : "<?= Arr::get($config, 'preselect')?>",

                    },
                    style : {

                        baseColor  :  "<?= Arr::get($config, 'color', "#000000");?>"

                    }
                });

            </script>

        </div>

    </div>

</div>
