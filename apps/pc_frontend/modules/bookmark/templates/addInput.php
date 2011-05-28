<?php

$options = array();
$options['title'] = __('Add bookmark'); 
$options['url'] = url_for('bookmark/add');

op_include_form('bookmarkAddForm', $form, $options);