<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ArticleTagSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'ArticleSeed',
            'TagSeed',
        ];
    }
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            ['tag_id' => 1,  'article_id' => 1],
            ['tag_id' => 2,  'article_id' => 1],
        ];

        $this->table('article_tag')->insert($data)->saveData();
    }
}
