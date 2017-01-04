<?php

namespace Drupal\simple_oauth\Authentication\Provider;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\simple_oauth\Authentication\TokenAuthUser;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SimpleOauthAuthenticationProvider.
 *
 * @package Drupal\simple_oauth\Authentication\Provider
 */
class SimpleOauthAuthenticationProvider implements SimpleOauthAuthenticationProviderInterface {
  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a HTTP basic authentication provider object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EntityManagerInterface $entity_manager) {
    $this->configFactory = $config_factory;
    $this->entityManager = $entity_manager;
  }

  /**
   * Checks whether suitable authentication credentials are on the request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   *
   * @return bool
   *   TRUE if authentication credentials suitable for this provider are on the
   *   request, FALSE otherwise.
   */
  public function applies(Request $request) {
    // Check for the presence of the token.
    return (bool) $this::getTokenValue($request);
  }

  /**
   * {@inheritdoc}
   */
  public static function getTokenValue(Request $request) {
    // Check the header. See: http://tools.ietf.org/html/rfc6750#section-2.1
    $auth_header = $request->headers->get('Authorization', '', TRUE);
    $prefix = 'Bearer ';
    if (strpos($auth_header, $prefix) === 0) {
      return substr($auth_header, strlen($prefix));
    }
    // Form encoded parameter. See:
    // http://tools.ietf.org/html/rfc6750#section-2.2
    $ct_header = $request->headers->get('Content-Type', '', TRUE);
    $is_get = $request->getMethod() == Request::METHOD_GET;
    $token = $request->request->get('access_token');
    if (!$is_get && $ct_header == 'application/x-www-form-urlencoded' && $token) {
      return $token;
    }
    // This module purposely refuses to implement
    // http://tools.ietf.org/html/rfc6750#section-2.3 for security resons.
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function authenticate(Request $request) {
    $token_storage = $this->entityManager->getStorage('access_token');
    $ids = $token_storage
      ->getQuery()
      ->condition('value', $this::getTokenValue($request))
      ->condition('expire', REQUEST_TIME, '>')
      ->range(0, 1)
      ->execute();
    if (!empty($ids)) {
      /* @var \Drupal\simple_oauth\AccessTokenInterface $token */
      $token = $token_storage->load(reset($ids));
      try {
        return new TokenAuthUser($token);
      }
      catch (\Exception $e) {}
    }
    return [];
  }

}
