<?php
date_default_timezone_set("Asia/Taipei");
session_start();
$ss=[1=>'14:00~16:00', //$ss是亂取的，隨便你想取什麼就取什麼
     2=>'16:00~18:00',
     3=>'18:00~20:00',
     4=>'20:00~22:00',
     5=>'22:00~24:00',
];
//$ls=[1=>'普遍級',2=>"保護級",3=>"輔導級",4=>"限制級"];
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=s1100411";
    protected $user="root";
    protected $pw='';
    protected $pdo;
    protected $table;
    //物件裡面的東西是自己一類，它不會跟外部的有衝突，所以這邊取level也不會跟外部的衝突到
    //之後寫一個function,如果你對我做一個level的查詢，我就回給你一個相對應的文字
    protected $level=[1=>'普遍級',2=>"保護級",3=>"輔導級",4=>"限制級"];

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }

    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function all(...$arg){
        $sql="SELECT * FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ",$tmp)." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){

                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ",$tmp);
                }else{
                    $sql .= $arg[0];

                }
            break;
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col) FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ",$tmp)." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ",$tmp);
                }else{
                    $sql .= $arg[0];

                }
            break;
        }


        return $this->pdo->query($sql)->fetchColumn();
    }
    public function save($array){
        if(isset($array['id'])){
            //update
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql="UPDATE $this->table 
                     SET ".implode(",",$tmp)."
                   WHERE `id`='{$array['id']}'";
        }else{
            //insert

            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`) 
                                     VALUES('".implode("','",$array)."')";
        }

       // echo $sql;
        return $this->pdo->exec($sql);
    }

    public function del($id){
        $sql="DELETE FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->exec($sql);
    }
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

   //回傳分級文字
   //我有一個public function就叫做level
   //屬性level跟我的function可以同名沒關係 因為他們的用法不一樣
   //裡面會傳進level這個東西數值
   //這個數值會return我這個物件裡面的level這個東西,它是一個陣列
   //我會把$level帶進來,然後把文字迴傳出去
   //這樣我就不會有全域變數的問題了
   //而且這個所有的資料庫都可以用
   //這種物件導向方法在維護跟擴充上來說比較彈性
   //p.s.這個做法在框架裡面會變得更變態，它會變得連屬性都可以使用..?
   public function level($level){
    return $this->level[$level];
}

}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

$Movie=new DB('level3_movie');
$Ord=new DB('level3_ord');
$Poster=new DB('level3_poster');

?>