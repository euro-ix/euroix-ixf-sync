#! /usr/local/bin/php
<?php

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'utils.php';
require_once 'database-functions.php';


$orgs = db_get_organisations( $mysqli );

while( $org = $orgs->fetch_array( MYSQLI_ASSOC ) )
{
    if( $org['id'] < 1141 ) continue;

    ixf_create_or_update( 'IXF\\Org', $org );

    $ixps = db_get_ixps( $mysqli, $org['id'] );
    while( $ixp = $ixps->fetch_array( MYSQLI_ASSOC ) )
    {
        ixf_create_or_update( 'IXF\\IXP', $ixp );
    }
}
