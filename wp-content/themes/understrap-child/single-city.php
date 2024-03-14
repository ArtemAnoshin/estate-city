<?php

get_header();

$estates = get_children([
	'post_parent' => get_the_ID(),
	'post_type'   => 'estate',
	'numberposts' => 10,
]);

?>

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
                    <th scope="col">Объекты</th>
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
                        <?php if ($estates) : ?>

                            <?php foreach($estates as $item) : ?>
                                <p>
                                    <a href="<?= get_the_permalink($item->ID); ?>">
                                        <?= $item->post_title; ?>
                                    </a>
                                </p>
                            <?php endforeach; ?>    

                        <?php endif; ?>    
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