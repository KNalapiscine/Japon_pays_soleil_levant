<?php


namespace App\Controller;



use App\Entity\Articles;
use App\Form\AuthorType;
use App\Repository\ArticlesRepository;
use App\Repository\MenusRepository;
use App\Repository\SousMenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{

    // route vers le fichier, qui contient tous les articles sur une ville //
    /**
     * @Route("/ville", name="ville")
     */

    // je crée une fonction que je nomme ville
    // j' instancie la classe ArticlesRepository
    // ArticlesRepository me permet de récupérer des élémnets de ma base de données
    public function ville( SousMenusRepository $sousMenusRepository,MenusRepository $menusRepository,ArticlesRepository $articlesRepository, Request $request)
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

        //dump($authors); die;


        return $this->render("article.html.twig",
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

