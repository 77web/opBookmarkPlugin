<?php slot('bookmarkListBox'); ?>
  <?php if($pager->getNbResults() > 0): ?>
    <?php op_include_pager_navigation($pager, 'bookmark/list?id='.$member->getId().'&page=%s'); ?>
    <?php foreach($pager->getResults() as $bookmark): ?>
      <dl>
        <dt><?php echo link_to($bookmark->getTitle(), $bookmark->getUrl(), 'target=_blank'); ?></dt>
        <dd><div class="body"><?php echo nl2br($bookmark->getBody()); ?></div></dd>
      </dl>
    <?php endforeach; ?>
  <?php else: ?>
    <p><?php echo __('No data.'); ?></p>
  <?php endif; ?>
<?php end_slot(); ?>
<?php

$options = array();
$options['title'] = __('%member%\'s Bookmark', array('%member%' => $member->getId()==$sf_user->getMemberId() ? __('You') : $member->getName() ));

op_include_box('bookmarkListBox', get_slot('bookmarkListBox'), $options);