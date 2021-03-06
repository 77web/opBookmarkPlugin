<?php

/**
 * PluginBookmarkTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginBookmarkTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object PluginBookmarkTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginBookmark');
  }
  
  public function getMemberPager($memberId, $size, $page = 1)
  {
    $query = $this->createQuery('b')->where('b.member_id = ?', $memberId)->orderBy('b.updated_at DESC');
    $pager = new sfDoctrinePager('Bookmark', $size);
    $pager->setPage($page);
    $pager->setQuery($query);
    $pager->init();
    
    return $pager;
  }
}