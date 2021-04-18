<?php

global $post;

?>

<?php get_header() ?>

<?php $queried_object = get_queried_object() ?>

<?php $theme_locations = get_nav_menu_locations() ?>

<section class="products">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 col-lg-3">

                <?php wp_nav_menu(array('container' => false, 'theme_location' => 'produktkategorier', 'menu_class' => 'product-menu')) ?>

            </div>
            <div class="col-12 col-lg-9">

            	<?php if (is_tax('produktkategori')) : ?>

            		<?php if (property_exists($queried_object, 'name') && !empty($queried_object->name)) : ?>

            			<h1 class="product-name"><?php echo $queried_object->name ?></h1>

            		<?php endif ?>

            		<?php if (property_exists($queried_object, 'description') && !empty($queried_object->description)) : ?>

            			<div class="products-description">
        					<?php echo $queried_object->description ?>
        				</div>

            		<?php endif ?>

            	<?php else : ?>

        			<h1>Alla produkter</h1>

            	<?php endif ?>

                <?php if (is_tax('produktkategori', 'reservdelar')) : ?>

                    <?php $term = get_queried_object() ?>

                    <?php $spare_part_groups = get_field('spare_part_groups') ?>

                    <div class="row">

                        <?php foreach ($spare_part_groups as $spare_part_group) : ?>

                            <div class="col-12 text-center text-lg-left">
                                <h6 class="mb-4">
                                    <?php echo $spare_part_group['spare_part_group'] ?>
                                </h6>
                            </div>

                            <?php foreach ($spare_part_group['spare_part_group_manufacturers'] as $spare_part_group_manufacturer) : ?>

                                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center">
                                    <div class="product">
                                        <div class="product-inner">

                                            <?php $image = getImage($spare_part_group_manufacturer['spare_part_group_manufacturer']) ?>

                                            <div class="product-thumbnail mb-3">

                                                <?php if (!empty($image['src'])) : ?>

                                                     <img class="img-fluid" src="<?php echo $image['src'] ?>" srcset="<?php echo $image['srcset'] ?>" sizes="<?php echo $image['sizes'] ?>" alt="<?php echo $image['alt'] ?>" />

                                                <?php else : ?>

                                                     <img src="<?php echo get_template_directory_uri() ?>/assets/images/product-placeholder.png" alt="produktbild-saknas" />

                                                <?php endif ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach ?>

                        <?php endforeach ?>

                    </div>

                    <?php require_once 'wp-content/themes/soderkyl/lib/form/form-offer.php'; ?>

        		<?php else : ?>

                    <?php if (have_posts()) : ?>

                        <div class="row">

                            <?php while (have_posts()) : the_post() ?>

                                <div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center">
                                    <div class="product">
                                        <div class="product-inner">

                                            <?php $image = get_the_post_thumbnail_url($product, 'thumbnail') ?>

                                            <div class="product-thumbnail mb-3">
                                                <a href="<?php echo get_permalink() ?>">

                                                    <?php if (!empty($image)) : ?>

                                                         <img src="<?php echo $image ?>" />

                                                    <?php else : ?>

                                                         <img src="<?php echo get_template_directory_uri() ?>/assets/images/product-placeholder.png" alt="produktbild-saknas" />

                                                    <?php endif ?>

                                                </a>
                                            </div>

                                            <div class="product-title">
                                                <a href="<?php the_permalink() ?>">
                                                    <?php the_title() ?>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php endwhile ?>

                        </div>

                    <?php else : ?>

                        <p class="text-secondary">
                            <i>Inga produkter hittades.</i>
                        </p>

                    <?php endif ?>

        		<?php endif ?>

	        </div>
	    </div>
	</div>
</section>

<div class="modal fade" id="thumbnail-modal" tabindex="-1" role="dialog" aria-labelledby="thumbnail-modal-label" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
			</div>
			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button>
			</div>
		</div>
	</div>
</div>

<?php get_footer() ?>
