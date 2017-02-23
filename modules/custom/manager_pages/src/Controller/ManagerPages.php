<?php

namespace Drupal\manager_pages\Controller;

use Drupal\Core\Controller\ControllerBase;

class ManagerPages extends ControllerBase {

    public function index() {
        $element = [
            '#markup' => '<h1>管理员首页</h1>'
        ];
        return $element;
    }
}