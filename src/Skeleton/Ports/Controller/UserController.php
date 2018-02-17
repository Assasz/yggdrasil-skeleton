<?php

namespace Skeleton\Ports\Controller;

use Skeleton\Application\Service\UserModule\Request\EmailCheckerRequest;
use Skeleton\Application\Service\UserModule\Request\RememberedAuthRequest;
use Skeleton\Application\Service\UserModule\Request\SignupConfirmationRequest;
use Skeleton\Application\Service\UserModule\Request\SignupRequest;
use Skeleton\Application\Service\UserModule\Request\UserAuthRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Yggdrasil\Core\Form\FormHandler;

class UserController extends AbstractController
{
    public function signinAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $rememberMe = $form->hasData('remember_me');

            $authRequest = new UserAuthRequest();
            $authRequest = $form->serializeData($authRequest);
            $authRequest->setRemember($rememberMe);

            $authService = $this->getContainer()->get('user_auth');
            $authResponse = $authService->process($authRequest);

            $session = new Session();

            if(!$authResponse->isSuccess()){
                $session->getFlashBag()->set('danger', 'Authentication failed. Incorrect e-mail address or password.');
                return $this->render('user/signin.html.twig');
            }

            if(!$authResponse->isEnabled()){
                $session->getFlashBag()->set('danger', 'Account is not activated. Check your mailbox for confirmation mail.');
                return $this->render('user/signin.html.twig');
            }

            $session->set('is_granted', true);
            $session->set('user', $authResponse->getUser());

            if($rememberMe){
                $cookie['identifier'] = $authResponse->getUser()->getRememberIdentifier();
                $cookie['token'] = $authResponse->getRememberToken();

                $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
            }

            return $this->redirectToAction('Default:index');
        }

        return $this->render('user/signin.html.twig');
    }

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

    public function authCookiePassiveAction()
    {
        $session = new Session();

        if($this->getRequest()->cookies->has('remember') && !$session->has('is_granted')){
            $cookie = unserialize($this->getRequest()->cookies->get('remember'));

            $authRequest = new RememberedAuthRequest();
            $authRequest->setRememberIdentifier($cookie['identifier']);
            $authRequest->setRememberToken($cookie['token']);

            $authService = $this->getContainer()->get('remembered_auth');
            $authResponse = $authService->process($authRequest);

            if($authResponse->isSuccess()){
                $session->set('is_granted', true);
                $session->set('user', $authResponse->getUser());

                $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
            }
        }

        return $this->getResponse();
    }

    public function signupAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $signupRequest = new SignupRequest();
            $signupRequest = $form->serializeData($signupRequest);
            $signupService = $this->getContainer()->get('signup');
            $response = $signupService->process($signupRequest);

            $session = new Session();

            if($response->isSuccess()){
                $session->getFlashBag()->set('success', 'Account created successfully. Check your mailbox for confirmation mail.');

                return $this->redirectToAction('Default:index');
            }

            $session->getFlashBag()->set('danger', 'Something went wrong.');
        }

        return $this->render('user/signup.html.twig');
    }

    public function checkEmailAction()
    {
        $checkerRequest = new EmailCheckerRequest();
        $checkerRequest->setEmail($this->getRequest()->request->get('email'));

        $checkerService = $this->getContainer()->get('email_checker');
        $checkerResponse = $checkerService->process($checkerRequest);

        if(!$checkerResponse->isSuccess()){
            return $this->json(['This email address is already taken.']);
        }

        return $this->json(["true"]);
    }

    public function signupConfirmationAction(string $token)
    {
        $confirmationRequest = new SignupConfirmationRequest();
        $confirmationRequest->setToken($token);

        $confirmationService = $this->getContainer()->get('signup_confirmation');
        $confirmationResponse = $confirmationService->process($confirmationRequest);

        $session = new Session();

        if($confirmationResponse->isAlreadyActive()){
            $session->getFlashBag()->set('warning', 'This account is already active.');
        } elseif (!$confirmationResponse->isSuccess()){
            $session->getFlashBag()->set('warning', 'Invalid confirmation token.');
        } else {
            $session->getFlashBag()->set('success', 'Account activated successfully. Now you can sign in!');
        }

        return $this->redirectToAction('Default:index');
    }
}