<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\Iterator as PaginatorIterator;
use Admin\Traits,
    Admin\Form;

class BlogController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/blog/index');

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\BlogTable');
    $params = $this->params()->fromRoute();

    $options = array(
        "blogs.title" => "Blog Title",
        "users.user_name" => "Author",
        "blogs_categories.category_title" => "Category",
    );
    $search_form = new Form\AdminSearch(null, $options, "admin/blogs");

    $page = isset($params['page']) ? (int) $params['page'] : 1;
    $order = isset($params['order']) ? (int) $params['order'] : 1;
    $order_by = isset($params['order_by']) ? $params['order_by'] : 'blog_id';
    $search_key = isset($params['search_key']) ? $params['search_key'] : false;
    $search_field = isset($params['search_field']) ? $params['search_field'] : false;

    /**
     * Handle Search Form Request
     */
    if ($this->getRequest()->isPost()) {
      $formValidator = new \Admin\Form\Validator\AdminSearch();
      $search_form->setInputFilter($formValidator->getInputFilter());
      $search_form->setData($this->getRequest()->getPost());

      if ($search_form->isValid()) {
        $postParams = $search_form->getData();
        $search_key = isset($postParams['search_key']) ? $postParams['search_key'] : false;
        $search_field = isset($postParams['search_field']) ? $postParams['search_field'] : false;
      }
    }
    /**
     * Prepare query params
     */
    $query_params = array(
        "order_by" => $order_by,
        "order" => ($order == 1) ? "ASC" : "DESC",
        "search_key" => $search_key,
        "search_field" => $search_field,
    );

    /**
     * Get blog data from db
     */
    $blogs = $modelObj->fetchAll($query_params);

    $itemsPerPage = 10;
    /**
     * Initiate paginator
     */
    $paginator = new Paginator(new PaginatorIterator($blogs));
    $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($itemsPerPage)
            ->setPageRange(7);

    /**
     * Preparing pagination view params
     */
    $page_params = array(
        "order_by" => $order_by,
        "order" => ($order == 1) ? (int) false : (int) true,
        "search_field" => $search_field,
        "search_key" => $search_key,
    );

    /**
     * Set serach form elements values if these are not null
     */
    if ($search_key && $search_field) {
      $search_form->get('search_key')->setValue($search_key);
      $search_form->get('search_field')->setValue($search_field);
    }

    return $viewModel->setVariables(
                    array(
                        "paginator" => $paginator,
                        'page' => $page,
                        'order' => ($order == 1) ? (int) false : (int) true,
                        'search_form' => $search_form,
                        'page_params' => $page_params
                    )
    );
  }

}