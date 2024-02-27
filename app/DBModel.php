<?php
class DBModel {
    private $db;

    /**
     * Connect to the database and return db
     */
    public function __construct(PDO $db){
        $this->db = $db;    
    }
    public function getRows($table, $conditions = array()) {
        $sql = 'SELECT';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;

        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value) {
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }

        if(array_key_exists("order_by",$conditions)) {
            $sql .= ' ORDER BY '.$conditions['order_by'];
        }

        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)) {
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)) {
            $sql .= ' LIMIT '.$conditions['limit'];
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all') {
            switch($conditions['return_type']) {
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return !empty($data) ? $data : false;
    }
    public function insert($table, $data)
    {
        if (!empty($data) && is_array($data)) {
            $columnString = implode(',', array_keys($data));
            $valueString = ":" . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . $table . " (" . $columnString . ") VALUES (" . $valueString . ")";
            $query = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            try {
                $query->execute();
                $data['id'] = $this->db->lastInsertId();
                return $data;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }
    public function update($table,$data, $conditions) {}
    public function delete($table,$conditions) {}
}
?>
