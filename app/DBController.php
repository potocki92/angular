<?php
    require_once 'DBModel.php';

    class DBController {
        private $dbModel;
        private $tableName;
        public function __construct(DBModel $dBModel, string $tableName) {
            $this->dbModel = $dBModel;
            $this->tableName = $tableName;
        }

        public function getTodos() {
            $todos = $this->dbModel->getRows($this->tableName);
            if($todos) {
                $data['records'] = $this->dbModel->getRows($this->tableName);
                $data['status'] = 'OK';
            } else {
                $data['records'] = array();
                $data['status'] = 'ERR';
            }
            echo json_encode($data);
            exit();
        }

        public function addTodo() {
            if(!empty($_POST['data'])) {
                $todoData = array(
                    'text' => $_POST['data']['text'],
                    'is_done' => $_POST['data']['is_done']
                );
                $insert = $this->dbModel->insert($this->tableName, $todoData);
                if($insert) {

                }
            }
        }

        public function editTodo() {
            $todoData = array(
                'text' => $_POST['data']['text'],
                'is_done' => $_POST['data']['is_done']
            );
            $conditions = array('id' => $_POST['data']['id']);
            $update = $this->dbModel->update($this->tableName, $todoData, $conditions);
            echo "EDIT TODO SERVER";
        }

        public function updateTodo() {
            echo "UPDATe TODO SERVER";
        }

        public function deleteTodo() {
            echo "DELETe TODO SERVER";
        }
    }
?>