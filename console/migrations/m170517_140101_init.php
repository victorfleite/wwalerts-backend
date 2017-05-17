<?php

use yii\db\Schema;

class m170517_140101_init extends \yii\db\Migration {

    public function up() {
	$tableOptions = null;
	if ($this->db->driverName === 'mysql') {
	    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
	}

	// Tables for ACL

	$this->createTable('user', [
	    'id' => $this->primaryKey(),
	    'username' => $this->string(255)->notNull(),
	    'auth_key' => $this->string(32)->notNull(),
	    'password_hash' => $this->string(255)->notNull(),
	    'password_reset_token' => $this->string(255),
	    'email' => $this->string(255)->notNull(),
	    'status' => $this->smallInteger()->notNull()->defaultValue(10),
	    'created_at' => $this->integer()->notNull(),
	    'updated_at' => $this->integer()->notNull(),
	    'name' => $this->string(255),
		], $tableOptions);

	$this->createTable('auth_rule', [
	    'name' => $this->string(64)->notNull(),
	    'data' => $this->binary(),
	    'created_at' => $this->integer(),
	    'updated_at' => $this->integer(),
	    'PRIMARY KEY ([[name]])',
		], $tableOptions);

	$this->createTable('auth_item', [
	    'name' => $this->string(64)->notNull(),
	    'type' => $this->smallInteger()->notNull(),
	    'description' => $this->text(),
	    'rule_name' => $this->string(64),
	    'data' => $this->binary(),
	    'created_at' => $this->integer(),
	    'updated_at' => $this->integer(),
	    'PRIMARY KEY ([[name]])',
	    'FOREIGN KEY ([[rule_name]]) REFERENCES auth_rule ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('auth_assignment', [
	    'item_name' => $this->string(64)->notNull(),
	    'user_id' => $this->string(64)->notNull(),
	    'created_at' => $this->integer(),
	    'PRIMARY KEY ([[item_name]], [[user_id]])',
	    'FOREIGN KEY ([[item_name]]) REFERENCES auth_item ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('auth_item_child', [
	    'parent' => $this->string(64)->notNull(),
	    'child' => $this->string(64)->notNull(),
	    'PRIMARY KEY ([[parent]], [[child]])',
	    'FOREIGN KEY ([[child]]) REFERENCES auth_item ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('menu', [
	    'id' => $this->primaryKey(),
	    'name' => $this->string(128)->notNull(),
	    'parent' => $this->integer(),
	    'route' => $this->string(256),
	    'order' => $this->integer(),
	    'data' => $this->text(),
	    'FOREIGN KEY ([[parent]]) REFERENCES menu ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	// Tables for OAUTH / REST

	$this->createTable('oauth_clients', [
	    'client_id' => $this->string(32)->notNull(),
	    'client_secret' => $this->string(32)->defaultValue('NULL::character varying'),
	    'redirect_uri' => $this->string(1000)->notNull(),
	    'grant_types' => $this->string(100)->notNull(),
	    'scope' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'user_id' => $this->integer(),
	    'PRIMARY KEY ([[client_id]])',
		], $tableOptions);

	$this->createTable('oauth_access_tokens', [
	    'access_token' => $this->string(40)->notNull(),
	    'client_id' => $this->string(32)->notNull(),
	    'user_id' => $this->integer(),
	    'expires' => $this->timestamp()->notNull()->defaultValue('NOW()'),
	    'scope' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'PRIMARY KEY ([[access_token]])',
	    'FOREIGN KEY ([[client_id]]) REFERENCES oauth_clients ([[client_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('oauth_authorization_codes', [
	    'authorization_code' => $this->string(40)->notNull(),
	    'client_id' => $this->string(32)->notNull(),
	    'user_id' => $this->integer(),
	    'redirect_uri' => $this->string(1000)->notNull(),
	    'expires' => $this->timestamp()->notNull()->defaultValue('NOW()'),
	    'scope' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'PRIMARY KEY ([[authorization_code]])',
	    'FOREIGN KEY ([[client_id]]) REFERENCES oauth_clients ([[client_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('oauth_jwt', [
	    'client_id' => $this->string(32)->notNull(),
	    'subject' => $this->string(80)->defaultValue('NULL::character varying'),
	    'public_key' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'PRIMARY KEY ([[client_id]])',
		], $tableOptions);

	$this->createTable('oauth_public_keys', [
	    'client_id' => $this->string(255)->notNull(),
	    'public_key' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'private_key' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'encryption_algorithm' => $this->string(100)->defaultValue('RS256'),
		], $tableOptions);

	$this->createTable('oauth_refresh_tokens', [
	    'refresh_token' => $this->string(40)->notNull(),
	    'client_id' => $this->string(32)->notNull(),
	    'user_id' => $this->integer(),
	    'expires' => $this->timestamp()->notNull()->defaultValue('NOW()'),
	    'scope' => $this->string(2000)->defaultValue('NULL::character varying'),
	    'PRIMARY KEY ([[refresh_token]])',
	    'FOREIGN KEY ([[client_id]]) REFERENCES oauth_clients ([[client_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
		], $tableOptions);

	$this->createTable('oauth_scopes', [
	    'scope' => $this->string(2000)->notNull(),
	    'is_default' => $this->boolean()->notNull(),
		], $tableOptions);
    }

    public function down() {


	// Remove Tables for OAUTH / REST
	$this->dropTable('oauth_scopes');
	$this->dropTable('oauth_public_keys');
	$this->dropTable('oauth_jwt');
	
	$this->dropTable('oauth_refresh_tokens');
	$this->dropTable('oauth_clients');
	$this->dropTable('oauth_access_tokens');
	$this->dropTable('oauth_authorization_codes');


	// Remove Tables for ACL
	$this->dropTable('menu');
	$this->dropTable('auth_item_child');
	$this->dropTable('auth_assignment');
	$this->dropTable('auth_item');
	$this->dropTable('auth_rule');
	$this->dropTable('user');
    }

}
