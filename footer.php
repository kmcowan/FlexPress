<?php
?>
   </div><!-- .container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('sidebar-footer')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('sidebar-footer'); ?>
                </div>
            <?php endif; ?>

            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php _e('All rights reserved.', 'flexpress'); ?></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>