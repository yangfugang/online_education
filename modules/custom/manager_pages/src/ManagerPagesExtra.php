<?php

/**
 * 实现一些公用的方法
 */
namespace Drupal\manager_pages;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Routing\AdminContext;

class ManagerPagesExtra {
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
     * 判断是否显示顶部工具栏
     * 
     * @return Bool
     */
    public function displayBar() {
        # 获取当前URL
        # $currentPath = \Drupal::service('path.current')->getPath();
        # 检查是否是admin页面
        $is_admin = $this->currentIsAdminRoute();
        if((!$this->account->hasPermission('access toolbar')
            && $this->account->hasPermission('use manager pages'))
            && ($this->config->get('display_topbar') 
                || $is_admin )
            ) {

            return TRUE;
        }

        return FALSE;
    }

    /**
     * 判断当前路由是不是管理页面
     *
     * @return Boolean
     */
    public function currentIsAdminRoute() {
        $current_route = $this->current_route->getRouteObject();
        return $this->adminContext->isAdminRoute();
    }
}