<?php

namespace App\Model;

use App\Configuration\Connection;
use Exception;
use PDO;

class Exam
{
    final public static function insert($request)
    {
        try {
            self::ruleInsert($request);

            $connection = Connection::Connectdb();

            $sql = $connection->prepare(self::queryInsert());
            $sql->bindValue(':id_estudo', $request['idestudo']);
            $sql->bindValue(':nome_paciente', $request['nomepaciente']);
            $sql->bindValue(':id_paciente', $request['idpaciente']);
            $sql->bindValue(':modalidade', $request['modalidade']);
            $sql->bindValue(':data_estudo', $request['dataestudo']);
            $sql->bindValue(':data_registro', $request['dataregistro']);

            $response = $sql->execute();

            if ($response == 0) {
                echo '<script>alert("Falha ao inserir");</script>';
                echo '<script>location.href="http://localhost:85/?page=register"</script>';
            }

            return true;
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85/?page=register"</script>';
        }
    }

    final public static function selectAll()
    {
        try {
            $connection = Connection::Connectdb();

            $sql = self::querySelectAll();
            $sql = $connection->prepare($sql);
            $sql->execute();

            $response = array();

            while ($row = $sql->fetchObject()) {
                $response[] = $row;
            }

            if (!$response) {
                return;
            }

            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    final public static function selectId($id)
    {
        try {
            $connection = Connection::Connectdb();

            $sql = self::querySelectId();
            $sql = $connection->prepare($sql);
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $response = $sql->fetchObject();

            if (!$response) {
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }

            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    final public static function update($request)
    {
        try {
            $connection = Connection::Connectdb();

            $sql = self::queryUpdate();
            $sql = $connection->prepare($sql);
            $sql->bindValue(':id_estudo', $request['idestudo']);
            $sql->bindValue(':nome_paciente', $request['nomepaciente']);
            $sql->bindValue(':id_paciente', $request['idpaciente']);
            $sql->bindValue(':modalidade', $request['modalidade']);
            $sql->bindValue(':data_estudo', $request['dataestudo']);
            $sql->bindValue(':data_registro', $request['dataregistro']);
            $sql->bindValue(':id', $request['id']);
            $response = $sql->execute();

            if ($response == 0) {
                throw new Exception("Falha ao alterar exame");
                return false;
            }

            return true;
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85"</script>';
        }
    }

    final public static function delete($id)
    {
        try {
            $connection = Connection::Connectdb();

            $sql = self::queryDelete();
            $sql = $connection->prepare($sql);
            $sql->bindValue(':id', $id);
            $response = $sql->execute();

            if ($response == 0) {
                throw new Exception("Falha ao deletar exame");
                return false;
            }

            return true;
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85"</script>';
        }
    }

    final public static function filter($request)
    {
        try {
            $connection = Connection::Connectdb();

            $sql = self::queryFilter($request);
            $sql = $connection->prepare($sql);

            if (!empty($request['dateregistroinit']) && !empty($request['dateregistrofinish'])) {
                $sql->bindValue(':datainit', $request['dateregistroinit']);
                $sql->bindValue(':dataend', $request['dateregistrofinish']);
            }

            if (!empty($request['modalidade'])) {
                $sql->bindValue(':modalidade', $request['modalidade']);
            }

            if (!empty($request['search'])) {
                $sql->bindValue(':nome', "%" . $request['search'] . "%");
            }

            $sql->execute();

            $response = $sql->fetchAll(PDO::FETCH_OBJ);

            if (!$response) {
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }

            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    private static function ruleInsert($request)
    {
        if (
            empty($request['idestudo']) || empty($request['nomepaciente']) ||
            empty($request['idpaciente']) || empty($request['modalidade']) ||
            empty($request['dataestudo']) || empty($request['dataregistro'])
        ) {
            echo '<script>alert("Falta informações a serem preenchidas");</script>';
            echo '<script>location.href="http://localhost:85/?page=register"</script>';
        }

        return;
    }

    private static function queryInsert()
    {
        return 'INSERT INTO 
        exames (id_estudo,nome_paciente,id_paciente,modalidade,data_estudo,data_registro)
        VALUES (:id_estudo,:nome_paciente,:id_paciente,:modalidade,:data_estudo,:data_registro)
        ';
    }

    private static function querySelectAll()
    {
        return "SELECT * FROM exames ORDER BY id DESC";
    }

    private static function querySelectId()
    {
        return "SELECT * FROM exames WHERE id = :id";
    }

    private static function queryUpdate()
    {
        return "UPDATE exames SET 
            id_estudo = :id_estudo, nome_paciente = :nome_paciente,
            id_paciente = :id_paciente, modalidade = :modalidade,
            data_estudo = :data_estudo, data_registro = :data_registro 
            WHERE id = :id";
    }

    private static function queryDelete()
    {
        return "DELETE FROM exames WHERE id = :id";
    }

    private static function queryFilter($request)
    {
        try {
            $sql = "SELECT * FROM exames WHERE 1=1";

            if (!empty($request['dateregistroinit']) && !empty($request['dateregistrofinish'])) {
                $sql .= " AND data_registro BETWEEN :datainit AND :dataend";
            }

            if (!empty($request['modalidade'])) {
                $sql .= " AND modalidade = :modalidade";
            }

            if (!empty($request['search'])) {
                $sql .= ' AND nome_paciente LIKE :nome';
            }

            $sql .= " ORDER BY id DESC";

            return $sql;
           
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
