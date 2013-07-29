<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\Iterator as PaginatorIterator;
use Admin\Traits;

class UsersController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/users/index');
    /**
     * Check for admin login
     */
    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\AdminTable');
    $params = $this->params()->fromRoute();
    /**
     * serach form field element options valus
     */
    $options = array(
        "username" => "Username",
        "user_email" => "Email",
        "first_name" => "First Name",
        "last_name" => "Last Name",
    );
    /**
     * Create search form instance
     */
    $search_form = new \Admin\Form\AdminSearch(null, $options, "admin-users");
    /**
     * Set request variables
     */
    $page = isset($params['page']) ? (int) $params['page'] : 1;
    $order = isset($params['order']) ? (int) $params['order'] : 1;
    $order_by = isset($params['order_by']) ? $params['order_by'] : 'user_id';
    $search_key = isset($params['search_key']) ? $params['search_key'] : false;
    $search_field = isset($params['search_field']) ? $params['search_field'] : false;
    /**
     * Handle form post request
     */
    if ($this->getRequest()->isPost()) {
      $formValidator = new \Admin\Form\Validator\AdminSearch();
      $search_form->setInputFilter($formValidator->getInputFilter());
      $search_form->setData($this->getRequest()->getPost());

      /**
       * Check form validation
       */
      if ($search_form->isValid()) {
        $postParams = $search_form->getData();
        $search_key = isset($postParams['search_key']) ? $postParams['search_key'] : false;
        $search_field = isset($postParams['search_field']) ? $postParams['search_field'] : false;
      }
    }
    /**
     * prepare query params
     */
    $query_params = array(
        "order_by" => $order_by,
        "order" => ($order == 1) ? "ASC" : "DESC",
        "search_key" => $search_key,
        "search_field" => $search_field,
    );
    $users = $modelObj->fetch_all_users($query_params);
    /**
     * Set total items for a page in listing
     */
    $itemsPerPage = 15;
    /**
     * Initiate paginator
     */
    $paginator = new Paginator(new PaginatorIterator($users));
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

    /**
     * Return view variables
     */
    return $viewModel->setVariables(
                    array(
                        "paginator" => $paginator,
                        'page' => $page,
                        'order' => ($order == 1) ? (int) false : (int) true,
                        "page_params" => $page_params,
                        "search_form" => $search_form
                    )
    );
  }

  public function deleteAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/users/delete');
    $viewModel->setTerminal(true);
    /**
     * Check for admin login or not
     */
    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $params = $this->params()->fromRoute();
    $user_id = isset($params['user_id']) ? (int) $params['user_id'] : false;
    $page = isset($params['page']) ? (int) $params['page'] : 1;
    if ($user_id) {
      $sm = $this->getServiceLocator();
      $modelObj = $sm->get('Admin\Model\AdminTable');

      $user = $modelObj->fetch_user_data($user_id);
      $view_array = array(
          "user" => $user,
          "page" => $page
      );
      if ($this->getRequest()->isPost()) {
        $post_data = $this->params()->fromPost();

        if (isset($post_data['delete-yes']) && $post_data['delete-yes'] == 'yes') {
          if ($modelObj->delete_user($user_id)) {
            $view_array = array(
                "user" => false,
                "message" => "User deleted succussfully.",
                "page" => $page
            );
          } else {
            $view_array = array(
                "user" => false,
                "message" => "User did not delete.",
                "page" => $page
            );
          }
        }
        if (isset($post_data['delete-no']) && $post_data['delete-no'] == 'no') {
          $this->redirect()->toRoute("admin-users", array("page" => $page));
        }
      }

      return $viewModel->setVariables(
                      $view_array
      );
    }
  }

  public function editAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/users/edit');
    /**
     * Check for admin login or not
     */
    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }
    echo "here";
    exit;
    /**
     * User edit form
     */
//    $form = "";
//
//    $params = $this->params()->fromRoute();
//    $user_id = (isset($params['user_id']) && !empty($params['user_id'])) ? (int) $params['user_id'] : false;
//
//    if (!$user_id) {
//      $this->redirect()->toRoute('admin-user');
//    }
//    $sm = $this->getServiceLocator();
//    $modelObj = $sm->get('Admin\Model\AdminTable');
//
//    $user = $modelObj->fetch_user_data($user_id);
//
//    return new ViewModel(array(
//        'form' => $form,
//        'user' => $user
//            )
//    );
  }

}