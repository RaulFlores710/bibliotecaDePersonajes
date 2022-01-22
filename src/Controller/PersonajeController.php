<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Raza;
use App\Form\CrearPersonajeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PersonajeController extends AbstractController
{
    public function index(Request $request, ManagerRegistry $doctrine,SluggerInterface $slugger): Response
    {
        $personaje= new Personaje();
        $form= $this->createForm(CrearPersonajeType::class,$personaje);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $foto = $form->get('foto')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($foto) {
                $nombreOriginal = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $nombreProcesado = $slugger->slug($nombreOriginal);
                $fotoFinal = $nombreProcesado.'-'.uniqid().'.'.$foto->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $foto->move(
                        $this->getParameter('media_directory'),
                        $fotoFinal
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $personaje->setFoto($fotoFinal);
            }
            $em=$doctrine->getManager();
            $em->persist($personaje);
            $em->flush();
            $this->addFlash('exito',"Personaje creado exitosamente!");
            return $this->redirect('personaje');

        }
        return $this->render('personaje/index.html.twig', [
            'formulario'=> $form->createView(),
        ]);
    }
    public function view(int $id,ManagerRegistry $doctrine){
        $em=$doctrine->getManager();
        $personaje=$em->getRepository(Personaje::class)->findOneBy(['id'=>$id]);
        return $this->render('personaje/unique.html.twig', [
            'personaje'=>$personaje,
        ]);
    }
}
