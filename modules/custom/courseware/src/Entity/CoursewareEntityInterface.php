<?php

namespace Drupal\courseware\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Courseware entity entities.
 *
 * @ingroup courseware
 */
interface CoursewareEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Courseware entity name.
   *
   * @return string
   *   Name of the Courseware entity.
   */
  public function getName();

  /**
   * Sets the Courseware entity name.
   *
   * @param string $name
   *   The Courseware entity name.
   *
   * @return \Drupal\courseware\Entity\CoursewareEntityInterface
   *   The called Courseware entity entity.
   */
  public function setName($name);

  /**
   * Gets the Courseware entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Courseware entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Courseware entity creation timestamp.
   *
   * @param int $timestamp
   *   The Courseware entity creation timestamp.
   *
   * @return \Drupal\courseware\Entity\CoursewareEntityInterface
   *   The called Courseware entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Courseware entity published status indicator.
   *
   * Unpublished Courseware entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Courseware entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Courseware entity.
   *
   * @param bool $published
   *   TRUE to set this Courseware entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\courseware\Entity\CoursewareEntityInterface
   *   The called Courseware entity entity.
   */
  public function setPublished($published);

}
