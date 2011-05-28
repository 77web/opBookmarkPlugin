<?php

class opBookmarkPluginBookmarkActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('bookmark', 'list');
  }
  
  public function executeList(sfWebRequest $request)
  {
    $memberId = $request->getParameter('id', $this->getUser()->getMemberId());
    $this->member = Doctrine::getTable('Member')->find($memberId);
    $this->forward404Unless($this->member);
    
    $this->page = $request->getParameter('page', 1);
    if($this->page < 1) $this->page = 1;
    if(empty($this->size)) $this->size = sfConfig::get('app_bookmark_pager_limit');
    
    $this->pager = Doctrine::getTable('Bookmark')->getMemberPager($this->member->getId(), $this->size, $this->page);
  }
  
  public function executeAdd(sfWebRequest $request)
  {
    $this->form = new BookmarkForm();
    $this->form->setDefault('title', $request->getParameter('title'));
    $this->form->setDefault('url', $request->getParameter('url'));
    
    if($request->isMethod(sfRequest::POST))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if($this->form->isValid())
      {
        $this->form->getObject()->setMember($this->getUser()->getMember());
        $this->form->save();
        
        $this->getUser()->setFlash('notice', 'Bookmark add.');
        $this->redirect('@bookmark_list');
      }
    }
    return sfView::INPUT;
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->bookmark = $this->getRoute()->getObject();
    $this->forward404Unless($this->getUser()->getMemberId() === $this->bookmark->getMemberId());
    
    $this->form = new BaseForm();
    
    if($request->isMethod(sfRequest::POST))
    {
      $request->checkCSRFProtection();
      
      $this->bookmark->delete();
      
      $this->getUser()->setFlash('notice', 'Bookmark deleted.');
      $this->redirect('@bookmark_list');
    }
    
    return sfView::INPUT;
  }
}