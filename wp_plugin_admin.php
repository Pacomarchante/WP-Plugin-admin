<?php
/*
Plugin Name: WP Plugin admin
Plugin URI: https://github.com/Pacomarchante/plugin_admin
Description: Example of admin panel for a WordPress plugin.
Author: Paco Marchante
Author URI: https://github.com/Pacomarchante/

Version: 1.0.0
License: GPLv2 or later.
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * plugin_admin
 *
 * @since      1.0.0
 * 
 * Registra una configuración
 * https://developer.wordpress.org/reference/functions/register_setting/
 */
add_action( "admin_init" , "pc_init" );

function pc_init() {

    register_setting( "pc_option" , "pc_nombre" );

}

/**
 * plugin_admin
 *
 * @since      1.0.0
 * 
 * Añade la página del plugin en el administrador de WordPress
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 */
add_action("admin_menu" , "pc_pagina" );
 
function pc_pagina() {
    
    add_menu_page( "plugin page",   //  Título tag
        "Plugin page",              //  Título que utiliza para mostrar en el backend
        "manage_options",           //  Capability https://codex.wordpress.org/Roles_and_Capabilities
        "plugin-page",              //  Slug
        "pc_page",                  //  Función
        "dashicons-admin-plugins"   //  Icono
    );
}


/**
 * plugin_admin
 *
 * @since      1.0.0
 * 
 * Ejemplo de página de administración
 */
function pc_page(){
    ?>
    <div class="wrap">

        <?php screen_icon(); ?>

        <h2><?php _e( "Plugin Admin" , "plugin_admin" ); ?></h2>

        <form action="options.php" method="post">

            <?php settings_fields( "pc_option" ); ?>
            <?php @do_settings_fields( "plugin-page" , "pc_option" ); ?>

            <table class="form-table">

                <tbody>     

                    <tr>

                        <th><?php _e( "Nombre" , "plugin_admin" ); ?></th>
                        <td><input type="text" name="pc_nombre" id="pc_nombre" value="<?php echo get_option( "pc_nombre" ); ?>"></td>

                    </tr>

                </tbody>

            <table>

            <p><?php @submit_button(); ?></p>

        </form>

        <?php settings_errors(); // Notificaciones cuando guardamos los datos ?> 

    </div>
    <?php
}

/**
 * plugin_admin
 *
 * @since      1.0.0
 * 
 * Reemplaza el footer de WordPress en la pagina de tu plugin
 *
*/
add_filter( "admin_footer_text" , "pc_custom_admin_footer" );

function pc_custom_admin_footer( $footer_text ) {
    
    if ( isset( $_GET[ "page" ] ) && $_GET[ "page" ] == "plugin-page" ) { // No te olvides de cambiar "plugin-page" por el slug de tu página de administración

        $footer_text = __( 'Thanks for using plugin page example, plugin made by <a href="https://github.com/Pacomarchante/ target="_blank" rel="nofollow">Paco Marchante</a>.' );

    }
    return $footer_text;
}

