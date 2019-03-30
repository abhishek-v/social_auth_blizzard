<?php

namespace Drupal\social_auth_blizzard\Controller;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\social_api\Plugin\NetworkManager;
use Drupal\social_auth\Controller\OAuth2ControllerBase;
use Drupal\social_auth\SocialAuthDataHandler;
use Drupal\social_auth\User\UserAuthenticator;
use Drupal\social_auth_blizzard\BlizzardAuthManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Returns responses for Social Auth Blizzard module routes.
 */
class BlizzardAuthController extends OAuth2ControllerBase {

  /**
   * BlizzardAuthController constructor.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\social_api\Plugin\NetworkManager $network_manager
   *   Used to get an instance of social_auth_blizzard network plugin.
   * @param \Drupal\social_auth\User\UserAuthenticator $user_authenticator
   *   Used to manage user authentication/registration.
   * @param \Drupal\social_auth_blizzard\BlizzardAuthManager $blizzard_manager
   *   Used to manage authentication methods.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request
   *   Used to access GET parameters.
   * @param \Drupal\social_auth\SocialAuthDataHandler $data_handler
   *   The Social Auth Data handler.
   */
  public function __construct(MessengerInterface $messenger,
                              NetworkManager $network_manager,
                              UserAuthenticator $user_authenticator,
                              BlizzardAuthManager $blizzard_manager,
                              RequestStack $request,
                              SocialAuthDataHandler $data_handler) {

    parent::__construct('Social Auth Blizzard', 'social_auth_blizzard', $messenger, $network_manager, $user_authenticator, $blizzard_manager, $request, $data_handler);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger'),
      $container->get('plugin.network.manager'),
      $container->get('social_auth.user_authenticator'),
      $container->get('social_auth_blizzard.manager'),
      $container->get('request_stack'),
      $container->get('social_auth.data_handler')
    );
  }

  /**
   * Response for path 'user/login/blizzard'.
   */
  // public function redirectToProvider() {
  //   $blizzard = $this->networkManager->createInstance('social_auth_blizzard')->getSdk();
  //
  //   if (!$blizzard) {
  //     $this->messenger->addError('Social Auth Blizzard not configured properly. Contact site administrator.');
  //     return $this->redirect('user.login');
  //   }
  //
  //   $this->blizzardManager->setClient($blizzard);
  //
  //   $blizzard_login_url = $this->blizzardManager->getBaseAuthorizationUrl();
  //
  //   $state = $this->blizzardManager->getState();
  //
  //   $this->dataHandler->set('oauth2state', $state);
  //
  //   return new TrustedRedirectResponse($blizzard_login_url);
  // }

  /**
   * Response for path 'user/login/blizzard/callback'.
   *
   * Blizzard returns the user here after user has authenticated.
   */
  public function callback() {

    // Checks if authentication failed.
    if ($this->request->getCurrentRequest()->query->has('error')) {
      $this->messenger->addError($this->t('You could not be authenticated - Blizzard.'));

      return $this->redirect('user.login');
    }

    #$state = $this->dataHandler->get('oauth2state');
    $retrievedState = $this->request->getCurrentRequest()->query->get('state');
    $profile = $this->processCallback();
    #$profile = "succdss";
    // If authentication was successful.
    if ($profile !== NULL) {

      // Gets (or not) extra initial data.
      #$data = $this->userAuthenticator->checkProviderIsAssociated($profile->getId()) ? NULL : $this->providerManager->getExtraDetails();
      $response = $profile->toArray();
      #$data = $this->getValueByKey($response, data);
      #\Drupal::logger('social_auth_blizzard')->notice("redirect4".$profile->data[0]);
      #\Drupal::logger('social_auth_blizzard')->notice("redirect3".();
      // If user information could be retrieved.
      #return $this->userAuthenticator->authenticateUser($profile->getName(), $profile->getEmail(), $profile->getId(), $this->providerManager->getAccessToken(), $profile->getPictureUrl(), $data);
      return $this->userAuthenticator->authenticateUser($profile->data[0], NULL, $profile->data[0], $this->providerManager->getAccessToken(), NULL, NULL);
    }

    return $this->redirect('user.login');
  }

}
