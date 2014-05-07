<?php

IXF\IXF::setApiBase( 'https://www.example.com/api' );
IXF\IXF::setApiUser( 'guest' );
IXF\IXF::setApiPass( 'guest' );
IXF\IXF::setVerifySslCerts( true );
IXF\IXF::setDebug( false );


// database access details
$dbuser = 'euroix';
$dbpass = 'euroix';
$dbname = 'euroix';
$dbhost = 'localhost';

$mysqli = new mysqli( $dbhost, $dbuser, $dbpass, $dbname );

if( $mysqli->connect_errno ) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}
