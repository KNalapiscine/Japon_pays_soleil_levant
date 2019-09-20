<?php


namespace App\Controller;



use App\Entity\Articles;
use App\Entity\Photos;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use App\Repository\MenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin/villes/delete/{id}", name="admin_villes_delete")
     */
    // je crée la route pour le formulaire pour les suppressions



    public function deleteVilles($id, MenusRepository $menusRepository, EntityManagerInterface $entityManager)
    {

        $ville = $menusRepository->find($id);

        $entityManager->remove($ville);
        $entityManager->flush();

        var_dump("ville supprimé"); die;


    }

    /**
     * @Route("/admin/articles/form_insert", name="admin_articles_form_insert")
     */
    // je crée la route pour le formulaire pour les insertions

    public function articleFormInsert(Request $request, EntityManagerInterface $entityManager )
    {
        $article = new Articles();

        $form = $this->createForm(ArticleType::class, $article);
        $formArticleView = $form->CreateView();


        // si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('POST')) {

            // le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);

           //pour ajouter une image
            /** @var UploadedFile $imageFile */
            $imageFile = $form['photos']->getData();

            // Condition nécessaire car le champ 'image' n'est pas requis
            // donc le fichier doit être traité que s'il est téléchargé
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Nécessaire pour inclure le nom du fichier en tant qu'URL + sécurité + nom unique
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                // Déplace le fichier dans le dossier des images d'articles
                try {
                    $imageFile->move(
                        $this->getParameter('article_images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // Création instance de la classe Photos() + renseignement de son nom
                $photo = new Photos();
                $photo->setNom($newFilename);


                //On relie la photo à l'article en question
                $photo->setArticles($article);
                $entityManager->persist($photo);
                $entityManager->flush();
            }

            //si le formulaire est valide
            if($form->isValid()){
                // on enregistre
                $entityManager->persist($article);
                $entityManager->flush();
            }

        }

        return $this->render('articleFormInsert.html.twig',[
            'form' => $formArticleView
    ]);
    }

    /**
     * @Route("/admin/", name="admin")
     */
    public function admin(ArticlesRepository $articlesRepository)
    {
        // render appelle le fichier twig et le compile en HTML

        $articles = $articlesRepository->findAll();

        return $this->render("AdminModification.html.twig",
            [
                'articles'=>$articles
            ]
        );

    }

    /**
     * @Route("/admin/articles/form_update/{id}", name="admin_articles_form_update")
     */
    // je crée la route pour le formulaire pour les modifications

    public function articleFormUpdate(Request $request, $id, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManager )
    {

        $article = $articlesRepository->find($id);

        $form = $this->createForm(ArticleType::class, $article);
        $formArticleView = $form->createView();


        // si la méthode est POST
        // si le formulaire est envoyé
        if ($request -> isMethod('POST')){

            // le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);

            // on vérifie que le formulaire est valide
            if($form->isValid()){


                // on enregistre l'entité créée avec persist
                $entityManager->persist($article);
                $entityManager->flush();

            }

        }

        return $this -> render ('articleFormUpdate.html.twig',

            [
                'formArticleView' => $formArticleView
            ]

        );

    }


}
