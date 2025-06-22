// File: single.php
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
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                        <div class="entry-meta">
                            <span class="posted-on">
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <?php _e('by', 'flexpress'); ?>
                                <?php the_author_posts_link(); ?>
                            </span>
                            <span class="cat-links">
                                <?php _e('in', 'flexpress'); ?>
                                <?php the_category(', '); ?>
                            </span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="entry-footer">
                        <?php the_tags('<div class="tag-links">' . __('Tags: ', 'flexpress'), ', ', '</div>'); ?>
                    </footer>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

                // Previous/next post navigation.
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'flexpress') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . __('Next:', 'flexpress') . '</span> <span class="nav-title">%title</span>',
                ));

            endwhile;
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