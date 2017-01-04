<?php

/**
 * @file
 * Contains church_entity.page.inc.
 *
 * Page callback for Church entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Church templates.
 *
 * Default template: church_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_church_entity(array &$variables) {
  // Fetch ChurchEntity Entity Object.
  $church_entity = $variables['elements']['#church_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
