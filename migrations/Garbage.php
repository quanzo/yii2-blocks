<?php
namespace x51\yii2\modules\blocks\migrations;

use yii\db\Migration;

class Garbage extends Migration
{
    public $baseTableName = 'blocks';

    public function init()
    {
        parent::init();
    } // end init

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $tblPosts = [
            'id' => $this->bigInteger()->notNull()->defaultValue(0),
            'code' => $this->string(75)->notNull(),
            'sort' => $this->integer()->defaultValue(100),
            'bgroup' => $this->string(75)->defaultValue('ungroup'),
            'name' => $this->string(250)->defaultValue(''),
            'intro' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'epilog' => $this->text()->notNull(),
            'comment' => $this->string(75)->defaultValue(''),
            'callback' => $this->string(75)->defaultValue(''),
			'active' => $this->tinyInteger()->defaultValue(1),
            'permission' => $this->string(150)->defaultValue(''),
            'route' => $this->string(150)->defaultValue(''),
			'user_id' => $this->integer()->defaultValue(0),

            'garbage_id' => $this->primaryKey(),
            'garbage_date' => $this->timestamp()->defaultValue(null),
            'garbage_op' => $this->string(9)->defaultValue('delete'),
        ];
        $this->createTable('{{%' . $this->baseTableName . '_garbage}}', $tblPosts, $tableOptions);
        $this->createIndex('k_garbageblocks_id', '{{%' . $this->baseTableName . '_garbage}}', 'id');

        //************************************************        

        // триггеры для {{%'.$this->baseTableName.'}}
        $tgName = '{{%' . $this->baseTableName . '_after_delete_tg}}';
        $this->execute('DROP TRIGGER IF EXISTS ' . $tgName);
        $this->execute('CREATE TRIGGER ' . $tgName . ' AFTER DELETE ON {{%' . $this->baseTableName . '}} FOR EACH ROW BEGIN INSERT INTO {{%' . $this->baseTableName . '_garbage}} (`id`, `code`, `sort`, `group`, `name`, `intro`, `content`, `epilog`,`comment`, `callback`, `active`, `permission`, `route`, `user_id`, `garbage_date`, `garbage_op`) VALUES (OLD.id, OLD.code, OLD.sort, OLD.bgroup, OLD.name, OLD.intro, OLD.content, OLD.epilog, OLD.comment, OLD.callback, OLD.active, OLD.permission, OLD.route, OLD.user_id, NOW(), "delete");END');
        $tgName = '{{%' . $this->baseTableName . '_after_update_tg}}';
        $this->execute('DROP TRIGGER IF EXISTS ' . $tgName);
        $this->execute('CREATE TRIGGER ' . $tgName . ' AFTER UPDATE ON {{%' . $this->baseTableName . '}} FOR EACH ROW BEGIN INSERT INTO {{%' . $this->baseTableName . '_garbage}} (`id`, `code`, `sort`, `group`, `name`, `intro`, `content`, `epilog`, `comment`, `callback`, `active`, `permission`, `route`, `user_id`, `garbage_date`, `garbage_op`) VALUES (OLD.id, OLD.code, OLD.sort, OLD.bgroup, OLD.name, OLD.intro, OLD.content, OLD.epilog, OLD.comment, OLD.callback, OLD.active, OLD.permission, OLD.route, OLD.user_id, NOW(), "update");END');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%' . $this->baseTableName . '_garbage}}');
        $this->execute('DROP TRIGGER IF EXISTS {{%' . $this->baseTableName . '_after_delete_tg}}');
        $this->execute('DROP TRIGGER IF EXISTS {{%' . $this->baseTableName . '_after_update_tg}}');        
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "m180808_101456_posts_garbage cannot be reverted.\n";

return false;
}
 */
} // end class
