<?php

namespace App\Controller;


use App\Form\SubscriberEditType;
use App\Model\Subscribers;
use App\Query\SubscribersSorting;
use App\Query\AllSubscribersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Subscriptions
 * @package App\Controller
 * @Route("/subscribers")
 */
class SubscribersController extends AbstractController
{
    /**
     * @Route("/",name="subscribers");
     */
    public function listAction(AllSubscribersQuery $allSubscribersQuery, ?SubscribersSorting $sorting):Response
    {
        return $this->render('subscribers-list.html.twig',[
            'subscribers' => $allSubscribersQuery($sorting),
            'sorting' => $sorting
        ]);
    }

    /**
     * @Route("/remove/{id}",);
     */
    public function removeAction(string $id, Subscribers $subscribers):Response
    {
        $subscribers->delete($id);
        $this->addFlash('success','Successful removed');
        return $this->redirectToRoute('subscribers');
    }

    /**
     * @Route("/edit/{id}");
     */
    public function editAction(string $id, Subscribers $subscribers, Request $request):Response
    {
        $subscriber = $subscribers->get($id);
        $form = $this->createForm(SubscriberEditType::class, [
            'name' => $subscriber->name,
            'email' => $subscriber->email
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $subscriber->editSubscriber($formData['name'],$formData['email']);
            $subscribers->save($subscriber);
            $this->addFlash('success', 'Successful updated');
            return $this->redirectToRoute('subscribers');
        }

        return $this->render('subscribers-edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}