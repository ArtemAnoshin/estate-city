<?php

function city_x__estate_city_metabox( $post ){
	$cities = get_posts(
        [
            'post_type' => 'city',
            'posts_per_page' => -1,
            'orderby' => 'post_title',
            'order' => 'ASC'
        ]
    );

	if ( $cities ) : ?>

		<div style="max-height:200px; overflow-y:auto;">
			<ul>

            <?php foreach( $cities as $city ) : ?>
                <li>
                    <label>
                        <input
                            type="radio"
                            name="post_parent"
                            value="<?= $city->ID; ?>"
                            <?php checked($city->ID, $post->post_parent, 1); ?>
                        >
                            <?= esc_html($city->post_title); ?>
                    </label>
                </li>
            <?php endforeach; ?>

            </ul>
		</div>
	<?php else : ?>
        <p><?= __('Городов нет...'); ?></p>
    <?php endif;
}