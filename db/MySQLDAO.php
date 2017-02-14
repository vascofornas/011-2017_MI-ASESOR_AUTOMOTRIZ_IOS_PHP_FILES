<?php
 
class MySQLDAO
{
  
    var $dbhost = null;
    var $dbuser = null;
    var $dbpass = null;
    var $conn = null;
    var $dbname = null;
    var $result = null;

    function __construct($dbhost, $dbuser, $dbpassword, $dbname) {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpassword;
        $this->dbname = $dbname;
    }  
    
    
    public function openConnection() { 
        $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if (mysqli_connect_errno())
            throw new Exception("Could not establish connection with database");
        $this->conn->set_charset("utf8");
    }
    
    public function closeConnection() {
        if ($this->conn != null)
            $this->conn->close();
    }
      public function getNombreAgencia($nombreAgencia)
    {
        $returnValue = array();
        $sql = "select * from tb_agencias where codigo_agencia='" . $nombreAgencia . "'";
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row;
            }
        }
        return $returnValue;
    }  
    


    public function sendEmail($nombre_usuario,$email_usuario,$tel_usuario,$modelo,$ano,$fecha,$hora,$km,$tipo,$taller,$comentarios,$emailAsesor,$agencia)
    {

        //insertar cita en base de datos
        //enviar email con la cita al taller
        //enviar email con la cita al Asesor    public function getNombreAgencia($nombreAgencia)
    {
        $returnValue = array();

$codigo = "123";




        $sql = " INSERT INTO tb_citas_servicio (nombre_cliente, email_cliente, cel_cliente,
        modelo, ano, kilometros, tipo,
        fecha, hora, comentarios, codigo, agencia_cita)
VALUES ('$nombre_usuario', '$email_usuario ','$tel_usuario',' $modelo','$ano','$kilometros', '$tipo',
'$fecha', 
'$hora ', 
'$comentarios', 
' $codigo ', '
'$agencia ')";
       
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row;
            }
        }
        return $returnValue;
    }  
    


        $returnValue = array();
        $sql = "select * from tb_agencias where codigo_agencia='" . $nombreAgencia . "'";
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row;
            }
        }
        return $returnValue;
    }  
    


      public function getUserDetails($email)
    {
        $returnValue = array();
        $sql = "select * from users where email='" . $email . "'";
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row;
            }
        }
        return $returnValue;
    }   
    
     public function registerUser($email, $first_name, $last_name, $password, $salt)
    { 
        $sql = "insert into users set email=?, first_name=?, last_name=?, user_password=?, salt=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("sssss", $email, $first_name, $last_name, $password, $salt);
        $returnValue = $statement->execute();

        return $returnValue;  
    }   
    
    
     public function storeEmailToken($user_id, $email_token)
    { 
        $sql = "insert into email_tokens set user_id=?, email_token=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("is", $user_id, $email_token);
        $returnValue = $statement->execute();

        return $returnValue;  
    } 
    
    
    function getUserIdWithToken($emailToken)
    {
        $returnValue = array();
        $sql = "select user_id from email_tokens where email_token='" . $emailToken . "'";
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row['user_id'];
            }
        }
        return $returnValue;  
        
    }
    
    function setEmailConfirmedStatus($status, $user_id)
    {
        $sql = "update users set isEmailConfirmed=? where user_id=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("ii", $status, $user_id);
        $returnValue = $statement->execute();  
        
        return $returnValue;
        
    }
    
    
    function deleteUsedToken($emailToken)
    {
        $sql = "delete from email_tokens where email_token=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("s", $emailToken);
        $returnValue = $statement->execute();  
        
        return $returnValue;
    }
    
    
    public function storePasswordToken($user_id, $token)
    {
        $sql = "insert into password_tokens set user_id=?, password_token=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("is", $user_id, $token);
        $returnValue = $statement->execute();
        
        return $returnValue;
        
    }  
 
    
    function getUserIdWithPasswordToken($token)
    {
        $returnValue = null;
        $sql = "select user_id from password_tokens where password_token='" . $token . "'";
  
        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $returnValue = $row['user_id'];
            }
        }
        return $returnValue;  
    }
    
    function updateUserPassword($user_id,$secured_password,$salt)
    {
        $sql = "update users set user_password=?, salt=? where user_id=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("ssi", $secured_password, $salt, $user_id);
        $returnValue = $statement->execute();
        
        return $returnValue;    
    }
    
    function deleteUsedPasswordToken($token)
    {
        $sql = "delete from password_tokens where password_token=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("s", $token);
        $returnValue = $statement->execute();
        
        return $returnValue;  
    }
    
     public function buscarModelos($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from tb_modelos  where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( agencia_modelo = ?  )";
              $sql .= " ORDER BY nombre_modelo";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        if(!empty($searchWord))
        {
           
        
          $statement->bind_param("s",  $searchWord );
        }
       
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    } 
          public function buscarTipos($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from tb_otros  where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( agencia_otros = ?  )";
              $sql .= " ORDER BY orden_tipo";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        if(!empty($searchWord))
        {
           
        
          $statement->bind_param("s",  $searchWord );
        }
       
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    }

    public function buscarTramites($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from tb_tramites  where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( agencia_tramite = ?  )";
              $sql .= " ORDER BY orden_tramite";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        if(!empty($searchWord))
        {
           
        
          $statement->bind_param("s",  $searchWord );
        }
       
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    }
     public function buscarAnos($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from tb_anos  where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( agencia_ano = ?  )";
              $sql .= " ORDER BY ano DESC";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        if(!empty($searchWord))
        {
           
        
          $statement->bind_param("s",  $searchWord );
        }
       
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    } 
     public function buscarKms($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from tb_km  where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( agencia_km = ?  )";
              $sql .= " ORDER BY km";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        if(!empty($searchWord))
        {
           
        
          $statement->bind_param("s",  $searchWord );
        }
       
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    } 
    public function buscarAsesores($searchWord)
    {
        $returnValue = array();
        
        $sql = "select * from members LEFT JOIN tb_agencias ON members.agencia_usuario = tb_agencias.id_agencia where 1";
       
        if(!empty($searchWord))
        {
            $sql .= " and ( codigo_agencia = ?)";
              $sql .= " ORDER BY nombre";

        }
  
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

       if(!empty($searchWord)) {

  $statement->bind_param("s",  $searchWord );
}
        
        $statement->execute();
       
        $result = $statement->get_result();
        
         while ($myrow = $result->fetch_assoc()) 
         {
           $returnValue[] = $myrow;
         }
         
        return $returnValue;
    } 
    
    function deleteFriendRecord($friend_token) 
    {
        $sql = "delete from friends where token=?";
        $statement = $this->conn->prepare($sql);

        if (!$statement)
            throw new Exception($statement->error);

        $statement->bind_param("s", $friend_token);
        $statement->execute();
        
        $returnValue = $statement->affected_rows;
        
        return $returnValue;  
    }
    
}

?>
