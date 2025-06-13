<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller {
    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
    }
    public function beforeRender(\Cake\Event\EventInterface $event)
{
    $this->response = $this->response->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
    $this->response = $this->response->withHeader('Pragma', 'no-cache');
    $this->response = $this->response->withHeader('Expires', '0');
}

public function beforeFilter(EventInterface $event) {
        $this->response = $this->response->withDisabledCache();

        parent::beforeFilter($event);
        $allowedActions = ['login', 'register'];

    $currentAction = $this->getRequest()->getParam('action');
        $this->Authentication->addUnauthenticatedActions(['login']);
    if (!$this->request->getSession()->check('Auth.User') && $this->getRequest()->getParam('action') !== 'login') {
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
    
}
}