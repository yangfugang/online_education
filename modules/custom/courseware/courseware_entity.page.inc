<?php

/**
 * @file
 * Contains courseware_entity.page.inc.
 *
 * Page callback for Courseware entity entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Courseware entity templates.
 *
 * Default template: courseware_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_courseware_entity(array &$variables) {
  // Fetch CoursewareEntity Entity Object.
  $courseware_entity = $variables['elements']['#courseware_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
