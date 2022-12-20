<?php
declare(strict_types=1);

# namespaces
namespace JelmerD\FileExplorer\Controller;

# use
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Http\Response;

/**
 * Connect Controller
 *
 * This controller handles the login and logout for the session
 */
class ConnectController extends AppController
{
    /**
     * Login into the session
     *
     * @return Response|null Renders view
     */
    public function login(): ?Response
    {
        # Check if the request is a post request
        if ($this->request->is('post')) {

            # check if the path entered is an allowed path to follow
            $paths = Configure::readOrFail('FileExplorer.paths');
            $path = null;
            if (array_key_exists($this->getRequest()->getData('path'), $paths)) {
                $path = $this->getRequest()->getData('path');
            }

            # check if the password entered is actually correct
            $check = (new DefaultPasswordHasher())->check(
                $this->request->getData('password'),
                Configure::readOrFail('FileExplorer.password')
            );

            # do the actual checking. If true, set a session variable
            if (!is_null($path) && $check === true) {
                $this->request->getSession()->write('FileExplorerLoggedIn', $path);
                return $this->redirect(['controller' => 'Explorer', 'action' => 'index', 'prefix' => null]);
            }
        }

        # by default
        return $this->render();
    }

    /**
     * Logout of the sessions
     *
     * @return Response|null Renders view
     */
    public function logout(): ?Response
    {
        # make sure the session variable is deleted
        $this->getRequest()->getSession()->delete('FileExplorerLoggedIn');

        # redirect
        return $this->redirect(['action' => 'login', 'prefix' => null]);
    }
}
