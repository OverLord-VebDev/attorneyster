<?php
namespace ElementPack\Modules\CryptoCurrencyTable;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'crypto-currency-table';
	}

	public function get_widgets() {


		$widgets = ['Crypto_Currency_Table'];

		return $widgets;
	}
}