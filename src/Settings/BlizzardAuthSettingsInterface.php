<?php

namespace Drupal\social_auth_blizzard\Settings;

/**
 * Defines the settings interface.
 */
interface BlizzardAuthSettingsInterface {

  /**
   * Gets the Client ID.
   *
   * @return string
   *   The application ID.
   */
  public function getClientId();

  /**
   * Gets the Client secret.
   *
   * @return string
   *   The application secret.
   */
  public function getClientSecret();

}
