<?php
require_once 'config.php';
require_once 'classes/version.class.php';
$db = new db_e;
$version = new version;

if ( isset($_GET['oldVersion']) ) {
	$oldVersion = $_GET['oldVersion'];	
} else {
	$oldVersion = $version->getVersion();
}
switch ( $oldVersion ) {
	case '102.00':
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ADD COLUMN `exMasks` text";
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ADD COLUMN `scriptVersion` float";
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ALTER COLUMN `scriptVersion` SET DEFAULT '102.01'";
		$tables[] = "UPDATE ".$config['db_prefix']."external_settings SET scriptVersion = 102.01";
		break;
	case '102.01':
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ADD COLUMN `archivation` ENUM('yes','no')";
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ADD COLUMN `blackRefs` text";
		$tables[] = "ALTER TABLE ".$config['db_prefix']."external_settings ALTER COLUMN `archivation` SET DEFAULT 'no'";
		$tables[] = "UPDATE ".$config['db_prefix']."external_settings SET archivation = 'no'";
		$tables[] = "UPDATE ".$config['db_prefix']."external_settings SET scriptVersion = 102.02";
		break;
}
print( '�������� ���������� ��...<br />' );
for ( $i = 0; $i < count( $tables ); $i++ ) {
	$db->ExecQuery( $tables[$i] );
	print( ($i + 1).'/'.count( $tables ).'<br />' );
}
print( '���������� ���������!<br />' );
print( '<b><font color="red">������� ����� update.php � install.php !!!</font></b>' );
?>