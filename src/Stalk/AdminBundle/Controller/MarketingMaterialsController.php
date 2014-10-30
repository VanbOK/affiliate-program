<?php

namespace Stalk\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stalk\AdminBundle\Entity\MarketingMaterials;
use Stalk\AdminBundle\Form\MarketingMaterialsType;

/**
 * MarketingMaterials controller.
 *
 */
class MarketingMaterialsController extends Controller
{

    /**
     * Displays a form to edit an existing MarketingMaterials entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:MarketingMaterials')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MarketingMaterials entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('StalkAdminBundle:MarketingMaterials:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a MarketingMaterials entity.
    *
    * @param MarketingMaterials $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MarketingMaterials $entity)
    {
        $form = $this->createForm(new MarketingMaterialsType(), $entity, array(
            'action' => $this->generateUrl('marketing-materials_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing MarketingMaterials entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:MarketingMaterials')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MarketingMaterials entity.');
        }

        //Выборка прикрепленных PDF
        $beforeSavePdfs = $currentPdfIds = array();
        foreach ($entity->getPdf() as $pdf)
            $beforeSavePdfs[$pdf->getId()] = $pdf;
        
        //Выборка прикрепленных изображений
        $beforeSaveImages = $currentImageIds = array();
        foreach ($entity->getImage() as $image)
            $beforeSaveImages[$image->getId()] = $image;
        
        //Выборка прикрепленных видео
        $beforeSaveVideos = $currentVideoIds = array();
        foreach ($entity->getVideo() as $video)
            $beforeSaveVideos[$video->getId()] = $video;
        
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            //Добавляем PDF
            foreach ($entity->getPdf() as $pdf) {

                $time = new \DateTime();
                $pdf->setMaterial($entity);
                $pdf->setTitle($pdf->getTitle());
                
                $file = $pdf->getFile();

                if ( !empty($file) ) {
                    
                    $pdfName = $time->format('U') . '_' . str_replace(' ', '_', $file->getClientOriginalName()); 
                    
                    $file->move($pdf->getAbsolutePath(), $pdfName);
                    
                    $pdf->setLink('/' . $pdf->getWebPath() . '/' . $pdfName);
                    
                }   
                
                $image = $pdf->getThumbnail();
                
                if ( !empty($image) ) {
                    
                    $imageName = $time->format('U') . '_' . str_replace(' ', '_', $image->getClientOriginalName()); 
                    
                    $image->move($pdf->getAbsolutePath(), $imageName);
                    
                    $pdf->setImage('/' . $pdf->getWebPath() . '/' . $imageName);
                    
                } 

                //Если вложение - не только что занесенная (у нее есть id)
                if ($pdf->getId()) $currentPdfIds[] = $pdf->getId();

            }
            
            //Добавляем изображение     
            foreach ($entity->getImage() as $image) {

                $image->setMaterial($entity); 
                $image->setTitle($image->getTitle());
                
                $img = $image->getFile();
                
                if ( !empty($img) ) {
                    
                    $imgName = str_replace(' ', '_', $img->getClientOriginalName()); 
                    
                    $img->move($image->getAbsolutePath(), $imgName);
                    
                    $image->setImage('/' . $image->getWebPath() . '/' . $imgName);
                    
                }          

                //Если вложение - не только что занесенная (у нее есть id)
                if ($image->getId()) $currentImageIds[] = $image->getId();

            }
            
            //Добавляем видео    
            foreach ($entity->getVideo() as $video) {

                $video->setMaterial($entity); 
                $video->setTitle($video->getTitle());
                $video->setUrl($video->getUrl());         

                $thumbnail = $video->getFile();
                
                if ( !empty($thumbnail) ) {
                    
                    $thumbnailName = str_replace(' ', '_', $thumbnail->getClientOriginalName()); 
                    
                    $thumbnail->move($video->getAbsolutePath(), $thumbnailName);
                    
                    $video->setThumbnail('/' . $video->getWebPath() . '/' . $thumbnailName);
                    
                } 
                
                //Если видео - не только что занесенная (у нее есть id)
                if ($video->getId()) $currentVideoIds[] = $video->getId();

            }
            
            $em->persist($entity);
            
            //Если PDF которая была до сохранения отсутствует в текущем наборе - удаляем его
            foreach ($beforeSavePdfs as $pdfId => $pdf)
                if (!in_array( $pdfId, $currentPdfIds)) $em->remove($pdf);
            
            //Если изображение которая была до сохранения отсутствует в текущем наборе - удаляем его
            foreach ($beforeSaveImages as $imageId => $image)
                if (!in_array( $imageId, $currentImageIds)) $em->remove($image);
                
            //Если видео которая было до сохранения отсутствует в текущем наборе - удаляем его
            foreach ($beforeSaveVideos as $videoId => $video)
                if (!in_array( $videoId, $currentVideoIds)) $em->remove($video);
                
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice-successfully', 'Cохранено!');

            return $this->redirect($this->generateUrl('marketing-materials_edit', array('id' => $id)));
        }

        return $this->render('StalkAdminBundle:MarketingMaterials:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }
}
