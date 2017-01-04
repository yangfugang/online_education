<?php

namespace Drupal\courseware;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Courseware entity entity.
 *
 * @see \Drupal\courseware\Entity\CoursewareEntity.
 */
class CoursewareEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\courseware\Entity\CoursewareEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished courseware entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published courseware entity entities');

      case 'update':
        #return AccessResult::forbidden();
        // 检查是不是编辑自己的课件
        $roles = $account->getRoles();
        $euid = $entity->get('user_id')->getValue()[0]['target_id'];
        if(isset($roles[1])) {
          if($roles[1] != 'administrator' && $account->id() != $euid)
            return AccessResult::forbidden();
        }
        return AccessResult::allowedIfHasPermission($account, 'edit courseware entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete courseware entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add courseware entity entities');
  }

}
