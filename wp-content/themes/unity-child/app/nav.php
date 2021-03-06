<?php

namespace App;

/**
 * Adjustments to menu attributes to support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @link https://www.w3.org/WAI/tutorials/menus/flyout/
 */
add_filter('nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
  if ( in_array( 'menu-item-has-children', $item->classes ) && $depth === 0 ) {
    $atts['href'] = '#';
    $atts['class'] = 'menu-link menu-toggle';
    $atts['aria-expanded'] = 'false';
    $atts['aria-haspopup'] = 'true';
  }

  return $atts;
}, 10, 4);

/**
 * Provide an accessible name / element for submenus.
 */
add_filter('walker_nav_menu_start_el', function( $item_output, $item, $depth, $args ) {
  if ( in_array( 'menu-item-has-children', $item->classes ) && $depth === 1 ) {
    // Switch anchor to a regular span element.
    $item_output = "<span class='sub-menu-label'>{$item->title}</span>";
  }

  return $item_output;
}, 10, 4);
