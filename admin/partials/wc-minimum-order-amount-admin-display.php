<?php

/**
 * The admin area view for the plugin
 *
 * @link       https://costinbotez.co.uk
 * @since      1.0.0
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/admin/partials
 */
?>


<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <form action="options.php" method="post">
        <?php
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );
            submit_button();
        ?>
    </form>
</div>
