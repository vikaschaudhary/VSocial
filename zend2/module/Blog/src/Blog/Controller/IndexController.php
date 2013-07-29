<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\Iterator as PaginatorIterator;

class IndexController extends AbstractActionController {

  public function indexAction() {

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Blog\Model\BlogTable');

    $params = $this->params()->fromRoute();
    /**
     * check for post
     */
    $keyword = null;
    if ($this->getRequest()->isPost()) {
      $keyword = $this->params()->fromPost('keyword');
    }
    $category_id = (isset($params['category']) && !empty($params['category'])) ? $params['category'] : null;
    $tag_id = (isset($params['tag_id']) && !empty($params['tag_id'])) ? $params['tag_id'] : null;
    $search_key = (isset($params['keyword']) && !empty($params['keyword'])) ? $params['keyword'] : $keyword;
    $tag = (isset($params['tag']) && !empty($params['tag'])) ? $params['tag'] : null;
    $category_title = (isset($params['category_title']) && !empty($params['category_title'])) ? $params['category_title'] : null;

    $blogs = $modelObj->fetch_all_blogs($search_key, $category_id, $tag_id);

    $page = isset($params['page']) ? (int) $params['page'] : 1;
    $itemsPerPage = 10;
    /**
     * Initiate paginator
     */
    $paginator = new Paginator(new PaginatorIterator($blogs));
    $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($itemsPerPage)
            ->setPageRange(7);
    /**
     * Set view params
     */
    $page_params = array();
    $page_params['tag_id'] = $tag_id;
    $page_params['keyword'] = $search_key;
    $page_params['category'] = $category_id;
    $page_params['tag'] = $tag;
    $page_params['category_title'] = $category_title;
    return new ViewModel(
            array(
        'blogs' => $blogs,
        'paginator' => $paginator,
        'page' => $page,
        'page_params' => $page_params
    ));
  }

  public function detailAction() {
    $params = $this->params()->fromRoute();
    if (isset($params['id']) && !empty($params['id'])) {
      $blog_id = (int) $params['id'];
    } else {
      $blog_id = 1;
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Blog\Model\BlogTable');

    return new ViewModel(array(
        'blog' => $modelObj->fetch_blog($blog_id),
    ));
  }

}

