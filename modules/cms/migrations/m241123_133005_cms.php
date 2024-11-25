<?php

use yii\db\Migration;

/**
 * Class m241123_133005_cms
 */
class m241123_133005_cms extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('banners',[
            'id'=> $this->primaryKey(),
            'title'=> $this->string()->notNull(),
            'description'=> $this->string()->notNull(),
            'imageURL'=>$this->string(),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()


        ]);
        $this->createTable('contact_info', [
            'id' => $this->primaryKey(),
            'address' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()

        ]);
        $this->createTable('basic_info', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'logoUrl' => $this->string(),
            'url' => $this->string()->notNull(),
            'mission' => $this->string(),
            'vision' => $this->string(),




        ]);
        $this->createTable('socials', [
            'id' => $this->primaryKey(),
            'platform' => $this->string()->notNull(), // e.g., Twitter, Facebook
            'icon' => $this->string(),
            'link' => $this->string()->notNull(),
            'is_published' => $this->boolean()->defaultValue(1),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()

        ]);
        //about page 
        $this->createTable('about', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'imageURL' => $this->string(),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()



        ]);
        
       
        $this->createTable('partners', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'imageURL' => $this->string(),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()


        ]);


        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
          
            'description' => $this->text()->notNull(),
            'imageURL' => $this->string(255),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()

        ]);

      
    

        $this->createTable('faqs', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->text()->notNull(),
            'is_published' => $this->boolean()->defaultValue(1),
             'created_at' => $this->integer(),
            'updated_at' => $this->integer()

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241123_133005_cms cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241123_133005_cms cannot be reverted.\n";

        return false;
    }
    */
}
