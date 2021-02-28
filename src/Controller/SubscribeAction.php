<?php

namespace App\Controller;

use App\Form\SubscribeFormType;
use App\Model\Subscriber;
use App\Model\Subscribers;
use App\Model\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormAction
 * @package App\Controller
 * @Route("/")
 */
class SubscribeAction extends AbstractController
{
    public function __invoke(Subscribers $subscribers, Request $request)
    {
        $form = $this->createForm(SubscribeFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $subscriber = new Subscriber($formData['name'],$formData['email'], new Subscription(...$formData['categories']));
            $subscribers->save($subscriber);
            $this->addFlash('success', 'Successful subscribed');
            return new RedirectResponse('/');
        }

        return $this->render('subscribe.html.twig',[
            'form' => $form->createView()
            ]);
    }
}