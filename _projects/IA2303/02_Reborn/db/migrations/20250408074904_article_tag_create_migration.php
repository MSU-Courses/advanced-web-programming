<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ArticleTagCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('article_tag')
            ->addColumn('tag_id', 'integer')
            ->addColumn('article_id', 'integer')
            ->addForeignKey('tag_id', 'tag', 'id', [
                'delete' => 'SET_NULL',
            ])
            ->addForeignKey('article_id', 'article', 'id', [
                'delete' => 'SET_NULL',
            ])
            ->create();
    }
}
