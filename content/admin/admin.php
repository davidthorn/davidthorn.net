<?php

$active =& ModelPages::getActive();

Logger::debug("admin.php nothing being done, ");
Site::addScript("/content/admin/js/admin_button_actions.js");

Site::addStyleSheet("/content/admin/css/admin_toolbar.css");
Site::addStyleSheet("/content/admin/css/admin_edit_layout.css");
Site::addStyleSheet("/content/admin/css/admin_forms_layout.css");
Site::addScript("/content/ajax/js/ajax_callbacks.js");




?>
