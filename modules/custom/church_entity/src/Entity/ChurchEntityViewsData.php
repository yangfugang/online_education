<?php

namespace Drupal\church_entity\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Church entities.
 */
class ChurchEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['church_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Church'),
      'help' => $this->t('The Church ID.'),
    );

    return $data;
  }

}
