<?php

namespace Drupal\church_entity\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Church entities.
 *
 * @ingroup church_entity
 */
interface ChurchEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Church name.
   *
   * @return string
   *   Name of the Church.
   */
  public function getName();

  /**
   * Sets the Church name.
   *
   * @param string $name
   *   The Church name.
   *
   * @return \Drupal\church_entity\Entity\ChurchEntityInterface
   *   The called Church entity.
   */
  public function setName($name);

  /**
   * Gets the Church creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Church.
   */
  public function getCreatedTime();

  /**
   * Sets the Church creation timestamp.
   *
   * @param int $timestamp
   *   The Church creation timestamp.
   *
   * @return \Drupal\church_entity\Entity\ChurchEntityInterface
   *   The called Church entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Church published status indicator.
   *
   * Unpublished Church are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Church is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Church.
   *
   * @param bool $published
   *   TRUE to set this Church to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\church_entity\Entity\ChurchEntityInterface
   *   The called Church entity.
   */
  public function setPublished($published);

}
