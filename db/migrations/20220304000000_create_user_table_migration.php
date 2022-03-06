<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addColumn('password', 'string', ['null' => false])
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('gender', 'string', ['null' => false])
            ->addColumn('age', 'integer', ['null' => false])
            ->addColumn('created', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['name' => 'unique_email', 'unique' => true])
            ->create();
    }
}
