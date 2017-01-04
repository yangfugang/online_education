<?php

namespace Drupal\courseware\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Courseware entity entities.
 */
class CoursewareEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['courseware_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Courseware entity'),
      'help' => $this->t('The Courseware entity ID.'),
    );

    return $data;
  }

}
