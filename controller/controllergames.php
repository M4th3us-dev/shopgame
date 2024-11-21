<?php

require_once '../model/Game.php';
require_once '../config/db.php';

class ControllerGames
{
    private $Game;

    private static $INSTANCE;

    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new ControllerGames();
        }
        return self::$INSTANCE;
    }

    public function __construct()
    {
        $this->Game = new Game(Database::getInstance());
    }

    public function list()
    {
        $games = $this->Game->list();
        echo json_encode($games);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome) && isset($data->descricao) && isset($data->id_jogo) && isset($data->ano)) {
            try {
                $this->Game->create($data->nome, $data->descricao, $data->id_jogo, $data->ano);
                http_response_code(201);
                echo json_encode(["message" => "Game cadastrado com sucesso"]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao cadastrar o game", "error" => $th->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados fornecidos incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $game = $this->Game->getById($id);
                if ($game) {
                    echo json_encode($game);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Cadastro não encontrado"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar cadastro", "error" => $th->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados fornecidos incompletos."]);
        }
    }

    public function update()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id) && isset($data->nome) && isset($data->descricao) && isset($data->id_jogo) && isset($data->ano)) {
            try {
                $count = $this->Game->update($data->id, $data->nome, $data->descricao, $data->id_jogo, $data->ano);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Cadastro atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o game"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar cadastro", "error" => $th->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados fornecidos incompletos."]);
        }
    }

    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id)) {
            try {
                $count = $this->Game->delete($data->id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Cadastro deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar cadastro"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar cadastro", "error" => $th->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
