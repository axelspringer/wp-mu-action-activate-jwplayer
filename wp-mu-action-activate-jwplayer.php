<?php

add_action( 'init', function () {
    $plugin = 'jw-player/jw-player.php';

    // do nothing aas we have not config
    if ( ! defined( 'JW_PLAYER_API_KEY' ) ||
         ! defined( 'JW_PLAYER_API_SECRET' )
    ) {
        return;
    }

    // check to include
    if ( ! function_exists( 'is_plugin_inactive' ) ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    if ( is_plugin_inactive( $plugin ) ) {
        $success = activate_plugin( $plugin );

        // doesn't matter
        if ( $success !== null ) {
            return;
        }
    }

    $settings = [
        'jwplayer_api_key'    => JW_PLAYER_API_KEY,
        'jwplayer_api_secret' => JW_PLAYER_API_SECRET
    ];

    foreach ( $settings as $setting => $value ) {
        // ambitious
        update_option( $setting, $value, true );
    }
} );
