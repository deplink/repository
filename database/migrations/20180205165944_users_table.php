<?php

use Phinx\Migration\AbstractMigration;

class UsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function change()
    {
        $this->table('users')
            ->addColumn('mail', 'string', ['limit' => 50])
            ->addIndex('mail', ['unique' => true])
            ->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'binary', ['limit' => 64])
            ->create();
    }
}