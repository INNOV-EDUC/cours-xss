<?php

namespace WCS\XSSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WCS\XSSBundle\Entity\Comment;
use WCS\XSSBundle\Entity\Sweet;
use WCS\XSSBundle\Form\CommentType;
use WCS\XSSBundle\Form\SweetType;

/**
 * Sweet controller.
 *
 */
class SweetController extends Controller
{

    /**
     * Lists all Sweet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WCSXSSBundle:Sweet')->findAll();

        return $this->render('WCSXSSBundle:Sweet:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Sweet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Sweet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sweet_show', array('id' => $entity->getId())));
        }

        return $this->render('WCSXSSBundle:Sweet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Sweet entity.
     *
     * @param Sweet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sweet $entity)
    {
        $form = $this->createForm(new SweetType(), $entity, array(
            'action' => $this->generateUrl('sweet_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sweet entity.
     *
     */
    public function newAction()
    {
        $entity = new Sweet();
        $form   = $this->createCreateForm($entity);

        return $this->render('WCSXSSBundle:Sweet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sweet entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WCSXSSBundle:Sweet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sweet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $comments = $em->getRepository('WCSXSSBundle:Comment')->findBySweet($id);
        $comment = new Comment();
        $newcomment_form   = $this->createCreateCommentForm($comment);

        return $this->render('WCSXSSBundle:Sweet:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'comments'    => $comments,
            'newcomment_form' => $newcomment_form->createView()
        ));
    }

    private function createCreateCommentForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Sweet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WCSXSSBundle:Sweet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sweet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WCSXSSBundle:Sweet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sweet entity.
    *
    * @param Sweet $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sweet $entity)
    {
        $form = $this->createForm(new SweetType(), $entity, array(
            'action' => $this->generateUrl('sweet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sweet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WCSXSSBundle:Sweet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sweet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sweet_edit', array('id' => $id)));
        }

        return $this->render('WCSXSSBundle:Sweet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Sweet entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WCSXSSBundle:Sweet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sweet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sweet'));
    }

    /**
     * Creates a form to delete a Sweet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sweet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
