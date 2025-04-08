<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class TagSeed extends AbstractSeed
{
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
            ['title' => 'holiday'],
            ['title' => 'sport'],
        ];

        $this->table('tag')->insert($data)->saveData();
    }
}
