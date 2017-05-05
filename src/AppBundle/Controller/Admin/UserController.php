<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\User;
use AppBundle\Controller\Traits\UtilitiesTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @Route("/utilisateurs")
 */
class UserController extends Controller
{
    use UtilitiesTrait;

    /**
     * Liste des utilisateurs
     *
     * @Route("/", name="admin_user_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Suppression d'un utilisateur
     *
     * @Route("/supprimer/{user}", name="admin_user_delete")
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function deleteAction(User $user)
    {
        $em      = $this->getDoctrine()->getManager();
        $em->remove($user);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.admin.user.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.user.delete.danger');
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
