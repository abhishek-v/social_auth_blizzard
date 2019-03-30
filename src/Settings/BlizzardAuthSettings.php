<?php

namespace Drupal\social_auth_blizzard\Settings;

use Drupal\social_api\Settings\SettingsBase;

/**
 * Defines methods to get Social Auth Blizzard app settings.
 */
class BlizzardAuthSettings extends SettingsBase implements BlizzardAuthSettingsInterface {

  /**
   * Client ID.
   *
   * @var string
   */
  protected $clientId;

  /**
   * Client secret.
   *
   * @var string
   */
  protected $clientSecret;


  /**
   * The default access token.
   *
   * @var string
   */
  protected $defaultToken;

  /**
   * The redirect URL for social_auth implmeneter.
   *
   * @var string
   */
  protected $oauthRedirectUrl;

  /**
   * {@inheritdoc}
   */
  public function getClientId() {
    if (!$this->clientId) {
      $this->clientId = $this->config->get('client_id');
    }
    return $this->clientId;
  }

  /**
   * {@inheritdoc}
   */
  public function getClientSecret() {
    if (!$this->clientSecret) {
      $this->clientSecret = $this->config->get('client_secret');
    }
    return $this->clientSecret;
  }

}
