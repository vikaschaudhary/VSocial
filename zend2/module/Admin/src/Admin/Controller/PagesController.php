<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\Iterator as PaginatorIterator;
use Admin\Traits,
    Admin\Form;

class PagesController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/index');


    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');
    $params = $this->params()->fromRoute();

    $options = array(
        "page_title" => "Page Title",
        "username" => "Author"
    );

    $search_form = new Form\AdminSearch(null, $options, "admin-pages");

    $page = isset($params['page']) ? (int) $params['page'] : 1;
    $order = isset($params['order']) ? (int) $params['order'] : 1;
    $order_by = isset($params['order_by']) ? $params['order_by'] : 'page_id';
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

  public function editAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/edit');


    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');
    $params = $this->params()->fromRoute();

    $form = new Form\AdminPage();

    $page_id = isset($params['page_id']) && !empty($params['page_id']) ? (int) $params['page_id'] : false;

    if (!$page_id) {
      $this->redirect()->toRoute('admin-pages');
    }

    if ($this->getRequest()->isPost()) {
      $formValidator = new \Admin\Form\Validator\AdminSearch();
      $form->setInputFilter($formValidator->getInputFilter());
      $form->setData($this->getRequest()->getPost());

      $post_date = $this->getRequest()->getPost();

      $status = 0;
      if (isset($post_date['save_publish'])) {
        $status = 1;
      }
      if (isset($post_date['save_draft'])) {
        $status = 0;
      }
      $update_data = array(
          "page_title" => $post_date['title'],
          "page_description" => $post_date['description'],
          "page_content" => $post_date['content'],
          "page_keywords" => $post_date['keywords'],
          "page_update_date" => date("Y-m-d H:i:s"),
          "page_status" => $status,
      );

      $modelObj->update_page($update_data, $page_id);
    }

    $page = $modelObj->get_page($page_id);
    $form->populateValues((array) $page);




    return $viewModel->setVariables(
                    array(
                        "page" => $page,
                        "form" => $form
                    )
    );
  }

  public function createAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/create');


    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');

    $form = new Form\AdminPage();
    $success_status = array();
    if ($this->getRequest()->isPost()) {
      $formValidator = new \Admin\Form\Validator\AdminSearch();
      $form->setInputFilter($formValidator->getInputFilter());
      $form->setData($this->getRequest()->getPost());

      $post_date = $this->getRequest()->getPost();

      $status = 0;
      if (isset($post_date['save_publish'])) {
        $status = 1;
      }
      if (isset($post_date['save_draft'])) {
        $status = 0;
      }
      $update_data = array(
          "page_title" => $post_date['title'],
          "page_description" => $post_date['description'],
          "page_content" => $post_date['content'],
          "page_keywords" => $post_date['keywords'],
          "page_owner" => $session->admin->user_id,
          "page_status" => $status,
      );

      if ($modelObj->create_page($update_data)) {
        $success_status = array("error" => false, "message" => "Page created successfully");
      } else {
        $success_status = array("error" => true, "message" => "Page did not created");
      }
    }

    return $viewModel->setVariables(
                    array(
                        "form" => $form,
                        "result" => $success_status
                    )
    );
  }

  public function viewAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/view');


    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $viewModel->setTerminal(true);

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');
    $params = $this->params()->fromRoute();

    $page_id = isset($params['page_id']) && !empty($params['page_id']) ? (int) $params['page_id'] : false;

    if ($page_id) {
      $page = $modelObj->fetchPage($page_id);
    }

    return $viewModel->setVariables(
                    array(
                        "page" => $page,
                    )
    );
  }

  public function deleteAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/delete');

    $viewModel->setTerminal(true);

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');
    $params = $this->params()->fromRoute();

    $page_id = isset($params['page_id']) && !empty($params['page_id']) ? (int) $params['page_id'] : false;
    $page = isset($params['page']) && !empty($params['page']) ? (int) $params['page'] : 1;

    if ($page_id) {

      $view_array = array(
          "page" => $page
      );
      if ($this->getRequest()->isPost()) {
        $post_data = $this->params()->fromPost();

        if (isset($post_data['delete-yes']) && $post_data['delete-yes'] == 'yes') {
          if ($modelObj->delete_page($page_id)) {
            $view_array["success"] = true;
            $view_array["message"] = "Page deleted succussfully.";
          } else {
            $view_array["success"] = false;
            $view_array["message"] = "Page did not delete.";
          }
        }
        if (isset($post_data['delete-no']) && $post_data['delete-no'] == 'no') {
          $this->redirect()->toRoute("admin-pages", array("page" => $page));
        }
      }
      return $viewModel->setVariables(
                      $view_array
      );
    } else {
      $this->redirect()->toRoute("admin-pages");
    }
  }

}