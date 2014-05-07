<?php

function utf8ify( $a )
{
    if( is_array( $a ) )
    {
        foreach( $a as $k => $v )
            $a[ $k ] = utf8ify( $v );
    }
    else
        return IXF\ApiRequestor::utf8( $a );

    return $a;
}

function ixf_create_or_update( $classname, $params )
{
    $params = utf8ify( $params );

    if( array_key_exists( 'updated_at', $params ) )
    {
        $dt = new DateTime();
        $params['updated_at'] = $dt->format( 'Y-m-d H:i:s' );
    }

    // if it exists, update it, otherwise create it
    $ixfObject = $classname::retrieve( $params['id'] );

    if( isset( $ixfObject->error_code ) )
    {
        if( $ixfObject->error_code = IXF\Error::ERROR_OBJECT_NOT_FOUND )
        {
            $newObjIdArray = $classname::create( $params );

            if( is_array( $newObjIdArray ) && isset( $newObjIdArray['error'] ) )
            {
                echo "\nError: [" . $newObjIdArray['error_code'] . "] " . $newObjIdArray['error'] . "\n";
                echo "    => creating {$classname} ID: " . $params['id'] . "\n";
            }
        }
        else
        {
            echo "Error: [" . $ixfObject['error_code'] . "] " . $ixfObject['error'] . "\n";
            echo "    => retrieving {$classname} ID: " . $params['id'] . "\n";
        }
    }
    else
    {
        $ixfObject->refreshFrom( $params );
        if( ( $resp = $ixfObject->save() ) !== true )
        {
            echo "Error: [" . $resp['error_code'] . "] " . $resp['error'] . "\n";
            echo "    => updating {$classname} ID: " . $params['id'] . "\n";
        }
    }

}
