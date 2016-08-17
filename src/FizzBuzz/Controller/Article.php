<?php

namespace FizzBuzz\Controller;

class Article extends AbstractController
{
    public function view()
    {
        $articleID = (int) $this->getRoutedParam('id');
        if (!$articleID) {
            throw new \Exception("Article ID is invalid", 404);
        }

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $article = $articlesRepository->findById($articleID);

        if (!is_array($article) or !count($article)) {
            throw new \Exception("Article not found", 404);
        }

        $this->checkSlug($article);
        $this->tpl->article = $article;
        echo $this->tpl->render('article/view.phtml');
    }

    private function checkSlug($articleDetails)
    {
        $slug = $this->getRoutedParam('slug');
        if ($slug !== $articleDetails['slug']) {
            header('Location:'. $articleDetails['id']."-".$articleDetails['slug']);
            die();
        }
    }
}
