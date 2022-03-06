<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSwipesTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('swipe');
        $table->addColumn('user_id', 'string', ['null' => false])
            ->addColumn('profile_id', 'string', ['null' => false])
            ->addColumn('positive_swipe', 'integer', ['null' => false])
            ->addColumn('created', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey(
                'user_id',
                'user',
                'id',
                [
                    'constraint' => 'fk_user_table_id_user_id',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'profile_id',
                'user',
                'id',
                [
                    'constraint' => 'fk_user_table_id_profile_id',
                    'delete' => 'CASCADE'
                ]
            )
            ->addIndex(['user_id', 'profile_id'], ['name' => 'unique_match', 'unique' => true])
            ->create();
    }
}
