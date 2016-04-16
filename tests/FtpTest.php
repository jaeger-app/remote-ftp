<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/FtpTest.php
 */
namespace JaegerApp\tests\Remote;

use JaegerApp\Remote\Ftp;

/**
 * Jaeger - Ftp Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Ftp object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class FtpTest extends \PHPUnit_Framework_TestCase
{

    private function getFtpInstance()
    {
        $settings = $this->getFtpCreds();
        $ftp = new Ftp([
            'host' => $settings['ftp_hostname'],
            'username' => $settings['ftp_username'],
            'password' => $settings['ftp_password'],
            'port' => $settings['ftp_port'],
            'passive' => (isset($settings['ftp_passive']) ? $settings['ftp_passive'] : '0'),
            'ssl' => (! empty($settings['ftp_ssl']) ? $settings['ftp_ssl'] : '0'),
            'timeout' => (! empty($settings['ftp_timeout']) ? $settings['ftp_timeout'] : '30')
        ]);
        
        return $ftp;
    }

    public function testInstance()
    {
        $ftp = $this->getFtpInstance();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', $ftp);
    }

    public function testGetRemoteClient()
    {
        $settings = $this->getFtpCreds();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', Ftp::getRemoteClient($settings));
    }

    public function testConnect()
    {
        $ftp = $this->getFtpInstance();
        $ftp->connect();
        $this->assertInternalType('resource', $ftp->getConnection());
        $ftp->disconnect();
    }
    
    /**
     * The FTP Test Credentials
     *
     * @return array
     */
    protected function getFtpCreds()
    {
        return include 'data/ftpcreds.config.php';
    }    
}