<?php
 
namespace App\Service;
 
use Symfony\Contracts\HttpClient\HttpClientInterface;
 
class ApiService
{
    /**      
     * @var client      
     */          
    private $client;
    
    /**      
     * client constructor.      
     *      
     * @param HttpClientInterface $client      
     */ 
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**      
     * return an array with all the categories 
     */ 
    public function getCategories(): array
    {
        return $this->getApi('categories');
    }

    /**      
     * return an array with 5 cats of the category and the page
     * 
     * @param int $categoryId
     * @param int $page
     */ 
    public function getCatsByCategory(int $categoryId, int $page): array
    {
        return $this->getApi('images/search?limit=5&page=' . $page . 'category_ids=' . $categoryId);
    }

    /**      
     * create the response by making the request with the method GET and returning the response as an array
     * 
     * @param string $apiReferences
     */ 
    private function getApi(string $apiReferences): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.thecatapi.com/v1/' . $apiReferences, [
                'headers' => [
                    'x-api-key' => '97f2205b-7fd1-4493-b1f2-b8a3f0d2e9cc',
                ],
            ]
        );
        return $response->toArray();
    }
}