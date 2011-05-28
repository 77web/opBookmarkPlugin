<?php

/**
 * PluginBookmark form.
 *
 * @package    opBookmarkPlugin
 * @subpackage form
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginBookmarkForm extends BaseBookmarkForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['id']);
    $this->useFields(array('title', 'url', 'body'));
    
    $this->setWidget('title', new sfWidgetFormInputHidden());
    $this->setValidator('title', new sfValidatorString(array('required'=>true)));
    $this->setWidget('url', new sfWidgetFormInputHidden());
    $this->setValidator('url', new sfValidatorUrl(array('required'=>true)));
    
    $this->getValidator('body')->setOption('required', false);
  }
}
