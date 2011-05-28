<?php

$options = array();
$options['title'] = __('Add bookmark'); 
$options['url'] = url_for('bookmark_add_post');

op_include_form('bookmarkAddForm', $form, $options);