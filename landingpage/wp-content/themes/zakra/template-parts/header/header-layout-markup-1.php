<?php
if ( ! get_theme_mod( 'zakra_enable_dual_menu', false ) ) {
    /**
     * Fires before block one of header main area.
     *
     * @since 1.5.0
     *
     */
    do_action( 'zakra_header_block_one_before' );
    ?>

    <div class="tg-block tg-block--one">

        <?php zakra_header_block_one(); ?>

    </div> <!-- /.tg-site-header__block--one -->

    <?php
    /**
     * Fires before block two of header main area.
     *
     * @since 1.5.0
     *
     */
    do_action( 'zakra_header_block_two_before' );
    ?>

    <div class="tg-block tg-block--two">

        <?php zakra_header_block_two(); ?>

    </div> <!-- /.tg-site-header__block-two -->

    <?php
}

