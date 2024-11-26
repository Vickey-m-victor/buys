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
        $this->createTable('banners', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'imageURL' => $this->string(),
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
        $this->insert('contact_info', [
            'address' => '123 Main Street, Cityville',
            'phone' => '123-456-7890',
            'email' => 'info@example.com',
            'is_published' => 1, // Published
            'is_deleted' => 0,   // Not deleted
            'created_at' => time(),
            'updated_at' => time(),

        ]);
        $this->createTable('basic_info', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'logoUrl' => $this->string(),
            'url' => $this->string()->notNull(),
            'mission' => $this->string(),
            'vision' => $this->string(),
            'is_published' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
           


        ]);
        $this->insert('basic_info', [
            'name' => 'Tech Solutions Ltd.',
            'logoUrl' => 'https://example.com/images/logo.png',
            'url' => 'https://www.techsolutions.com',
            'mission' => 'To deliver cutting-edge tech solutions.',
            'vision' => 'To be the leader in innovation and excellence.',
            'is_published' => 1,
            'is_deleted' => 0,   // Not deleted
            'created_at' => time(),
            'updated_at' => time(),


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
        $this->insert('about',[
            'title' => 'About Our Company',
    'description' => 'We are a leading provider of innovative solutions, dedicated to improving lives and driving success through technology.',
    'imageURL' => 'https://example.com/images/about-us.jpg',
    'is_published' => 1, // Published
    'is_deleted' => 0,   // Not deleted
    'created_at' => time(),
    'updated_at' => time(),
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
            'is_deleted' => $this->boolean()->defaultValue(0),
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
