<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

final class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
}
