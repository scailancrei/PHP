<?php
class gestalum//CLASE GETSALUM

{
    public function __construct() //Constructor

    {

        $config = parse_ini_file('./assets/config.ini');
        try {
            $pdo = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = 'mysql:host=' . $config['server'] . ';dbname=' . $config['base'];
            $this->conexion = new PDO($dsn, $config['usu'], $config['pas'], $pdo);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw $e;

        }
    }

    /**
     * Metodo para ejecutar una consulta
     * @param sql se pasa como parametro la sentencia sql para usar mas adelante
     * @return datos devuelve los datos
     *
     */
    private function ejecutaConsulta($sql)
    {
        try
        {
            $resultado = null;
            if (isset($this->conexion)) {
                $resultado = $this->conexion->query($sql);
                return $resultado;
            }

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Este metodo lo usaremos para comprobar el usuario en el login
     * @param usuario se le pasa como parametro el nombre de usuario
     * @param clave se le pasa la clave que comprobará si el usuario es el correcto para dar login
     *
     */
    public function getUser($usuario, $clave)
    {

        $sql = "SELECT * FROM usuarios";
        $resultado = $this->ejecutaConsulta($sql);
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        if ($usuario == $datos['usuario'] && $clave == $datos['clave']) {

            echo '<script type="text/javascript">
        alert("Bienvenido señor admin");
        window.location.href="index.php";
        </script>';
        } else {
            echo '<script type="text/javascript">
        alert("Usted no es el admin de esta web");
        window.location.href="index.php";
        </script>';
        }

    }

    /**
     * Funcion para listar un profesor en concreto dependiendo del @param cod
     * @param cod parámetro que pasa el codigo del profesor del cual realizar la búsqueda
     * @return profesor devuelve el profesor
     */
    public function getProfesor($cod)
    {

        $sql = "SELECT * FROM profesores where cod_prof = $cod";
        $resultado = $this->ejecutaConsulta($sql);
        $profesor = $resultado->fetch(PDO::FETCH_ASSOC);
        if ($cod = $profesor['cod_prof']) {
            return $profesor;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

    /**
     * Metodo para obtener una lista de TODOS los profesores
     * @return profesores devuelve cada uno de los profesores
     */
    public function getProfesorAll()
    {

        $sql = "SELECT * FROM profesores ;";
        $resultado = $this->ejecutaConsulta($sql);
        $profesor = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if (isset($profesor)) {
            return $profesor;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

    /**
     * Funcion para listar un alumno en concreto dependiendo del @param cod
     * @param cod parámetro que pasa el codigo del alumno del cual realizar la busqueda
     * @return alumno devuelve el alumno
     */
    public function getAlumno($cod)
    {

        $sql = "SELECT * FROM alumnos where nexped = $cod";
        $resultado = $this->ejecutaConsulta($sql);
        $alumno = $resultado->fetch(PDO::FETCH_ASSOC);
        if ($cod = $alumno['nexped']) {
            return $alumno;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }
    }



    /**
     * Metodo para obtener una lista de TODOS los alumnos
     * @return alumnos devuelve cada uno de los alumnos
     */
    public function getAlumnoAll()
    {

        $sql = "SELECT * FROM alumnos ;";
        $resultado = $this->ejecutaConsulta($sql);
        $alumnos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if (isset($alumnos)) {
            return $profesor;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

}
