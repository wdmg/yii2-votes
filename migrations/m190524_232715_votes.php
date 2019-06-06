<?php

use yii\db\Migration;

/**
 * Class m190524_232715_votes
 */
class m190524_232715_votes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%votes}}', [
            'id'=> $this->bigPrimaryKey(20),
            'user_id' => $this->integer(),
            'user_ip' => $this->string(39)->notNull(),
            'entity_id' => $this->string(32)->notNull(),
            'target_id' => $this->integer()->null(),
            'vote_value' => $this->tinyInteger(1)->null()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('idx_votes_user','{{%votes}}', ['user_id', 'user_ip'],false);
        $this->createIndex('idx_votes_condition','{{%votes}}', ['entity_id', 'target_id'],false);
        $this->createIndex('idx_votes_vote','{{%votes}}', ['vote_value'],false);

        // If exist module `Users` set foreign key `user_id` to `users.id`
        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users'])) {
            $userTable = \wdmg\users\models\Users::tableName();
            $this->addForeignKey(
                'fk_votes_to_users',
                '{{%votes}}',
                'user_id',
                $userTable,
                'id',
                'NO ACTION',
                'CASCADE'
            );
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_votes_user', '{{%votes}}');
        $this->dropIndex('idx_votes_condition', '{{%votes}}');
        $this->dropIndex('idx_votes_vote', '{{%votes}}');

        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users'])) {
            $userTable = \wdmg\users\models\Users::tableName();
            if (!(Yii::$app->db->getTableSchema($userTable, true) === null)) {
                $this->dropForeignKey(
                    'fk_votes_to_users',
                    '{{%votes}}'
                );
            }
        }

        $this->truncateTable('{{%votes}}');
        $this->dropTable('{{%votes}}');
    }

}
