<?php
namespace App\Services;
use App\Models\Article;
use App\Models\Collections\ArticlesCollection;
use jcobhams\NewsApi\NewsApi;

class ShowArticleService
{
    public function execute($topic): ArticlesCollection
    {
        $token = $_ENV["TOKEN"];
        $newsApi = new NewsApi($token);
        $newsApiResponse = $newsApi->getEverything($topic);
//        echo "<pre>";
//        var_dump($json);
        if ($newsApiResponse->totalResults === 0){
            $newsApiResponse = $newsApi->getEverything("panda");
        }
        $articles = [];
        $articlesPerPage = 9;
        for ($i = 0; $i < $articlesPerPage; $i++) {

            $articles[] = new Article
            (
                $newsApiResponse->articles[$i]->title,
                $newsApiResponse->articles[$i]->author,
                $newsApiResponse->articles[$i]->description,
                $newsApiResponse->articles[$i]->url,
                $newsApiResponse->articles[$i]->urlToImage,
                $newsApiResponse->articles[$i]->source->name

            );
        }
        return new ArticlesCollection($articles);

    }
}