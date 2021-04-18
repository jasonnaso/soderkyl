
<?php get_header() ?>

<?php $queried_object = get_queried_object() ?>

<?php $theme_locations = get_nav_menu_locations() ?>

<?php $pdf_repeater = get_field('pdf_repeater'); ?>


<section class="single-product">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 col-lg-3">

                <?php wp_nav_menu(array('container' => false, 'theme_location' => 'produktkategorier', 'menu_class' => 'product-menu', 'depth' => 2)) ?>

            </div>
            <div class="col-12 col-lg-9">

                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post() ?>

                        <div class="product">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php $image = getImage(get_post_thumbnail_id()) ?>

                                    <div class="product-thumbnail">

                                        <?php if (!empty($image['srcset'])) : ?>

                                            <a href="<?php echo get_permalink() ?>">
                                                <img src="<?php echo $image['src'] ?>" srcset="<?php echo $image['srcset'] ?>" sizes="<?php echo $image['sizes'] ?>" alt="<?php echo $image['alt'] ?>" />
                                            </a>

                                        <?php else : ?>

                                             <img src="<?php echo get_template_directory_uri() ?>/assets/images/product-placeholder.png" alt="produktbild-saknas" />

                                        <?php endif ?>

                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <div class="product-title">
                                        <h1><?php the_title() ?></h1>
                                    </div>

                                    <div class="product-description">
                                        <?php the_content() ?>
                                    </div>

                                    <div class="product-info-button mb-3">
                                        <a class="btn btn-product-info primary-button-small" target="_blank" href="#">Kontakta oss om produkt</a>
                                    </div>

                                    <div class="pdf-button">
                                        <?php if($pdf_repeater) : ?>
                                             <?php foreach ($pdf_repeater as $k => $r) : ?>
                                                <a class="btn btn-info primary-button-small" target="_blank" href="<?= $r['pdf_file']['url']; ?>">Produktdatablad</a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>

        			<?php endwhile ?>

        		<?php else : ?>

        			<p>Produkten kunde inte hittas.</p>

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

<?php require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. 'lib' . DIRECTORY_SEPARATOR . 'form' . DIRECTORY_SEPARATOR . 'form-product.php'); ?>

<?php get_footer() ?>
