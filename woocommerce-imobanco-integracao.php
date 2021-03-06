<?php
/*
Plugin Name: WooCommerce Imopay gateway
Plugin URI: https://www.imobanco.com.br/
Description: Plugin para utilizar o gateway de pagamento do Imopay
Version: 0.0.2
Author: Imobanco
Author URI: https://www.imobanco.com.br/
License: GPLv2 or later
*/

namespace WoocommerceImobanco;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!defined('WOO_IMOPAY_SELLER_ID')) {

    trigger_error('Constant WOO_IMOPAY_SELLER_ID not defined in wp-config.php', E_USER_NOTICE);

} elseif (!defined('WOO_IMOPAY_API_KEY')) {

    trigger_error('Constant WOO_IMOPAY_API_KEY not defined in wp-config.php', E_USER_NOTICE);

} else {

    if (!defined('WOO_IMOPAY_API_URL')) {
        define('WOO_IMOPAY_API_URL', 'production' == WOO_IMOPAY_ENVIRONMENT ? 'https://34.196.253.77/' : 'http://test.imopay.com.br');
    }

    define('WOO_IMOPAY_PLUGIN_DIR', plugin_dir_path(__FILE__));

    define('WOO_IMOPAY_PLUGIN_URL', plugin_dir_url(__FILE__));

    if (!defined('WOO_IMOPAY_CREDITCARD_ORDER_DESCRIPTION')) {
        define('WOO_IMOPAY_CREDITCARD_ORDER_DESCRIPTION', get_bloginfo('name'). ' - Pedido no cartão de crédito');
    }

    if (!defined('WOO_IMOPAY_BILLET_ORDER_DESCRIPTION')) {
        define('WOO_IMOPAY_BILLET_ORDER_DESCRIPTION', get_bloginfo('name'). ' - Pedido no boleto');
    }

    if (!defined('WOO_IMOPAY_EXPIRATION_DATE_INCREMENT')) {
        define('WOO_IMOPAY_EXPIRATION_DATE_INCREMENT', '+3 days');
    }

    if (!defined('WOO_IMOPAY_LIMIT_DATE_INCREMENT')) {
        define('WOO_IMOPAY_LIMIT_DATE_INCREMENT', '+7 days');
    }

    define('WOO_IMOPAY_PLUGIN_SETTINGS', [
        'menu_title'        => 'Imobanco Integração',
        'tab_title'         => 'Imobanco Integração',
        'capability'        => 'manage_options',
        'icon'              => WOO_IMOPAY_PLUGIN_URL . 'assets/icon.ico" style="width:23px;height:auto',
        'field_labels' => [
            'first_name' => 'Nome',
            'last_name' => 'Sobrenome',
            'phone' => 'Telefone',
            'amount' => 'Valor',
            'description' => 'Descrição',
            'payer' => 'Pagador',
            'receiver' => 'Recebedor',
            'payment_method' => 'Método de pagamento',
            'holder_name' => 'Nome do titular',
            'card_number' => 'Número do cartão',
            'expration_month' => 'Mês de expiração',
            'expiration_year' => 'Ano de expiração',
            'security_code' => 'Código de segurança (CVV)'
        ]
    ]);

    require WOO_IMOPAY_PLUGIN_DIR . 'includes/functions.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/Request.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/hooks.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/api.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/forms/customfields.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/creditcard.php';
    require WOO_IMOPAY_PLUGIN_DIR . 'includes/billet.php';

    /** Admin area integration */
    // require WOO_IMOPAY_PLUGIN_DIR . 'includes/admin.php';

}