<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLoginTokenTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('login_token');
        $table->addColumn('user_id', 'string', ['null' => false])
            ->addColumn('token', 'string', ['null' => false])
            ->addColumn('created', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey(
                'user_id',
                'user',
                'id',
                [
                    'constraint' => 'fk_user_table_id_login_token_user_id',
                    'delete' => 'CASCADE'
                ]
            )
            ->create();
    }
}
