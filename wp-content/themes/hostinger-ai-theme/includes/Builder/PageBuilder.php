<?php

namespace Hostinger\AiTheme\Builder;

defined( 'ABSPATH' ) || exit;

class PageBuilder {
    /**
     * @var string
     */
    private array $content_data;
    private string $type;

    /**
     * @param array $content_data
     */
    public function __construct( array $content_data ) {
        $this->content_data = $content_data;
        $this->type = get_option( 'hostinger_ai_builder_type', 'gutenberg' );
    }

    /**
     * @return array
     */
    public function build_pages(): array {
        $pages = array();
        $shop_page_info = null;

        $pages_to_build = $this->content_data['pages'];

        unset( $pages_to_build['ecommercePagesGroup'] );


        if ( get_option( 'hostinger_ai_woo', false ) ) {
            foreach ( $pages_to_build as $page => $page_data ) {
                if ( strtolower( trim( $page ) ) === 'shop' ) {
                    $shop_page_info = $this->create_page( $page, $page_data );
                    break;
                }
            }
        }

        foreach( $pages_to_build as $page => $page_data ) {
            if ( strtolower( trim( $page ) ) === 'shop' && $shop_page_info !== null ) {
                $pages[ $page ] = $shop_page_info;
            } else {
                $pages[ $page ] = $this->create_page( $page, $page_data );
            }
        }

        update_option( 'hostinger_ai_created_pages', $pages );

        return $pages;
    }

    private function create_page( string $page, array $page_data ): array {
        return match ( $this->type ) {
            'elementor' => $this->create_elementor_page( $page, $page_data ),
            default => $this->create_gutenberg_page( $page, $page_data ),
        };
    }

    private function create_gutenberg_page( string $page, array $page_data ): array {
        $page_clean = trim( $page );
        $page_content = '';

        if ( strtolower( $page_clean ) === 'shop' && get_option( 'hostinger_ai_woo', false ) ) {
            $page_content = '[products limit="12" columns="4" paginate="true"]';
        } elseif ( ! empty( $page_data['sections'] ) ) {
            foreach ( $page_data['sections'] as $section ) {
                $content_parser = new ContentParser( $section );
                $page_content .= $content_parser->output();
            }
        }

        $page_title = mb_convert_case( $page_clean, MB_CASE_TITLE, "UTF-8" );

        $new_page = array(
            'post_title'    => $page_title,
            'post_content'  => $page_content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );

        $page_id = wp_insert_post( $new_page );

        if ( empty( $page_id ) ) {
            return array();
        }

        $page_info = array(
            'title' => $page_title,
            'page_id' => $page_id,
        );

        if ( strtolower( $page_clean ) === 'shop' && get_option( 'hostinger_ai_woo', false ) ) {
            update_option( 'woocommerce_shop_page_id', $page_id );
        }

        return $page_info;
    }

    private function create_elementor_page( string $page, array $page_data ): array {
        $elementor_data = [];
        $elementor_json = '';
        $page_clean = trim( $page );

        if ( strtolower( $page_clean ) === 'shop' && get_option( 'hostinger_ai_woo', false ) ) {
            $shop_template_path = get_stylesheet_directory() . '/blocks/elementor/shop.json';
            if ( file_exists( $shop_template_path ) ) {
                $shop_template = file_get_contents( $shop_template_path );
                if ( $shop_template !== false ) {
                    $elementor_json = $shop_template;
                }
            }
        }

        if ( empty( $elementor_json ) && ! empty( $page_data['sections'] ) ) {
            foreach ( $page_data['sections'] as $section ) {
                $content_parser = new ContentParser( $section );
                $output         = $content_parser->output();
                if ( is_array( $output ) ) {
                    $elementor_data = array_merge( $elementor_data, $output );
                }
            }
            $elementor_json = wp_slash( json_encode( $elementor_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
        }

        $page_title = mb_convert_case( $page_clean, MB_CASE_TITLE, "UTF-8" );

        $new_page = array(
            'post_title'    => $page_title,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );

        $page_id = wp_insert_post( $new_page );

        if ( empty( $page_id ) ) {
            return array();
        }

        $page_info = array(
            'title' => $page_title,
            'page_id' => $page_id,
        );

        $elementor_version = Helper::get_elementor_version();

        update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
        update_post_meta( $page_id, '_elementor_version', $elementor_version );
        update_post_meta( $page_id, '_elementor_data', $elementor_json );

        if ( strtolower( $page_clean ) === 'shop' && get_option( 'hostinger_ai_woo', false ) ) {
            update_option( 'woocommerce_shop_page_id', $page_id );
        }

        return $page_info;
    }
}
