<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Participant;
use AppBundle\Form\ParticipantType;

/**
 * Participant controller.
 *
 */
class ParticipantController extends Controller
{

    /**
     * Lists all Participant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Participant')->findAll();

        return $this->render('AppBundle:Participant:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Participant entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Participant();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('participant_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Participant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Participant entity.
     *
     * @param Participant $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Participant $entity)
    {
        $form = $this->createForm(new ParticipantType(), $entity, array(
            'action' => $this->generateUrl('participant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Participant entity.
     *
     */
    public function newAction()
    {
        $entity = new Participant();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Participant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Participant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Participant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Participant:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Participant entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Participant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participant entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Participant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Participant entity.
    *
    * @param Participant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Participant $entity)
    {
        $form = $this->createForm(new ParticipantType(), $entity, array(
            'action' => $this->generateUrl('participant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Participant entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Participant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('participant_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Participant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Participant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Participant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Participant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('participant'));
    }

    /**
     * Creates a form to delete a Participant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
