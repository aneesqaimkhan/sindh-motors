<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        helper(['form', 'url', 'session']);

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * Check if user is logged in
     */
    protected function isLoggedIn()
    {
        return session()->get('logged_in') === true;
    }

    /**
     * Check if user is admin
     */
    protected function isAdmin()
    {
        return session()->get('is_admin') === 1;
    }

    /**
     * Require authentication
     */
    protected function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('login')->with('error', 'Please login to continue');
        }
    }

    /**
     * Require admin privileges
     */
    protected function requireAdmin()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('admin/login')->with('error', 'Please login to continue');
        }
        
        if (!$this->isAdmin()) {
            return redirect()->to('admin/login')->with('error', 'Access denied. Admin privileges required.');
        }
    }
}
