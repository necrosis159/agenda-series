<script type="text/javascript" src="/js/account/account.js"></script>
<div id="profile_bloc">
    <div class="wrap">
        <h1 class="heading">Profil de <?php echo $result['user_username']; ?></h1>
        <div id="profile_user">
            <div id="profile_avatar">
                <img src="/images/avatar/<?php echo $result["user_avatar"]; ?>" class="avatar_image">
            </div>
            <div id="profile_informations">
                <h1 class="heading"><?php echo $result['user_username']; ?></h1>
                <ul>
                    <li>Inscription le <?php echo $result['user_creation_date']; ?></li>
                    <li>Age : <?php echo $age; ?> ans</li>
                    <li>Dernière connexion : <?php echo $result['user_last_login']; ?></li>
                    <li>Nombre de séries suivies : <?php echo $nb_series_follow; ?></li>
                    <li>Nombre de commentaires postés : <?php echo $nb_comments_posted;   ?></li>
                    <li>Inscrit à la newsletter : <?php if ($result['user_newsletter'] == 1) echo 'Oui' ; else echo 'Non';   ?></li>
                </ul>
            </div>
        </div>
        
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
                                <a href="/serie/<?php echo $value['serie_id'] ?>"><p><span class="serie_txt_img"><?php echo $value['serie_name'] . "<br>" . "Note : " . $value['serie_notation'] ?></span></p><img src='<?php echo $value['serie_image']; ?>' class='image_serie'></a>
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
                    <div id="showMore">
                        <button class="button" id="loadMore">Charger plus</button>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
