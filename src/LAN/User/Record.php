<?php
namespace LAN\User;

class Record extends \Epoch\Record
{
    protected $id;           //INT(32)
    protected $mac;          //VARCHAR(32)
    protected $ip;           //VARCHAR(15)
    protected $name;         //VARCHAR(256)
    protected $date_created; //DATETIME
    protected $date_updated; //DATETIME
    protected $status;       //ENUM('ONLINE', 'OFFLINE')

    public static function getByID($id)
    {
        return self::getByAnyField('\UNL\VisitorChat\User\Record', 'id', (int)$id);
    }

    public static function getByMAC($mac)
    {
        return self::getByAnyField('\UNL\VisitorChat\User\Record', 'mac', $mac);
    }

    function keys()
    {
        return array('id');
    }

    public static function getTable()
    {
        return 'users';
    }

    public static function getUser(\Wrench\Connection $connection)
    {
        return self::createNewUser($connection);
    }

    public static function createNewUser(\Wrench\Connection $connection)
    {
        $record = new self();

        try {
            $record->setMAC(\LAN\Util::getMac($connection->getIp()));
            $record->setIP($connection->getIp());
            //TODO: $record->setDateCreated();
        } catch (\Exception $e) {

        }

        return $record;
    }

    function getID()
    {
        return $this->id;
    }

    function getMAC()
    {
        return $this->mac;
    }

    function getIP()
    {
        return $this->ip;
    }

    function getName()
    {
        return $this->name;
    }

    function getDateCreated()
    {
        return $this->date_created;
    }

    function getDateUpdated()
    {
        return $this->date_updated;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setMAC($mac)
    {
        $this->mac = $mac;
    }

    function setIP($ip)
    {
        $this->ip = $ip;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setDateCreated($date)
    {
        $this->date_created = $date;
    }

    function setDateUpdated($date)
    {
        $this->date_updated = $date;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }
}