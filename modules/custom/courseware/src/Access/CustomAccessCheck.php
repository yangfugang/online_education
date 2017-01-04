<?php
namespace Drupal\courseware\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class CheckEntityOwer extends AccessInterface {
  public function access(AccountInterface $account) {
    print 'abcdefg';
    return AccessResult::forbidden();
  }
}
