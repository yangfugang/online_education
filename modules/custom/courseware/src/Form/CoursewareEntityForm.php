<?php

namespace Drupal\courseware\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Courseware entity edit forms.
 *
 * @ingroup courseware
 */
class CoursewareEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\courseware\Entity\CoursewareEntity */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Courseware entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Courseware entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.courseware_entity.canonical', ['courseware_entity' => $entity->id()]);
  }

}
