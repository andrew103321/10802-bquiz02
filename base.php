<?php
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db02_1";
    $pdo = new PDO($dsn,"root",""); /**/ 
    session_start();


    function find($table,...$arg){
        global $pdo ;

        $sql = "select * from  $table where ";
        
        if(is_array($arg[0])){ 
            foreach ($arg[0] as $key => $value ){
                $tmp[] = sprintf("`%s`='%s'",$key,$value);  /**/ 
            }
            $sql = $sql. implode(" && ",$tmp);
        }else{
            $sql = $sql ."id='".$arg[0]."'";  /***/
        }
        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function all($table,...$arg){
        global $pdo;
        $sql = "select * from $table ";
        if(!empty($arg[0])){
            foreach ($arg[0] as $key => $value){
                $tmp[] = sprintf("`%s`='%s'",$key,$value);
            }
            $sql = $sql ."where".implode(" && " ,$tmp);

        }
        if(!empty($arg[1])){
            $sql = $sql . $arg[1];
        }
        return $pdo->query($sql)->fetchAll();
    }

    function nums($table,...$arg){
        global $pdo;
        $sql = "select count(*) from $table ";
        if(!empty($arg[0])){
            foreach ($arg[0] as $key => $value){
                $tmp[] = sprintf("`%s`='%s'",$key,$value);
            }
            $sql = $sql ."where".implode(" && ",$tmp);
        }
        if(!empty($arg[1])){
            $sql = $sql . $arg[1];
        }
        return $pdo->query($sql)->fetchColumn();  
    }

    function del($table,...$arg){
        global $pdo;
        $sql = "delete from $table where ";

       if(is_array($arg[0])){ 
            foreach ($arg[0] as $key => $value ){
                $tmp[] = sprintf("`%s`='%s'",$key,$value);  
            }
            $sql = $sql. implode(" && ",$tmp);
        }else{
            $sql = $sql ."id='".$arg[0]."'";  
        }
        return $pdo->exec($sql);
    }

    function save($table,$data){
        global $pdo;
      
        if(!empty($data['id'])){
          //update
          foreach($data as $key => $value){
            if($key!="id"){
              $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
          }
          $sql="update $table set ".implode(",",$tmp)." where `id`='".$data['id']."'";
        }else{
            //in
            $key =  array_keys($data) ;
            $keys_str = "`" .implode("`,`",$key)."`";
            $value_str = "'" .implode("','",$data)."'";
           $sql = "insert into $table ($keys_str) values($value_str)";
         
        }
        return $pdo->exec($sql);
    }


    function q($sql){
        global $pdo;
        return $pdo->query($sql)->fetchAll();  /**/ 
    }

    function to($path){
        header("location:".$path);
    }

?>