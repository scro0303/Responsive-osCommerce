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
      global $oscTemplate;
      
      $oscTemplate->_data[$this->group] = array('information' => array('text' => TEXT_INFORMATION, 
                                                                       'sort_order' => 100, 
                                                                       'buttons' => null),
                                                'buttons'     => array('text' => null, 
                                                                       'sort_order' => 200,
                                                                       'buttons' => array('left' => null,
                                                                                          'right' => array('title' => IMAGE_BUTTON_CONTINUE,
                                                                                                           'link' => tep_href_link('index.php'),
                                                                                                           'icon' => 'fa fa-chevron-right',
                                                                                                           'style' => 'btn-info',
                                                                                                           'bootstrapped' => 'col-xs-12 text-right'))));

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
          foreach ($v['buttons'] as $d => $e) {
            if (tep_not_null($v['buttons'][$d])) {
              $output .= '<div class="' . $e['bootstrapped'] . '">' . tep_draw_button($e['title'], $e['icon'], $e['link'], 'primary', null, $e['style']) . '</div>';
            }
          }   
         $output .= '</div>';
        }
      }
      $output .= '</div>';
      
      $oscTemplate->addContent($output, $this->group);
    }
  }
  