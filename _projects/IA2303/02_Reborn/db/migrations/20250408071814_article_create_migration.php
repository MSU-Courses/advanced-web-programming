<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ArticleCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $articles = $this->table('article');
        $articles->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('content', 'text', ['limit' => 1000])
            ->create();
    }
}
