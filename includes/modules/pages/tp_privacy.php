<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

  class tp_privacy {
    var $group = 'privacy';

    function prepare() {
    }

    function build() {
      global $oscTemplate;
      
      foreach ( $oscTemplate->_data[$this->group] as $key => $row ) {
        $arr[$key] = $row['sort_order'];
      }
      array_multisort($arr, SORT_ASC, $oscTemplate->_data[$this->group]);
      
      $output = '<div class="col-sm-12">';
      foreach ( $oscTemplate->_data[$this->group] as $k => $v ) {        
        $output .= $v['text'];
        if (tep_not_null($v['buttons'])) {
          $output .= '<div class="buttonSet row">';
          $right_class = 'col-xs-12';
          if (tep_not_null($v['buttons']['left'])) {
            $output .= '<div class="col-xs-6">';
            $output .= tep_draw_button($v['buttons']['left']['title'], $v['buttons']['left']['icon'], $v['buttons']['left']['link'], 'primary', null, $v['buttons']['left']['style']);
            $output .= '</div>';
            $right_class = 'col-xs-6';
          }          
          if (tep_not_null($v['buttons']['right'])) {
            $output .= '<div class="' . $right_class . ' text-right">';
            $output .= tep_draw_button($v['buttons']['right']['title'], $v['buttons']['right']['icon'], $v['buttons']['right']['link'], 'primary', null, $v['buttons']['right']['style']);
            $output .= '</div>';
          }
         $output .= '</div>';
        }
      }
      $output .= '</div>';
      
      $oscTemplate->addContent($output, $this->group);
    }
  }
  