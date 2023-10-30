<?php

namespace ElementPack\Modules\AnimatedGradientBackground;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementPack\Base\Element_Pack_Module_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

    public function __construct() {
        parent::__construct();
        $this->add_actions();
    }

    public function get_name() {
        return 'bdt-animated-gradient-background';
    }

    public function register_section($element) {
        $element->start_controls_section(
            'element_pack_agbg_section',
            [
                'tab' => Controls_Manager::TAB_STYLE,
                'label' => BDTEP_CP . esc_html__('Animated Gradient Background', 'bdthemes-element-pack') . BDTEP_NC,
            ]
        );
        $element->end_controls_section();
    }

    public function register_controls($section, $args) {

        $section->add_control(
            'element_pack_agbg_show',
            [
                'label' => __('Use Animated Gradient Background', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'frontend_available' => true,
                'render_type' => 'template',
                'prefix_class' => 'element-pack-agbg-',
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'start_color',
            [
                'label'   => __('Start Color', 'bdthemes-element-pack'),
                'default' => '#0591F9',
                'type'    => Controls_Manager::COLOR,
            ]
        );
        $repeater->add_control(
            'end_color',
            [
                'label'   => __('End Color', 'bdthemes-element-pack'),
                'default' => '#fefefe',
                'type'    => Controls_Manager::COLOR,
            ]
        );
        $section->add_control(
            'element_pack_agbg_color_list',
            [
                'label'   => __('Color List', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'frontend_available' => true,
                'render_type' => 'none',
                'default' => [
                    [
                        'start_color'   => __('#0591F9', 'bdthemes-element-pack'),
                        'end_color'   => __('#fefefe', 'bdthemes-element-pack'),
                    ],
                    [
                        'start_color'   => __('#567445', 'bdthemes-element-pack'),
                        'end_color'   => __('#1D1BE0', 'bdthemes-element-pack'),
                    ],
                ],
                'title_field' => '{{start_color}}',
                'condition' => [
                    'element_pack_agbg_show' => 'yes'
                ]
            ]
        );
        $section->add_control(
            'element_pack_agbg_blending_mode',
            [
                'label'      => __('Blend Mode', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'hue',
                'options'    => [
                    'multiply'    => __('Multiply', 'bdthemes-element-pack'),
                    'screen'      => __('Screen', 'bdthemes-element-pack'),
                    'normal'      => __('Normal', 'bdthemes-element-pack'),
                    'overlay'     => __('Overlay', 'bdthemes-element-pack'),
                    'darken'      => __('Darken', 'bdthemes-element-pack'),
                    'lighten'     => __('Lighten', 'bdthemes-element-pack'),
                    'color-dodge' => __('Color Dodge', 'bdthemes-element-pack'),
                    'color-burn'  => __('Color Burn', 'bdthemes-element-pack'),
                    'hard-light'  => __('Hard Light', 'bdthemes-element-pack'),
                    'soft-light'  => __('Soft Light', 'bdthemes-element-pack'),
                    'difference'  => __('Difference', 'bdthemes-element-pack'),
                    'exclusion'   => __('Exclusion', 'bdthemes-element-pack'),
                    'hue'         => __('Hue', 'bdthemes-element-pack'),
                    'saturation'  => __('Saturation', 'bdthemes-element-pack'),
                    'color'       => __('Color', 'bdthemes-element-pack'),
                    'luminosity'  => __('Luminosity', 'bdthemes-element-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}}.element-pack-agbg-yes .bdt-animated-gradient-background' => 'mix-blend-mode:{{VALUE}}'
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'background_background',
                            'operator' => '!==',
                            'value' => '',
                        ],
                        [
                            'name' => 'element_pack_agbg_show',
                            'operator' => '===',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );
        $section->add_control(
            'element_pack_agbg_direction',
            [
                'label'      => __('Direction', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'diagonal',
                'separator'    => 'before',
                'frontend_available' => true,
                'render_type' => 'none',
                'options'    => [
                    'diagonal'   => __('Diagonal', 'bdthemes-element-pack'),
                    'left-right'     => __('Left Right', 'bdthemes-element-pack'),
                    'top-bottom'     => __('Top Bottom', 'bdthemes-element-pack'),
                    'radial'    => __('Radial', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'element_pack_agbg_show' => 'yes'
                ]
            ]
        );
        $section->add_control(
            'element_pack_agbg_transitionSpeed',
            [
                'label'         => __('Transition Speed', 'bdthemes-element-pack'),
                'type'          => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'render_type' => 'none',
                'range'         => [
                    'px'        => [
                        'min'   => 100,
                        'max'   => 10000,
                        'step'  => 100,
                    ]
                ],
                'condition' => [
                    'element_pack_agbg_show' => 'yes'
                ]
            ]
        );
    }



    public function enqueue_scripts() {
        wp_enqueue_script('granim', BDTEP_ASSETS_URL . 'vendor/js/granim.min.js', 'v2.0.0', true);
    }
    public function should_script_enqueue($section) {
        if ('yes' === $section->get_settings_for_display('element_pack_agbg_show')) {
            $this->enqueue_scripts();
            wp_enqueue_style('ep-animated-gradient-background');
            wp_enqueue_script('ep-animated-gradient-background');
        }
    }

    protected function add_actions() {
        add_action('elementor/frontend/section/before_render', [$this, 'should_script_enqueue']);
        add_action('elementor/preview/enqueue_scripts', [$this, 'enqueue_scripts']);
        // Add section for settings
        add_action('elementor/element/section/section_background/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/element_pack_agbg_section/before_section_end', [$this, 'register_controls'], 10, 2);
        // add_action('elementor/frontend/section/before_render', [$this, 'section_agbg_before_render'], 10, 1);
    }
}
