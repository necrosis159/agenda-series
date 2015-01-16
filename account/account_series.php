<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";
?>
<div class="wrap">
    <section id="my_series">
        <section id="user_add_series">
            <h5 class="heading">Ajouter une série</h5>
            <div class="search_series">
                <form class="ajax" action="" method="get">
                    <input type="text" name="q" id="q" value="" placeholder="Rechercher...">
                    <input type="submit" value="">
                </form>
            </div>
        </section>
        <div id="results"></div>
        <section id="user_series">
            <h5 class="heading">Mes séries</h1>
                <?php
                $result = seriesUser();

                foreach ($result as $data) {
                    echo "<div class='serie_user'>";
                    echo "<img src='../images/" . $data['image'] . "'class='image_serie'>";
                    echo "</div>";
                }
                $result->closeCursor();
                ?>
        </section>
    </section>
</div>