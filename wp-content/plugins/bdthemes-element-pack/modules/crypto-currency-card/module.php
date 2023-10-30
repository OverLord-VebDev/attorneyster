<?php
namespace ElementPack\Modules\CryptoCurrencyCard;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'crypto-currency-card';
	}

	public function get_widgets() {

		$widgets = ['Crypto_Currency_Card'];

		return $widgets;
	}
}