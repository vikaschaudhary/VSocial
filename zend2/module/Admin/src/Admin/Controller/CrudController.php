<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Json;

class CrudController extends AbstractActionController {

  public function userslistAction() {

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\AdminTable');
    $params = $this->params()->fromRoute();
    $user_id = (isset($params['user_id']) && !empty($params['user_id'])) ? (int) $params['user_id'] : false;

    if ($user_id) {
      $userData = $modelObj->fetch_user_data($user_id);
    } else {
      $userData = $modelObj->fetch_all_users();
    }

    $users = array();
    if ($userData) {
      if (count($userData) > 1) {
        foreach ($userData as $user) {

          $user = (array) $user;
          if ($user['isAdmin'] == 1) {
            $user['isAdmin'] = "Yes";
          } else {
            $user['isAdmin'] = "No";
          }
          $users[] = $user;
        }
      } else {
        $users = (array) $userData;        
        $users['isAdmin'] = (isset($users['isAdmin']) && $users['isAdmin'] == 1) ? "Yes" : "No";        
      }
    }

    return $this->getResponse()->setContent(Json::encode($users));
  }

}
