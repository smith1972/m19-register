<?php

$installer = $this;

if (!($installer instanceof Mage_Core_Model_Resource_Setup)) return;

$installer->startSetup();
$tableRegister = $installer->getTable('sak_register/register');
$tableClub = $installer->getTable('sak_register/club');

$table = $installer->getConnection()
    ->newTable($tableClub)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('years', Varien_Db_Ddl_Table::TYPE_TEXT, '7', array(
        'nullable'  => false,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, '50', array(
        'nullable'  => false,
    ))
;
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($tableRegister)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('shoe_size', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
    ))
    ->addColumn('clothing_size', Varien_Db_Ddl_Table::TYPE_TEXT, '25', array(
        'nullable'  => false,
        'default'   => '',
    ))
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, '50', array(
        'nullable'  => true,
    ))
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 2, array(
        'nullable'  => true,
    ))
    ->addColumn('club_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => true,
    ))
    ->addForeignKey($installer->getFkName('sak_register/register', 'club_id', 'sak_register/block', 'id'),
        'club_id', $installer->getTable('sak_register/club'), 'id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('sak_register/register', 'country_id', 'directory/country', 'country_id'),
        'country_id', $installer->getTable('dyrectory/country'), 'country_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
;
$installer->getConnection()->createTable($table);



$installer->endSetup();