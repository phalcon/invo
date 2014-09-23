<?php

/**
 * Programmatically bootstrap the database
 *
 */

use \Phalcon\Db\Column,
    \Phalcon\Db\Index,
    \Phalcon\Db\Reference;

$config = new Phalcon\Config\Adapter\Ini(__DIR__ . '/../app/config/config.ini');

$dbclass = sprintf('\Phalcon\Db\Adapter\Pdo\%s', $config->database->adapter);
$connection = new $dbclass(array(
	"host" => $config->database->host,
	"username" => $config->database->username,
	"password" => $config->database->password,
	"dbname" => $config->database->name
));

try {
	$connection->begin();

	$connection->createTable(
		"companies",
		null,
		array(
			"columns" => array(
				new Column("id", array(
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
					'autoIncrement' => TRUE,
				)),
				new Column("name", array(
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				)),
				new Column("telephone", array(
					'type' => Column::TYPE_VARCHAR,
					'size' => 30,
					'notNull' => TRUE,
				)),
				new Column("address", array(
					'type' => Column::TYPE_VARCHAR,
					'size' => 40,
					'notNull' => TRUE,
				)),
				new Column("city", array(
					'type' => Column::TYPE_VARCHAR,
					'size' => 40,
					'notNull' => TRUE,
				))
			),
			"indexes" => array(
				new Index("PRIMARY", array("id")),
			)
		)
	);

	$connection->execute("INSERT INTO `companies` VALUES (1,'Acme','31566564','Address','Hello'),(2,'Acme Inc','+44 564612345','Guildhall, PO Box 270, London','London')");

	$connection->createTable(
		"contact",
		null,
		[
			"columns" => [
				new Column("id", [
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
					'autoIncrement' => TRUE,
				]),
				new Column("name", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				]),
				new Column("email", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				]),
				new Column("comments", [
					'type' => Column::TYPE_TEXT,
					'notNull' => TRUE,
				]),
				new Column("created_at", [
					'type' => Column::TYPE_DATETIME,
				]),
			],
			"indexes" => [
				new Index("PRIMARY", array("id")),
			]
		]
	);

	$connection->createTable(
		"product_types",
		null,
		[
			"columns" => [
				new Column("id", [
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
					'autoIncrement' => TRUE,
				]),
				new Column("name", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				]),
			],
			"indexes" => [
				new Index("PRIMARY", array("id")),
			]
		]
	);

	$connection->execute("INSERT INTO `product_types` VALUES (5,'Vegetables'),(6,'Fruits')");

	$connection->createTable(
		"products",
		null,
		[
			"columns" => [
				new Column("id", [
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
					'autoIncrement' => TRUE,
				]),
				new Column("product_types_id", [
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
				]),
				new Column("name", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				]),
				new Column("price", [
					'type' => Column::TYPE_DECIMAL,
					'size' => 16,
					'scale' => 2,
					'notNull' => TRUE,
				]),
				new Column("active", [
					'type' => Column::TYPE_CHAR,
					'size' => 1,
				]),
			],
			"indexes" => [
				new Index("PRIMARY", array("id")),
			]
		]
	);

	$connection->execute("INSERT INTO `products` VALUES (1,5,'Artichoke','10.50','Y'),(2,5,'Bell pepper','10.40','Y'),(3,5,'Cauliflower','20.10','Y'),(4,5,'Chinese cabbage','15.50','Y'),(5,5,'Malabar spinach','7.50','Y'),(6,5,'Onion','3.50','Y'),(7,5,'Peanut','4.50','Y')");

	$connection->createTable(
		"users",
		null,
		[
			"columns" => [
				new Column("id", [
					'type' => Column::TYPE_INTEGER,
					'size' => 10,
					'unsigned' => TRUE,
					'notNull' => TRUE,
					'autoIncrement' => TRUE,
				]),
				new Column("username", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 32,
					'notNull' => TRUE,
				]),
				new Column("password", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 30,
					'notNull' => TRUE,
				]),
				new Column("name", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 120,
					'notNull' => TRUE,
				]),
				new Column("email", [
					'type' => Column::TYPE_VARCHAR,
					'size' => 70,
					'notNull' => TRUE,
				]),
				new Column("created_at", [
					'type' => Column::TYPE_DATETIME,
					'notNull' => TRUE,
				]),
				new Column("active", [
					'type' => Column::TYPE_CHAR,
					'size' => 1,
					'notNull' => TRUE,
				]),
			],
			"indexes" => [
				new Index("PRIMARY", array("id")),
			]
		]
	);

	$connection->execute("INSERT INTO users VALUES (1,'demo', 'c0bd96dc7ea4ec56741a4e07f6ce98012814d853','Phalcon Demo','demo@phalconphp.com','2012-04-10 20:53:03','Y')");

	$connection->commit();

} catch (Exception $e) {
	$connection->rollback();
	echo $e->getTraceAsString();
}
