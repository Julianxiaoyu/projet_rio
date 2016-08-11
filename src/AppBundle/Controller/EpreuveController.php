<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Epreuve;
use AppBundle\Form\EpreuveType;

/**
 * Epreuve controller.
 *
 */
class EpreuveController extends Controller
{

    /**
     * Lists all Epreuve entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Epreuve')->findAll();

        return $this->render('AppBundle:Epreuve:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Epreuve entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Epreuve();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $entity->getPath();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->container->getParameter('document_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $entity->setPath($fileName);            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('epreuve_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Epreuve:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Epreuve entity.
     *
     * @param Epreuve $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Epreuve $entity)
    {
        $form = $this->createForm(new EpreuveType(), $entity, array(
            'action' => $this->generateUrl('epreuve_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Epreuve entity.
     *
     */
    public function newAction()
    {
        $entity = new Epreuve();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Epreuve:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Epreuve entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epreuve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epreuve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Epreuve:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Epreuve entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epreuve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epreuve entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Epreuve:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Epreuve entity.
    *
    * @param Epreuve $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Epreuve $entity)
    {
        $form = $this->createForm(new EpreuveType(), $entity, array(
            'action' => $this->generateUrl('epreuve_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Epreuve entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epreuve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epreuve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('epreuve_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Epreuve:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Epreuve entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Epreuve')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Epreuve entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('epreuve'));
    }

    /**
     * Creates a form to delete a Epreuve entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('epreuve_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
