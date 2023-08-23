<?php
/**
 * Plugin Name: Taxonomy List
 * Version: 1.1.3
 * Plugin URI: http://plugins.muhammadrehman.com/
 * Description: You can display list of any taxonomy terms by using shortcode.
 * Author: Muhammad Rehman
 * Author URI: http://muhammadrehman.com/
 * License: GPLv2 or later
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
define('WPTLS_PLUGIN_DIR_URL',plugin_dir_url( __FILE__ ) );

function wptls_style() {
    wp_enqueue_style( 'wptls_style', WPTLS_PLUGIN_DIR_URL . 'assets/style.css' );
    wp_enqueue_script( 'wptls_script', WPTLS_PLUGIN_DIR_URL . 'assets/script.js', array('jquery'), false ,true);    
}

add_action( 'wp_enqueue_scripts', 'wptls_style' );

add_shortcode( 'taxonomy_list', 'wptls_taxonomy_list' );

function wptls_taxonomy_list( $atts ) {
    $atts = shortcode_atts( array(
        'name' => 'category',
        'hide_empty' => false,
        'exclude' => '',
        'include' => '',
        'order' => 'ASC',
        'orderby' => 'id',
        'search_bar' => 0,
        'show_count' => false,
        'count_type' => 'terms'     
    ), $atts);


    $terms = get_terms( array(
        'taxonomy' => $atts['name'],
        'hide_empty' => filter_var( $atts['hide_empty'], FILTER_VALIDATE_BOOLEAN),
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'parent'   => 0
    ) );

    $html = '';
    if( $atts['search_bar'] == 1 )
        $html .= wptls_search_filter();

    $html .= '<div class="taxonomy-list">';

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            
            if( !empty( $atts['exclude'] ) ) {
                $exclude = explode( ',',$atts['exclude'] );
                if( in_array( $term->term_id, $exclude) ) {
                    continue;
                }
            }
            
            if( !empty( $atts['include'] ) ) {
                $include = explode( ',',$atts['include'] );
                if( !in_array( $term->term_id, $include) ) {
                    continue;
                }
            }
            
            $image = '';
            if( function_exists('get_woocommerce_term_meta') ) {
                $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
            }
                
            $html .= '<div class="taxonomy-list-item" data-taxname="'.strtolower( $term->name ).'">';
            $term_link = get_term_link( $term );
            
            if( wptls_has_child_terms( $atts['name'],$term->term_id,$atts['hide_empty'] ) == true )
                $html .= '<div class="tax-arrow">►</div>';
            
            $child_terms = get_terms( array(
                'taxonomy' => $atts['name'],
                'hide_empty' => filter_var( $atts['hide_empty'], FILTER_VALIDATE_BOOLEAN),
                'orderby' => $atts['orderby'],
                'order' => $atts['order'],
                'parent'   => $term->term_id
            ) );

            $html .= '<div class="tax-details">
                <div class="tax-name">                
                    <div class="tax-image">
                        <img src="'.$image.'" width="50">
                    </div>
                    
                    <div class="tax-title">
                        <a href="' . esc_url( $term_link ) . '" title="'.$term->description.'">' . $term->name . '</a>
                    </div>';

            if( $atts['count_type'] == 'post' && filter_var( $atts['show_count'], FILTER_VALIDATE_BOOLEAN) == true ) {
                $html .= '<div class="tax-child-count">('. get_posts_count( $term ) .')</div>';
            }
                    
            if( $atts['count_type'] == 'terms' && ( is_array( $child_terms ) && count( $child_terms ) > 0 && filter_var( $atts['show_count'], FILTER_VALIDATE_BOOLEAN) == true ) ) {
                $html .= '<div class="tax-child-count">('. count( $child_terms ) .')</div>';
                
            }

            $html .= '</div>';
            $html .= '<div class="tax-desc">' . $term->description . '</div>
                </div>';            
            
            if( !empty( $child_terms ) && is_array( $child_terms ) ) {
                foreach ( $child_terms as $child_term ) {
                    
                    $image = '';
                    if( function_exists('get_woocommerce_term_meta') ) {
                        $thumbnail_id = get_woocommerce_term_meta( $child_term->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                    }
                    
                    $html .= '<div class="tax-child-list-item">';
                    $child_term_link = get_term_link( $child_term );
                    $html .= '<div class="tax-name">
                            <div class="tax-image"><img src="'.$image.'" width="50"></div><div class="tax-title"><a href="' . esc_url( $child_term_link ) . '" title="'.$child_term->description.'">' . $child_term->name . '</a></div>';
                    
                    
                    if( $atts['count_type'] == 'post' && filter_var( $atts['show_count'], FILTER_VALIDATE_BOOLEAN) == true ) {
                        $html .= '<div class="tax-child-count">('. get_posts_count( $child_term ) .')</div>';                        
                    }

                    $html .= '</div>';

                    $html .= '<div class="tax-desc">' . $child_term->description . '</div>';
                    $html .= '</div>';
                }
            }
            
            $html .= '</div>';
        }
    }
    
    $html .= '</div>';
    return $html;
}

function get_posts_count( $term ) {
    $args = array(
        'post_type'     => get_taxonomy( $term->taxonomy )->object_type[0],
        'post_status'   => 'publish', // just tried to find all published post
        'posts_per_page' => -1,  //show all
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => $term->taxonomy,  //taxonomy name  here, I used 'product_cat'
            'field' => 'id',
            'terms' => array( $term->term_id )
          )
        )
      );
  
      $query = new WP_Query( $args);

      return (int)$query->post_count;
}

function wptls_has_child_terms( $taxonomy, $parent_id, $hide_empty ) {
    $has_child_terms = get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => $hide_empty,
        'parent'   => $parent_id
    ) );
    
    if( !empty( $has_child_terms ) )
        return true;
    else 
        return false;
}

function wptls_search_filter() {
    $html = '<div class="taxonomy-search-filter">
                <input type="text" placeholder="Search..." id="tax-search-filter"/>
            </div>';

    return $html;
}