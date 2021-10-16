<?php
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();    
    public function __construct()
    {        
        session_start();
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }        
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    private function dologinWithPostData()
    {        
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Campo de usuario esta vacío.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Campo de contraseña esta vacío.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {            
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            if (!$this->db_connection->connect_errno) {
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);
                $user_pass = $this->db_connection->real_escape_string($_POST['user_name']);
                $sql = "SELECT u.id_usuario, u.u_tipo, u.usuario, u.contra
                        FROM usuario u, tipo_usuario t
                        WHERE u.u_tipo=t.id_tipo_usuario AND u.u_usuario = '" . $user_name . "'AND u.contra = '" . $user_pass . "';";
                $result_of_login_check = $this->db_connection->query($sql);                
                if ($result_of_login_check->num_rows == 1) {
                    $result_row = $result_of_login_check->fetch_object();                    
                        $_SESSION['id_usuario'] = $result_row->user_id;
                        $_SESSION['u_usuario'] = $result_row->user_name;
                        $_SESSION['u_tipo']="";
                        $user_tipo = $result_row->tipo_usuario;
                        if ($user_tipo == 1) {
                            $_SESSION['user_tipo'] = 1;
                        }elseif ($user_tipo == 2) {
                            $_SESSION['user_tipo'] = 2;
                        }elseif ($user_tipo == 3) {
                            $_SESSION['user_tipo'] = 3;
                        }                        
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    }
                } else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }    

    public function doLogout()
    {     
        $_SESSION = array();
        session_destroy();     
        $this->messages[] = "Has sido desconectado.";
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1 AND $_SESSION['user_tipo'] = 1) {
            $user_perfil = 1;
            $true = 1;
            return array($true, $user_perfil);            

        } elseif (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1 AND $_SESSION['user_tipo'] = 2) {
            $user_perfil = 2;
            $true = 1;
            return array($true, $user_perfil);            
        } elseif (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1 AND $_SESSION['user_tipo'] = 3) {
            $user_perfil = 3;
            $true = 1;
            return array($true, $user_perfil);            
        } else{          
            return false;
        }
    }
}
