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
            return $alumnos;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

    /**
     * Funcion para obtener un módulo en concreto
     * @param cod codigo del modulo a buscar.
     * @return modulo devuelve el modulo encontrado
     */
    public function getModulo($cod)
    {

        $sql = "SELECT * FROM modulos where cod_mod = $cod";
        $resultado = $this->ejecutaConsulta($sql);
        $modulo = $resultado->fetch(PDO::FETCH_ASSOC);
        if ($cod = $modulo['cod_mod']) {
            return $modulo;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }
    }

    /**
     * Metodo para obtener una lista de TODOS los modulos
     * @return modulos devuelve los modulos en forma de lista
     */
    public function getModuloAll()
    {

        $sql = "SELECT * FROM modulos ;";
        $resultado = $this->ejecutaConsulta($sql);
        $modulos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if (isset($modulos)) {
            return $modulos;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

    /**
     * Funcion para obtener una lista las asistencias y faltas del modulo
     * @param codal parametro para pasar el numero de expdiente del alumno
     * @param codmod parametro para pasar el numero del codigo del modulo
     * @return asistencias devuelve las asistencias en forma de lista
     */
    public function getAsistenciasMod($codal, $codmod)
    {

        $sql = "SELECT * FROM asistencias WHERE nexped = $codal and cod_mod = $codmod;";
        $resultado = $this->ejecutaConsulta($sql);
        $asistencias = $resultado->fetch(PDO::FETCH_ASSOC);
        if (isset($asistencias)) {
            return $asistencias;
        } else {
            echo '<p><center>No se han encontrado resultados</center></p>';
        }

    }

    /**
     * Funcion para eliminar un profesor
     * @param cod codigo que se pasa por parametro para identificar el profesor a eliminar
     * @return profesor devuelve la sentencia de eliminacion del profesor
     */

    public function delProfesor($cod)
    {
        $sql = "DELETE FROM profesores WHERE cod_prof = $cod;";
        $resultado = $this->ejecutaConsulta($sql);
        $profesor = $resultado->execute();
        if (isset($profesor)) {
            echo '<p><center>Profesor borrado correctamente</center></p>';
            return $profesor;
        } else {
            echo '<p><center>No existe ningun profesor con dicho codigo</center></p>';
        }
    }

    /**
     * Funcion para eliminar un alumno
     * @param cod codigo que se pasa por parametro para identificar el alumno eliminar
     * @return alumno devuelve la sentencia de eliminacion del alumno
     */

    public function delAlumno($cod)
    {
        $sql = "DELETE FROM alumnos WHERE nexped = $cod;";
        $resultado = $this->ejecutaConsulta($sql);
        $alumno = $resultado->execute();
        if (isset($alumno)) {
            echo '<p><center>Alumno borrado correctamente</center></p>';
            return $alumno;
        } else {
            echo '<p><center>No existe ningun alumno con dicho codigo</center></p>';
        }
    }

    /**
     * Funcion para editar los datos de un profesor mediante su codigo
     * @param cod codigo que se pasa por parametro para identificar el profesor que vamos actualizar
     */
    public function editProfesor($cod)
    {

        $sql = "UPDATE profesores set nombre= ?, apellidos= ?, activo= ? where cod_prof = $cod ";
        $resultado = $this->ejecutaConsulta($sql);
        $prof = $resultado->execute();
        if (isset($prof)) {
            echo '<p><center>Actualizacion completada</center></p>';
        } else {
            echo '<p><center>Ha ocurrido un problema</center></p>';
        }

    }

    /**
     * Funcion para editar los datos de un alumno
     * @param cod codigo que se pasa por parametro para identificar el profesor que vamos actualizar
     */
    public function editAlumno($cod)
    {
        $sql = "UPDATE alumnos set nombre= ?, apellidos= ?, activo= ? where nexped = $cod ";
        $resultado = $this->ejecutaConsulta($sql);
        $alum = $resultado->execute();
        if (isset($alum)) {
            echo '<p><center>Actualizacion completada</center></p>';
        } else {
            echo '<p><center>Ha ocurrido un problema</center></p>';
        }

    }



    /**
     * Funcion para insertar un nuevo profesor
     * @param cod insertamos el codigo del profesor por parametro
     * @param nom insertamos el nombre del profesor por parametro
     * @param ape insertamos el apellido del profesor por parametro
     * @param act insertamoos por parametro el nº que indica si esta activo o no
     */

     public function setProfesor($cod, $nom, $ape, $act){

        $sql = "INSERT INTO profesores ('cod_prof', 'nombre', 'apellidos', 'activo') values $cod, $nom, $ape, $act;";
        $resultado = $this->ejecutaConsulta($sql);
        $insertar = $resultado->execute();
        if (isset($insertar)) {
            echo '<p><center>Inserccion completada</center></p>';
        } else{
            echo '<p><center>ERROR!!! No se puede insertar ningun dato</center></p>';
        }

     }


}
