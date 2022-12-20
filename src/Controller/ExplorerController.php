<?php
declare(strict_types=1);

# namespace
namespace JelmerD\FileExplorer\Controller;

# Use
use Cake\Core\Configure;
use Cake\Http\Response;
use JelmerD\FileExplorer\Utility\Explorer;

/**
 * Connect Controller
 */
class ExplorerController extends AppController
{
    protected $_basePath = null;

    /**
     * Index method
     *
     * @return Response Renders view
     */
    public function index(): Response
    {
        # check if the user is allowed to do stuff
        if (!$this->_checkAccess()) return $this->redirect(['controller' => 'Connect', 'action' => 'login', 'prefix' => null]);

        # get the path the users wants access to
        $path = $this->getRequest()->getQuery('p');

        # get the files
        $explorer = new Explorer((string)$this->_basePath);
        $files = $explorer->getFiles($path);

        $explodedPath = [];
        if ($path) $explodedPath = array_filter(explode('/', $path));


        $this->set(compact('files', 'explodedPath'));

        return $this->render();
    }

    /**
     * @return bool|false
     */
    protected function _checkAccess(): bool
    {
        # reset the basePath on every check
        $this->_basePath = null;

        # Check if the session variable exists
        $check = $this->getRequest()->getSession()->check('FileExplorerLoggedIn');
        if (!$check) return false;

        # get the path from the session variable and all the allowed paths
        $path = $this->getRequest()->getSession()->read('FileExplorerLoggedIn');
        $paths = Configure::readOrFail('FileExplorer.paths');

        # check if this path is allowed
        if (!$path || !array_key_exists($path, $paths)) return false;

        # if allowed, set the base path for later use and return true
        $this->_basePath = $paths[$path];
        return true;
    }
}
