<?php

namespace Drupal\manager_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Routing\AdminContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * 管理页面的Controller
 */
class ManagerPages extends ControllerBase {

    /**
     * AccountProxy Service
     *
     * @var Drupal\Core\Session\AccountProxy
     */
    protected $account;

    /**
     * ConfigFactory Service
     *
     * @var Drupal\Core\Config\ConfigFactory
     */
    protected $config;
    /**
     * CurrentRouteMatch Service
     *
     * @var Drupal\Core\Routing\CurrentRouteMatch
     */
    protected $current_route;
    /**
     * AdminContext Service
     * 
     * @var Drupal\Core\Routing\AdminContext
     */
    protected $adminContext;

    /**
     * 初始化Controller
     * 
     * @param Drupal\Core\Session\AccountProxy
     *  当前登录的用户
     * @param use Drupal\Core\Config\ConfigFactory
     *  系统配置对象
     * @param Drupal\Core\Routing\CurrentRouteMatch
     *  当前的路由对象
     * @param Drupal\Core\Routing\AdminContext
     *  管理员上下文路由对象
     */
    public function __construct(AccountProxy $account, 
                                ConfigFactory $config,
                                CurrentRouteMatch $current_route, 
                                AdminContext $adminContext
                                ) {
        $this->account = $account;
        $this->config = $config;
        $this->current_route = $current_route;
        $this->adminContext = $adminContext;
    }

    /**
     * {@inheritdoc}
     */
    public static function create (ContainerInterface $container) {
        return new static(
            $container->get('current_user'),
            $container->get('config.factory'),
            $container->get('current_route_match'),
            $container->get('router.admin_context')
        ); 
    }

    public function index() {
        /*if(!$account->hasPermission('use manager pages')) {
            throw new AccessDeniedHttpException();
        }*/
        
        $element = [
            '#markup' => '<h1>管理员首页</h1>'
        ];
        return $element;
    }

}