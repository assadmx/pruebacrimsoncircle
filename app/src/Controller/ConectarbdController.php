<?php
namespace Crimsoncircle\Controller;

use Crimsoncircle\Model\Conectabd;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConectarbdController
{
    public function index(){
    $conn = new Conectabd();
    $dbConn=$conn->conectabd();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (isset($_GET['id_post']))            {
            //Mostrar un post
            $sql = $dbConn->prepare("SELECT * FROM post where id_post=:id_post");
            $sql->bindValue(':id_post', $_GET['id_post']);
            $sql->execute();
            header("HTTP/1.1 200 OK");
            echo json_encode ($sql->fetch(\PDO::FETCH_ASSOC));
            exit();
        }else {
            $sql = $dbConn->prepare("SELECT * FROM post");
            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode( $sql->fetchAll()  );
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $input = $_POST;
        $sql = "INSERT INTO post
            (id_post, title, content, author, slug)
            VALUES
            (:id_post, :title, :content, :author, :slug)";
        $statement = $dbConn->prepare($sql);
        $conn->bindAllValues($statement, $input);
        $statement->execute();
        $postId = $dbConn->lastInsertId();
        if($postId)
        {
        $input['id_post'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        $id = $_GET['id_post'];
        $statement = $dbConn->prepare("DELETE FROM post where id_post=:id_post");
        $statement->bindValue(':id_post', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        $input = $_GET;
        $postId = $input['id_post'];
        $fields = $conn->getParams($input);
        $sql = "UPDATE post SET $fields WHERE id_post='$postId'";
        $statement = $dbConn->prepare($sql);
        $conn->bindAllValues($statement, $input);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    }
    
    header("HTTP/1.1 400 Bad Request");
    }

}

