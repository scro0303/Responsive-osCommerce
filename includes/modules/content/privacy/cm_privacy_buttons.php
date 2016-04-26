<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

  class cm_privacy_buttons {
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_privacy_buttons() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_PRIVACY_BUTTONS_TITLE;
      $this->description = MODULE_CONTENT_PRIVACY_BUTTONS_DESCRIPTION;

      if ( defined('MODULE_CONTENT_PRIVACY_BUTTONS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_PRIVACY_BUTTONS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_PRIVACY_BUTTONS_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate;

      $oscTemplate->_data[$this->group][$this->code] = array('text' => null, 
                                                             'sort_order' => MODULE_CONTENT_PRIVACY_BUTTONS_SORT_ORDER,
                                                             'buttons' => array('left' => null,
                                                                                'right' => array('title' => IMAGE_BUTTON_CONTINUE,
                                                                                                 'link' => tep_href_link('index.php'),
                                                                                                 'icon' => 'fa fa-chevron-right',
                                                                                                 'style' => 'btn-info')));
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_CONTENT_PRIVACY_BUTTONS_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Privacy Buttons', 'MODULE_CONTENT_PRIVACY_BUTTONS_STATUS', 'True', 'Do you want to enable this module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_PRIVACY_BUTTONS_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_CONTENT_PRIVACY_BUTTONS_STATUS', 'MODULE_CONTENT_PRIVACY_BUTTONS_SORT_ORDER');
    }
  }
  