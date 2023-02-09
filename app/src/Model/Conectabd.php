<?php

namespace Crimsoncircle\Model;

class Conectabd
{   
    private $host="db";
    private $user="root";
    private $pass="crimsoncircle";
    private $db="crimisoncircle";
    private $conect;
    
    public function conectabd()
    {
        $connectionString="mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";

        try{
            $this->conect = new \PDO($connectionString, $this->user, $this->pass);
            $this->conect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->conect;
        } catch (Exception $e) {
            $this->conect= 'Error de Conexión';
            echo "ERROR: ".$e->getMessage();
        }
    }
    
    public function getParams($input)
    {
        $filterParams = [];
        foreach($input as $param => $value)
        {
                $filterParams[] = "$param=:$param";
        }
        return implode(", ", $filterParams);
	}

  
	public function bindAllValues($statement, $params)
    {
        foreach($params as $param => $value)
            {
                $statement->bindValue(':'.$param, $value);
            }
        return $statement;
    }
}