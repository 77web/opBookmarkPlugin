<?php

$options = array();
$options['title'] = __('Confirmation of delete a bookmark');
$options['yes_button'] = __('Delete');
$options['no_button'] = __('Back');
$options['yes_url'] = url_for('@bookmark_delete?id='.$bookmark->getId());
$options['no_url'] = url_for('@bookmark_list');
$options['no_method'] = 'get';
$options['body'] = __('Are you sure to delete this?');


op_include_yesno('deleteBookmarkConfimationBox', $form, $form, $options);