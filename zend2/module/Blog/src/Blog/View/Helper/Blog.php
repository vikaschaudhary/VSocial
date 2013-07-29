<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\ServiceManager\ServiceLocatorInterface;

class Blog extends AbstractHelper {

  protected $blog_slider = array();
  protected $locator;

  public function __construct(ServiceLocatorInterface $locator) {
    $this->locator = $locator;
  }

  public function comments($blog_id, $name, $limit = 10) {
    $modelObj = $this->locator->get($name);
    $comments = $modelObj->fetch_all($blog_id, $limit);
    $blog_comments = array();
    if ($comments) {
      foreach ($comments as $key => $val) {
        $blog_comments[] = $val;
      }
    }
    return $blog_comments;
  }

  public function categories($name = 'Blog\Model\CategoryTable') {
    $modelObj = $this->locator->get($name);
    $categories = $modelObj->fetch_all_with_count();
    $blog_categories = array();
    if ($categories) {
      foreach ($categories as $key => $val) {
        $blog_categories[] = $val;
      }
    }
    return $blog_categories;
  }

  public function slider($name = 'Blog\Model\BlogTable') {
    $modelObj = $this->locator->get($name);
    $blogs = $modelObj->fetch_slider_blogs();
    $blog_slider = array();
    if ($blogs) {

      foreach ($blogs as $key => $val) {
        $blog_slider[] = $val;
      }
    }
    return $blog_slider;
  }

  public function archives($name = 'Blog\Model\BlogTable') {
    $modelObj = $this->locator->get($name);
    $blogs = $modelObj->fetch_slider_blogs();
    $archives = array();
    if ($blogs) {
      foreach ($blogs as $key => $val) {
        $archives[] = $val;
      }
    }
    return $archives;
  }

}

?>
