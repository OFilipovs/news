<?php
namespace App\Models;
class Article
{
 private ?string $title;
 private ?string $author;
 private ?string $description;
 private ?string $urlToArticle;
 private ?string $urlToImage;
 private ?string $source;

    public function __construct(?string $title, ?string $author, ?string $description, ?string $urlToArticle, ?string $urlToImage, string $source)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->urlToArticle = $urlToArticle;
        $this->urlToImage = $urlToImage;
        $this->source = $source;
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function getAuthor(): ?string
    {
        return $this->author;
    }


    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrlToArticle(): string
    {
        return $this->urlToArticle;
    }

    public function getUrlToImage(): ?string
    {
        return $this->urlToImage;
    }

    public function getSource(): string
    {
        return $this->source;
    }

}