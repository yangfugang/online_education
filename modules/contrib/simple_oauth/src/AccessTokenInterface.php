<?php

namespace Drupal\simple_oauth;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Access Token entities.
 *
 * @ingroup simple_oauth
 */
interface AccessTokenInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Returns the defaul expiration.
   *
   * @return array
   *   The default expiration timestamp.
   */
  public static function defaultExpiration();

  /**
   * Checks if the current token allows the provided permission.
   *
   * @param string $permission
   *   The requested permission.
   *
   * @return bool
   *   TRUE if the permission is included. FALSE otherwise.
   */
  public function hasPermission($permission);

  /**
   * Helper function that indicates if a token is a refresh token.
   *
   * @return bool
   *   TRUE if this is a refresh token. FALSE otherwise.
   */
  public function isRefreshToken();

  /**
   * Helper function that refreshes the access token
   *
   * @return \Drupal\simple_oauth\Entity\AccessToken
   *   valid AccessToken if this is a valid refresh token. NULL otherwise.
   */
  public function refresh();

}
