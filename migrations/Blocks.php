<?php
namespace x51\yii2\modules\blocks\migrations;
	use yii\db\Migration;

class Blocks extends Migration {
    public $baseTableName = 'blocks';
	
	public function init() {
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
		
		// создаем таблицы
		$tblPosts = [
            'id' => $this->primaryKey(),
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
        ];
		$this->createTable('{{%'.$this->baseTableName.'}}', $tblPosts, $tableOptions);
			$this->createIndex('k_'.$this->baseTableName.'_code', '{{%'.$this->baseTableName.'}}', 'code', true);
            $this->createIndex('k_'.$this->baseTableName.'_user', '{{%'.$this->baseTableName.'}}', 'user_id');
            $this->createIndex('k_'.$this->baseTableName.'_group', '{{%'.$this->baseTableName.'}}', 'bgroup');
            $this->createIndex('k_'.$this->baseTableName.'_sort', '{{%'.$this->baseTableName.'}}', 'sort');
            $this->createIndex('k_'.$this->baseTableName.'_group_sort', '{{%'.$this->baseTableName.'}}', ['bgroup', 'sort']);
			$this->createIndex('k_'.$this->baseTableName.'_active', '{{%'.$this->baseTableName.'}}', 'active');
	} // end safeUp

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('{{%'.$this->baseTableName.'}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180806_115337_article cannot be reverted.\n";

        return false;
    }
    */
} // end class