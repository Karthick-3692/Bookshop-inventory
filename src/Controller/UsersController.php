<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{
   public function beforeFilter(EventInterface $event)
{
    parent::beforeFilter($event);
    
    // Allow unauthenticated actions
    $this->Authentication->addUnauthenticatedActions(['login', 'register']);

    // Redirect to login if user is not authenticated
    if (!$this->Authentication->getIdentity() && !in_array($this->request->getParam('action'), ['login', 'register'])) {
        return $this->redirect(['action' => 'login']);
    }
}


    public function login()
    {
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');

            $user = $this->Users->findByUsername($username)->first();

            if ($user && (new DefaultPasswordHasher)->check($password, $user->password)) {
                $this->request->getSession()->write('Auth.User', $user);
                return $this->redirect(['controller' => 'Books', 'action' => 'index']);
            } else {
                $this->Flash->error('Invalid username or password');
            }
        }
    }

    public function logout()
{
    // Destroy session completely
    $this->request->getSession()->destroy();

    // Prevent back button access
    $this->response = $this->response->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    $this->response = $this->response->withHeader('Pragma', 'no-cache');

    return $this->redirect(['action' => 'login']);
}
// public function logout()
// {
//     $this->request->getSession()->destroy(); // Destroy session
//     $this->Flash->success('You have been logged out.');
//     return $this->redirect(['action' => 'login']);
// }


public function searchBooks()
{
    $this->loadModel('Books'); // Load the Books table

    $query = $this->Books->find();

    $search = $this->request->getQuery('q');
    if ($search) {
        $query->where(['Books.title LIKE' => '%' . $search . '%']);
    }

    $books = $this->paginate($query);

    $this->set(compact('books', 'search'));
}


public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('Registration successful. Please login.');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('Registration failed. Please try again.');
        }
        $this->set(compact('user'));
    }
}


