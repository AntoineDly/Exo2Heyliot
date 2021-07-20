<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**      
     * @var apiService      
     */          
    private $apiService;
    
    /**      
     * apiService constructor.      
     *      
     * @param ApiService $apiService      
     */ 
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**      
     * return the page '/category' with all the categories 
     */ 
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $this->apiService->getCategories(),
        ]);
    }

    /**      
     * return the page '/category/{categoryId}/{page}' with 5 cats of the {categoryId} and of the {page}
     *      
     * @param int $categoryId 
     * @param int $page default 1        
     */ 
    #[Route('/category/{categoryId}/{page}', name: 'all')]
    public function all(int $categoryId, int $page = 1): Response
    {
        return $this->render('category/find.html.twig', [
            'cats' => $this->apiService->getCatsByCategory($categoryId, $page),
            'page' => $page,
            'categoryId' => $categoryId,
        ]);
    }
}
