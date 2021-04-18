<?php get_header() ?>

    <main>
        <div class="container">

            <header class="page-header">
                <h1 class="page-title">
                    <?php printf(_e('Search results for:', 'twentynineteen') . ' %s', get_search_query()) ?>
                </h1>
            </header>

            <?php if (have_posts()) : ?>

                <section class="search-results">
                    <div class="container">

                        <?php while (have_posts()) : the_post() ?>

                            <div class="search-result">
                                <div class="row">
                                    <div class="col-12 col-lg-auto">

                                        <?php $image = getImage(get_post_thumbnail_id()) ?>

                                        <div class="search-result-thumbnail">
                                            <a href="<?php echo get_permalink() ?>">

                                                <?php if (!empty($image['srcset'])) : ?>

                                                     <img src="<?php echo $image['src'] ?>" srcset="<?php echo $image['srcset'] ?>" sizes="<?php echo $image['sizes'] ?>" alt="<?php echo $image['alt'] ?>" />

                                                <?php else : ?>

                                                     <img src="<?php echo get_template_directory_uri() ?>/assets/images/product-placeholder.png" alt="produktbild-saknas" />

                                                <?php endif ?>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <div class="search-result-title">
                                            <h6>
                                                <a href="<?php echo get_the_permalink() ?>">
                                                    <?php the_title() ?>
                                                </a>
                                            </h6>
                                        </div>

                                        <?php if (!empty(get_the_excerpt())) : ?>

                                            <div class="search-result-description">
                                                <?php the_excerpt() ?>
                                            </div>

                                        <?php else : ?>

                                            <p>Ingen beskrivning tillgänglig för denna sida.</p>

                                            <p>
                                                <a href="<?php echo get_the_permalink() ?>">Gå till sida</a>
                                            </p>

                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>

                            <hr>

                        <?php endwhile ?>

                    </div>
                </section>

            <?php else : ?>

                <h1>Hello!  Welcome, not sure which page you were looking for...</h1>

            <?php endif ?>

        </div>
    </main>

<?php get_footer() ?>

