<?php

namespace Skeleton\Ports\Controller;

use Skeleton\Application\Service\UserModule\Request\EmailCheckRequest;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Request\SignupConfirmationRequest;
use Skeleton\Application\Service\UserModule\Request\SignupRequest;
use Skeleton\Application\Service\UserModule\Request\AuthRequest;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Yggdrasil\Core\Form\FormHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yggdrasil\Core\Service\Utils\ServiceRequestWrapper;

/**
 * Class UserController
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Ports\Controller
 */
class UserController extends AbstractController
{
    /**
     * Sign in action
     * Route: /user/signin
     *
     * @return RedirectResponse|Response
     *
     * @throws \Exception
     */
    public function signinAction()
    {
        if ($this->isGranted()) {
            return $this->redirectToAction();
        }

        $form = new FormHandler();

        if ($form->handle($this->getRequest())) {
            $isRemembered = $form->hasData('remember_me');

            $request = new AuthRequest();
            $request = ServiceRequestWrapper::wrap($request, $form->getDataCollection())->setRemembered($isRemembered);

            $response = $this->getService('user.auth')->process($request);

            if (!$response->isSuccess()) {
                $this->addFlash('danger', 'Authentication failed. Incorrect e-mail address or password.');

                return $this->render('user/signin.html.twig');
            }

            if (!$response->isEnabled()) {
                $this->addFlash('danger', 'Account is not activated. Check your mailbox for confirmation mail.');

                return $this->render('user/signin.html.twig');
            }

            $this->startUserSession($response->getUser());

            if ($isRemembered) {
                $cookie['identifier'] = $response->getUser()->getRememberIdentifier();
                $cookie['token'] = $response->getRememberToken();

                $this->getResponse()->headers->setCookie(
                    new Cookie('remember', serialize($cookie), strtotime('now + 1 week'))
                );
            }

            return $this->redirectToAction();
        }

        return $this->render('user/signin.html.twig');
    }

    /**
     * Sign out action
     * Route: /user/signout
     *
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function signoutAction(): RedirectResponse
    {
        if (!$this->isGranted()) {
            return $this->redirectToAction();
        }

        $this->invalidateSession();

        if ($this->getRequest()->cookies->has('remember')) {
            $this->getResponse()->headers->clearCookie('remember');
        }

        return $this->redirectToAction();
    }

    /**
     * Remember me cookie authentication passive action
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function authCookiePassiveAction(): Response
    {
        if ($this->getRequest()->cookies->has('remember') && !$this->isGranted()) {
            $cookie = unserialize($this->getRequest()->cookies->get('remember'));

            $request = (new RememberedAuthRequest())
                ->setRememberIdentifier($cookie['identifier'])
                ->setRememberToken($cookie['token']);

            $response = $this->getService('user.remembered_auth')->process($request);

            if ($response->isSuccess()) {
                $this->startUserSession($response->getUser());

                $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
            }
        }

        return $this->getResponse();
    }

    /**
     * Sign up action
     * Route: /user/signup
     *
     * @return RedirectResponse|Response
     *
     * @throws \Exception
     */
    public function signupAction()
    {
        if ($this->isGranted()) {
            return $this->redirectToAction();
        }

        $form = new FormHandler();

        if ($form->handle($this->getRequest())) {
            $request = new SignupRequest();
            $request = ServiceRequestWrapper::wrap($request, $form->getDataCollection());

            $response = $this->getService('user.signup')->process($request);

            if ($response->isSuccess()) {
                $this->addFlash('success', 'Account created successfully. Check your mailbox for confirmation mail.');

                return $this->redirectToAction();
            }

            $this->addFlash('danger', 'Something went wrong.');
        }

        return $this->render('user/signup.html.twig');
    }

    /**
     * Email check action
     * Route: /user/emailcheck
     *
     * Used by jQuery validation to indicate if email address is already taken or not
     *
     * @return JsonResponse|Response
     *
     * @throws \Exception
     */
    public function emailCheckAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return $this->badRequest();
        }

        $request = (new EmailCheckRequest())
            ->setEmail($this->getRequest()->request->get('email'));

        $response = $this->getService('user.email_check')->process($request);

        return $this->json([($response->isSuccess()) ? 'true' : 'This email address is already taken.']);
    }

    /**
     * Sign up confirmation action
     * Route: /user/signupconfirmation/{token}
     *
     * @param string $token
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function signupConfirmationAction(string $token): RedirectResponse
    {
        $request = (new SignupConfirmationRequest())
            ->setToken($token);

        $response = $this->getService('user.signup_confirmation')->process($request);

        if ($response->isAlreadyActive()) {
            $this->addFlash('warning', 'This account is already active.');
        } elseif (!$response->isSuccess()) {
            $this->addFlash('warning', 'Invalid confirmation token.');
        } else {
            $this->addFlash('success', 'Account activated successfully. Now you can sign in!');
        }

        return $this->redirectToAction();
    }
}
