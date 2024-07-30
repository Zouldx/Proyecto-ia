<?php

session_start(); 

require_once './conex.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new Auth();
    $result = $auth->authenticate($username, $password);

    if ($result === true) {
        // Autenticación exitosa
        $response = array(
            'status' => 'success',
            'user_id' => $_SESSION['user_id'],
            'role_id' => $_SESSION['role_id'],
            'nombre' => $_SESSION['nombre'],
            'email' => $_SESSION['email']
        );

        echo json_encode($response);
    } elseif ($result === 'inactive') {
        // Usuario inactivo
        $response = array(
            'status' => 'error',
            'message' => 'El usuario está inactivo'
        );
        echo json_encode($response);
    } elseif ($result === 'invalid') {
        // Credenciales inválidas
        $response = array(
            'status' => 'error',
            'message' => 'Verifique la información ingresada'
        );
        echo json_encode($response);
    }
}


class Auth
{
    private $db;

    public function __construct()
    {
        $dbConfig = new DBConfig();
        $this->db = $dbConfig->getConnection();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function authenticate($username, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $hashedPassword = $row['password']; // Obtén la contraseña hasheada almacenada en la base de datos

            if (password_verify($password, $hashedPassword)) {
                // La contraseña proporcionada coincide con la contraseña almacenada

                if ($row['status'] === 'Activo') {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $row['id_users'];
                    $_SESSION['role_id'] = $row['fk_role_id'];
                    $_SESSION['nombre'] = $row['username'];
                    $_SESSION['email'] = $row['email'];                
                    return true; // Autenticación exitosa
                } else {
                    return 'inactive'; // Usuario inactivo
                }
            } else {
                return 'invalid'; // Credenciales inválidas
            }
        } else {
            return 'invalid'; // Usuario no encontrado
        }
    }
}


?>