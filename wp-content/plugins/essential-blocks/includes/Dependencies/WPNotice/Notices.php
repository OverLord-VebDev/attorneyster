<?php

namespace EssentialBlocks\Dependencies\WPNotice;

use EssentialBlocks\Dependencies\WPNotice\Utils\Base;
use EssentialBlocks\Dependencies\WPNotice\Utils\Helper;
use EssentialBlocks\Dependencies\WPNotice\Utils\Storage;

final class Notices extends Base {
	use Helper;

	public $system_id = 'wpnotice_system';
	public $app       = 'wpnotice';
	public $version   = '1.0.0';

	private $args = array();

	private $storage = null;

	private $notices = array();
	private $queue   = array();

	private $scripts  = null;
	private $dev_mode = false;

	public function __get( $name ) {
		if ( property_exists( $this, $name ) ) {
			return $this->$name;
		}
	}

	public function __construct( $args ) {
		$this->system_id = ! empty( $args['id'] ) ? $args['id'] . '-notice-system' : $this->system_id;
		$this->app       = ! empty( $args['id'] ) ? $args['id'] : $this->app;
		$this->version   = ! empty( $args['version'] ) ? $args['version'] : '1.0.0';
		$this->dev_mode  = ! empty( $args['dev_mode'] ) ? $args['dev_mode'] : false;

		$this->args = $args;

		if ( ! empty( $args['styles'] ) ) {
			$this->scripts = $args['styles'];
			unset( $args['styles'] );
		}

		$this->queue = $this->storage()->get( '', array() );
	}

	public function storage() {
		return $this->database( $this->args );
	}

	public function init() {
		/**
		 * Return if Current page is editor
		 */
		global $pagenow;
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			return;
		}
		add_action( 'admin_notices', array( $this, 'notices' ) );
		add_action( 'admin_footer', array( $this, 'scripts' ) );
	}

	public function notices() {
		wp_enqueue_style( $this->system_id, $this->scripts, array(), ESSENTIAL_BLOCKS_VERSION );

		if ( ! $this->dev_mode ) {
			$current_notice = current( $this->eligible_notices() );
			if ( isset( $this->notices[ $current_notice ] ) ) {
				$this->notices[ $current_notice ]->display();
			}
		} else {
			foreach ( $this->notices as $key => $notice ) {
				$notice->display( true );
			}
		}
	}

	protected function eligible_notices() {
		$_sorted_quque = array();
		$_queue        = empty( $this->queue ) ? $this->notices : $this->queue;

		if ( ! empty( $_queue ) ) {
			array_walk(
				$_queue,
				function ( $value, $key ) use ( &$_sorted_quque ) {
					$notice = isset( $this->notices[ $key ] ) ? $this->notices[ $key ] : null;
					if ( ! is_null( $notice ) ) {
						if ( ! $notice->dismiss->is_dismissed() && ! $notice->is_expired() ) {
							$_sorted_quque[ $notice->options( 'start' ) ] = $key;
						}
					}
				}
			);
		}

		ksort( $_sorted_quque );

		return $_sorted_quque;
	}

	public function scripts() {
		$current_notice = current( $this->eligible_notices() );

		if ( isset( $this->notices[ $current_notice ] ) && ! $this->dev_mode ) {
			$notice = $this->notices[ $current_notice ];
			if ( $notice->show() ) {
				$notice->dismiss->print_script();
			}
		}

		if ( $this->dev_mode ) {
			foreach ( $this->notices as $key => $notice ) {
				$notice->dismiss->print_script();
			}
		}
	}

	public function add( $id, $content, $options = array() ) {
		$this->notices[ $id ] = new Notice( $id, $content, $options, $this->queue, $this );
	}
}
