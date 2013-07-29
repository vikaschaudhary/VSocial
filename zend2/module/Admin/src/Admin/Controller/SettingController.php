<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\Iterator as PaginatorIterator;
use Admin\Traits,
    Admin\Form;

class SettingController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/setting/index');

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\SettingTable');
    $params = $this->params()->fromRoute();

    /**
     * serach form field element options valus
     */
    $options = array(
        "name" => "Setting Key",
        "value" => "Setting Value",
    );
    /**
     * Create search form instance
     */
    $search_form = new \Admin\Form\AdminSearch(null, $options, "admin-settings");
    /**
     * Set request variables
     */
    $page = isset($params['page']) ? (int) $params['page'] : 1;
    $order = isset($params['order']) ? (int) $params['order'] : 1;
    $order_by = isset($params['order_by']) ? $params['order_by'] : 'name';
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
    $users = $modelObj->fetchAll($query_params);
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

  public function addAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/setting/add');

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\SettingTable');
    $params = $this->params()->fromRoute();
  }

  public function editAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/setting/edit');

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $viewModel->setTerminal(true);

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\SettingTable');
    $params = $this->params()->fromRoute();
    $form = new Form\Settings();

    $id = isset($params['id']) && !empty($params['id']) ? (int) $params['id'] : false;

    if (!$id) {
      $this->redirect()->toRoute('admin-settings');
    }

    if ($this->getRequest()->isPost()) {
      $formValidator = new Form\Validator\Settings();
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
          "value" => $post_date['value'],
      );

      $modelObj->update_value($update_data, $id);
    }

    $settings = $modelObj->get_value($id);

    $form->populateValues((array) $settings);




    return $viewModel->setVariables(
                    array(
                        "setting" => $settings,
                        "form" => $form
                    )
    );
  }

  public function deleteAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/setting/delete');

    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\SettingTable');
    $params = $this->params()->fromRoute();
  }

}