<?php

function db_get_organisations( $mysqli )
{
    return $mysqli->query( 'SELECT * FROM organizations' );
}

function db_get_ixps( $mysqli, $orgid = null )
{
    return $mysqli->query( 'SELECT * FROM ixps' . ( $orgid ? ' WHERE parent_id = ' . $orgid : '' ) );
}
