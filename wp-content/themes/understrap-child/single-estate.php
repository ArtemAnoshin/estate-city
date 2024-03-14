<?php get_header(); ?>

<div class="container">
    <?php

    while ( have_posts() ) {
        the_post();
        ?>

        <h2 class="mb-5"><?= get_the_title(); ?></h2>

        <div class="content">
            <?php the_content(); ?>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Изображение</th>
                    <th scope="col">Площадь, м2</th>
                    <th scope="col">Жилая площадь, м2</th>
                    <th scope="col">Стоимость, руб</th>
                    <th scope="col">Город</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Этаж</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <?= get_the_ID(); ?>
                    </th>
                    <td>
                        <?= get_the_post_thumbnail( get_the_ID(), [64, 64] ); ?>
                    </td>
                    <td>
                        <?= carbon_get_post_meta( get_the_ID(), 'estate_x__square' ); ?>
                    </td>
                    <td>
                        <?= carbon_get_post_meta( get_the_ID(), 'estate_x__living_area' ); ?>
                    </td>
                    <td>
                        <?= carbon_get_post_meta( get_the_ID(), 'estate_x__cost' ); ?>
                    </td>
                    <td>
                        <?= get_the_title(wp_get_post_parent_id()); ?>
                    </td>
                    <td>
                        <?= carbon_get_post_meta( get_the_ID(), 'estate_x__address' ); ?>
                    </td>
                    <td>
                        <?= carbon_get_post_meta( get_the_ID(), 'estate_x__floor' ); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
        understrap_post_nav();
    }

    ?>
</div>

<?php get_footer();