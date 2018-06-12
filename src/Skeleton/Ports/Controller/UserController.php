<?php

namespace Skeleton\Ports\Controller;

use Skeleton\Application\Service\UserModule\Request\EmailCheckRequest;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Request\SignupConfirmationRequest;
use Skeleton\Application\Service\UserModule\Request\SignupRequest;
use Skeleton\Application\Service\UserModule\Request\AuthRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Yggdrasil\Core\Form\FormHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function signinAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $rememberMe = $form->hasData('remember_me');

            $request = new AuthRequest();
            $request = $form->serializeData($request);
            $request->setRemember($rememberMe);

            $service = $this->getContainer()->get('user.auth');
            $response = $service->process($request);

            if(!$response->isSuccess()){
                $this->addFlash('danger', 'Authentication failed. Incorrect e-mail address or password.');
                return $this->render('user/signin.html.twig');
            }

            if(!$response->isEnabled()){
                $this->addFlash('danger', 'Account is not activated. Check your mailbox for confirmation mail.');
                return $this->render('user/signin.html.twig');
            }

            $session = new Session();

            $session->set('is_granted', true);
            $session->set('user', $response->getUser());

            if($rememberMe){
                $cookie['identifier'] = $response->getUser()->getRememberIdentifier();
                $cookie['token'] = $response->getRememberToken();

                $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
            }

            return $this->redirectToAction('Default:index');
        }

        return $this->render('user/signin.html.twig');
    }

    /**
     * Sign out action
     * Route: /user/signout
     *
     * @return RedirectResponse
     */
    public function signoutAction()
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $session = new Session();
        $session->invalidate();

        if($this->getResponse()->headers->has('set-cookie') || $this->getRequest()->cookies->has('remember')){
            $this->getResponse()->headers->clearCookie('remember');
        }

        return $this->redirectToAction('Default:index');
    }

    /**
     * Remember me cookie authentication passive action
     *
     * @return Response
     */
    public function authCookiePassiveAction()
    {
        $session = new Session();

        if($this->getRequest()->cookies->has('remember') && !$session->has('is_granted')){
            $cookie = unserialize($this->getRequest()->cookies->get('remember'));

            $request = new RememberedAuthRequest();
            $request->setRememberIdentifier($cookie['identifier']);
            $request->setRememberToken($cookie['token']);

            $service = $this->getContainer()->get('user.remembered_auth');
            $response = $service->process($request);

            if($response->isSuccess()){
                $session->set('is_granted', true);
                $session->set('user', $response->getUser());

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
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function signupAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $request = new SignupRequest();
            $request = $form->serializeData($request);

            $service = $this->getContainer()->get('user.signup');
            $response = $service->process($request);

            if($response->isSuccess()){
                $this->addFlash('success', 'Account created successfully. Check your mailbox for confirmation mail.');
                return $this->redirectToAction('Default:index');
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
     * @return JsonResponse
     */
    public function emailCheckAction()
    {
        $request = new EmailCheckRequest();
        $request->setEmail($this->getRequest()->request->get('email'));

        $service = $this->getContainer()->get('user.email_check');
        $response = $service->process($request);

        if(!$response->isSuccess()){
            return $this->json(['This email address is already taken.']);
        }

        return $this->json(["true"]);
    }

    /**
     * Sign up confirmation action
     * Route: /user/signupconfirmation/{token}
     *
     * @param string $token
     * @return RedirectResponse
     */
    public function signupConfirmationAction(string $token)
    {
        $request = new SignupConfirmationRequest();
        $request->setToken($token);

        $service = $this->getContainer()->get('user.signup_confirmation');
        $response = $service->process($request);

        if($response->isAlreadyActive()){
            $this->addFlash('warning', 'This account is already active.');
        } elseif (!$response->isSuccess()){
            $this->addFlash('warning', 'Invalid confirmation token.');
        } else {
            $this->addFlash('success', 'Account activated successfully. Now you can sign in!');
        }

        return $this->redirectToAction('Default:index');
    }
}