<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Read_More_Customize_Category_Dropdown_Control' )):

    /**
     * Custom Control for category dropdown
     * @package Acme Themes
     * @subpackage Read More
     * @since 1.0.0
     *
     */
    class Read_More_Customize_Category_Dropdown_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'category_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $read_more_customizer_name = 'read_more_customizer_dropdown_categories_' . $this->id;;
            $read_more_dropdown_categories = wp_dropdown_categories(
                array(
                    'name'              => $read_more_customizer_name,
                    'echo'              => 0,
                    'show_option_none'  =>__('Select','read-more'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                    'show_count'         => 1
                )
            );
            $read_more_dropdown_final = str_replace( '<select', '<select ' . $this->get_link(), $read_more_dropdown_categories );
            printf(
                '<label><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $read_more_dropdown_final
            );
        }
    }
endif;