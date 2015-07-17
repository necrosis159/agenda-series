<script type="text/javascript" src="/js/account/account.js"></script>
<div class="wrap">
    <section id="my_series">
        <section id="user_add_series">
            <h5 class="heading">Ajouter une série</h5>
            <div class="search_series">
                <form class="ajax" action="" method="get">
                    <input type="text" name="q" id="q" value="" placeholder="Rechercher..." autocomplete="off">
                    <input type="button" class="button" value="Ajouter" id="add_serie_button">
                </form>
            </div>
        </section>
        <section id="user_series">
            <h5 class="heading">Mes séries</h5>
            <div id="series_follow">
                <?php
                if (count($data)):
                    ?>
                    <ul id="series_list">
                        <?php foreach ($data as $value) : ?>
                            <li class='serie_user'>
                                <span class="serie_delete" serie_id="<?php echo $value['serie_id'] ?>"><img src="/images/serie_delete.png"></span>
                                <a href="#"><p><span class="serie_txt_img"><?php echo $value['serie_name'] . "<br>" . "Note : " . $value['serie_notation'] ?></span></p><img src='<?php echo $value['serie_image']; ?>' class='image_serie'></a>
                                <span class="serie_title"><?php echo $value['serie_name']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                else :
                    echo "Vous ne suivez actuellement aucune série";
                endif;
                ?>
                <!-- Affichage du chargement supplémentaire de résultats s'il y en a et qu'il y en a plus que le nombre d'affichage de base -->
                <?php if (count($data) > 0 && count($data) > 5): ?>
                    <p style="text-align: center;">
                        <button class="button" id="loadMore">Charger plus</button>
                    </p>
                    <br>
                <?php endif; ?>
            </div>
        </section>
    </section>

</div>