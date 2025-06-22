<?php
?>

<?php
// File: index.php
get_header();
?>

    <main id="primary" class="site-main">
        <?php
        $sidebar_position = get_theme_mod('sidebar_position', 'right');
        $content_class = ($sidebar_position !== 'none') ? 'has-sidebar sidebar-' . $sidebar_position : 'no-sidebar';
        ?>

        <div class="content-area <?php echo esc_attr($content_class); ?>">
            <div class="primary-content">
                <?php
                if (have_posts()) :

                    if (is_home() && !is_front_page()) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text">
                                <?php single_post_title(); ?>
                            </h1>
                        </header>
                    <?php
                    endif;

                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php
                                if (is_singular()) :
                                    the_title('<h1 class="entry-title">', '</h1>');
                                else :
                                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                endif;
                                ?>
                            </header>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php
                                if (is_singular()) :
                                    the_content();
                                else :
                                    the_excerpt();
                                endif;
                                ?>
                            </div>

                            <footer class="entry-footer">
                                <?php
                                if ('post' === get_post_type()) :
                                    ?>
                                    <div class="entry-meta">
                                    <span class="posted-on">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                        <span class="byline">
                                        <?php _e('by', 'flexpress'); ?>
                                        <?php the_author_posts_link(); ?>
                                    </span>
                                    </div>
                                <?php
                                endif;
                                ?>
                            </footer>
                        </article>
                    <?php
                    endwhile;

                    the_posts_navigation();

                else :
                    ?>
                    <p><?php _e('Sorry, no posts found.', 'flexpress'); ?></p>
                <?php
                endif;
                ?>
            </div>

            <?php if ($sidebar_position !== 'none') : ?>
                <aside class="sidebar widget-area">
                    <?php dynamic_sidebar('sidebar-primary'); ?>
                </aside>
            <?php endif; ?>
        </div>
    </main>

<?php
get_footer();
?>