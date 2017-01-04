<?php

namespace Drupal\church_entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Church entity.
 *
 * @see \Drupal\church_entity\Entity\ChurchEntity.
 */
class ChurchEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\church_entity\Entity\ChurchEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished church entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published church entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit church entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete church entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add church entities');
  }

}
