<?php
/**
 * Template Name: Home page
 */

get_header();

$estates = get_posts([
    'post_type' => 'estate',
    'posts_per_page' => -1,
    'orderby'   => 'date',
	'order'     => 'DESC',
]);

$cities = get_posts([
    'post_type' => 'city',
    'posts_per_page' => -1,
    'orderby'   => 'title',
	'order'     => 'ASC',
]);

?>

<section class="estate p-5">
    <div class="container">
        
        <h2 class="mb-5"><?= __('Недвижимость'); ?></h2>

        <?php if ($estates) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
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
                    <?php foreach($estates as $item) : ?>
                        
                        <tr>
                            <th scope="row">
                                <?= $item->ID; ?>
                            </th>
                            <th scope="row">
                                <a href="<?= get_the_permalink($item->ID); ?>">
                                    <?= $item->post_title; ?>
                                </a>
                            </th>
                            <td>
                                <?= get_the_post_thumbnail( $item->ID, [64, 64] ); ?>
                            </td>
                            <td>
                                <?= carbon_get_post_meta( $item->ID, 'estate_x__square' ); ?>
                            </td>
                            <td>
                                <?= carbon_get_post_meta( $item->ID, 'estate_x__living_area' ); ?>
                            </td>
                            <td>
                                <?= carbon_get_post_meta( $item->ID, 'estate_x__cost' ); ?>
                            </td>
                            <td>
                                <?= get_the_title($item->post_parent); ?>
                            </td>
                            <td>
                                <?= carbon_get_post_meta( $item->ID, 'estate_x__address' ); ?>
                            </td>
                            <td>
                                <?= carbon_get_post_meta( $item->ID, 'estate_x__floor' ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <?= __('Не найдено объектов недвижимости'); ?>
        <?php endif; ?>
    </div>
</section>

<section class="city p-5">
    <div class="container">
        
        <h2 class="mb-5"><?= __('Города'); ?></h2>

        <?php if ($cities) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Изображение</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cities as $item) : ?>
                        
                        <tr>
                            <th scope="row">
                                <?= $item->ID; ?>
                            </th>
                            <th scope="row">
                                <a href="<?= get_the_permalink($item->ID); ?>">
                                    <?= $item->post_title; ?>
                                </a>
                            </th>
                            <td>
                                <?= get_the_post_thumbnail( $item->ID, [64, 64] ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <?= __('Не найдено городов в базе'); ?>
        <?php endif; ?>
    </div>
</section>

<!-- Форма добавления недвижимости -->
<div class="container">
    <h2>Добавьте свою недвижимость</h2>

    <form id="new-estate-form">
        <div class="form-group mb-2">
            <label for="estateName">Наименование</label>
            <input type="text" class="form-control" id="estateName" name="estate_name" require>
        </div>
        
        <div class="form-group mb-2">
            <label for="estateDescription">Описание</label>
            <textarea class="form-control" id="estateDescription" name="estate_description"></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="estateSquare">Площадь</label>
            <input type="number" class="form-control" id="estateSquare" name="estate_square" require>
        </div>

        <div class="form-group mb-2">
            <label for="estateCost">Стоимость</label>
            <input type="number" class="form-control" id="estateCost" name="estate_cost" require>
        </div>

        <div class="form-group mb-2">
            <label for="estateAddress">Адрес</label>
            <input type="text" class="form-control" id="estateAddress" name="estate_address" require>
        </div>

        <div class="form-group mb-2">
            <label for="estateLivingArea">Жилая площадь</label>
            <input type="number" class="form-control" id="estateLivingArea" name="estate_living_area" require>
        </div>

        <div class="form-group mb-5">
            <label for="estateFloor">Этаж</label>
            <input type="number" class="form-control" id="estateFloor" name="estate_floor" require>
        </div>

        <div class="form-group mb-2">
            <label for="estateCity">Город</label>
            <select name="estate_city" id="estateCity">
                <?php foreach($cities as $item) : ?>
                    <option value="<?= $item->ID; ?>"><?= $item->post_title; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="checkbox" name="form_anticheck" id="form_anticheck" class="form_anticheck" style="display: none !important;" value="true" checked="checked"/>
	    <input type="text" name="form_submitted" id="form_submitted" value="" style="display: none !important;"/>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

<?php
get_footer();