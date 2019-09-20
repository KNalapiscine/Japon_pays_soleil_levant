<?php


namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\MenusRepository;
use App\Repository\SousMenusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;





class HomeController extends AbstractController
    {
        // route pour l' index : je declare ma route //
        /**
         * @Route("/", name="home")
         */

    // je crée une fonction que je nomme home
    // j' instancie la classe ArticlesRepository
    // ArticlesRepository me permet de récupérer des élémnets de ma base de données
    public function home(SousMenusRepository $sousMenusRepository,MenusRepository $menusRepository,ArticlesRepository $articlesRepository,Request $request)
            {
                // récupération des menus avec un repo (findAll() )
                $ville = $request->query->get('ville');
                $menus = $menusRepository->findAll();
                // récupération des menus avec un repo (findAll() )
                $sousMenus = $sousMenusRepository->getSousMenus();

                //passage des menus dans twig
                // coté twig: une boucle avec les villes

                // j'utilise la methode find id du repository pour récupérer tous mes articles sur Tokyo
                $articles = $articlesRepository->findBySousMenus($ville);


                // redirection vers le fichier twig
                return $this->render("index.html.twig",
                    [
                        'articles' => $articles,
                        'ville' => $ville,
                        'menus' =>$menus,
                        'sousMenus' => $sousMenus
                    ]

                // coté twig: une boucle avec les villes

                );
            }
    }
