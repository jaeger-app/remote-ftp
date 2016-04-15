<?php
/**
 * Jaeger
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015-2016, mithra62, Eric Lamb
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Remote/Ftp.php
 */
namespace JaegerApp\Remote;

use League\Flysystem\Adapter\Ftp as Adapter;
use RuntimeException;
use JaegerApp\Remote\Ftp as m62Ftp;

/**
 * Jaeger - FTP Transfer Abstraction
 *
 * Simple intermediary between Flysystem and mithra62
 *
 * @package Remote
 * @author Eric Lamb <eric@mithra62.com>
 */
class Ftp extends Adapter
{

    /**
     * (non-PHPdoc)
     * 
     * @see \League\Flysystem\Adapter\Ftp::connect()
     */
    public function connect()
    {
        @parent::connect();
    }
    
    /**
     * (non-PHPdoc)
     * @see \League\Flysystem\Adapter\Ftp::getMetadata()
     */
    public function getMetadata($path)
    {
        return @parent::getMetadata($path);
    }

    /**
     * Returns the remote transport client
     * 
     * @param array $params
     *            An array of the connection details
     * @return \JaegerApp\Remote\Ftp
     */
    public static function getRemoteClient(array $params)
    {
        return new m62Ftp([
            'host' => $params['ftp_hostname'],
            'username' => $params['ftp_username'],
            'password' => $params['ftp_password'],
            'port' => $params['ftp_port'],
            'passive' => (isset($params['ftp_passive']) ? $params['ftp_passive'] : '0'),
            'ssl' => (! empty($params['ftp_ssl']) ? $params['ftp_ssl'] : '0'),
            'timeout' => (! empty($params['ftp_timeout']) ? $params['ftp_timeout'] : '30')
        ]);
    }
}