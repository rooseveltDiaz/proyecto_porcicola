<?php

use mvc\model\table\tableBaseClass;
/**
 * Description of gestacionBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class gestacionBaseTableClass extends tableBaseClass {

    private $id,
            $fecha,
            $empleado,
            $animal,
            $fecha_monta,
            $fecha_probable_parto,
            $animal_fecundador;

    const ID = 'id';
    const FECHA = 'fecha';
    const EMPLEADO = 'empleado';
    const ANIMAL = 'animal';
    const FECHA_MONTA = 'fecha_monta';
    const FECHA_PROBABLE_PARTO = 'fecha_probable_parto';
    const ANIMAL_FECUNDADOR = 'animal_fecundador';

    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEmpleado() {
        return $this->empleado;
    }

    function getAnimal() {
        return $this->animal;
    }

    function getFecha_monta() {
        return $this->fecha_monta;
    }

    function getFecha_probable_parto() {
        return $this->fecha_probable_parto;
    }

    function getAnimal_fecundador() {
        return $this->animal_fecundador;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }

    function setAnimal($animal) {
        $this->animal = $animal;
    }

    function setFecha_monta($fecha_monta) {
        $this->fecha_monta = $fecha_monta;
    }

    function setFecha_probable_parto($fecha_probable_parto) {
        $this->fecha_probable_parto = $fecha_probable_parto;
    }

    function setAnimal_fecundador($animal_fecundador) {
        $this->animal_fecundador = $animal_fecundador;
    }

    /**
     * Método para obtener el nombre del campo más la tabla ya sea en formato
     * DB (.) o en formato HTML (_)
     *
     * @param string $field Nombre del campo
     * @param string $html [optional] Por defecto traerá el nombre del campo en
     * versión DB
     * @return string
     */
    public static function getNameField($field, $html = false, $table = null) {
        return parent::getNameField($field, self::getNameTable(), $html);
    }

    /**
     * Obtener los nombres de las tablas
     * @return string
     */
    public static function getNameTable() {
        return 'gestacion';
    }

    public static function getNameTable2() {
        return 'animal';
    }

    public static function getNameTable3() {
        return 'empleado';
    }

    public static function getNameTable4() {
        return null;
    }

    /**
     * Método para borrar un registro de una tabla X en la base de datos
     *
     * @param array $ids Array con los campos por posiciones
     * asociativas y los valores por valores a tener en cuenta para el borrado.
     * Ejemplo $fieldsAndValues['id'] = 1
     * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
     * borrado físico de un registro en una tabla de la base de datos
     * @return PDOException|boolean
     */
    public static function delete($ids, $deletedLogical = true, $table = null) {
        return parent::delete($ids, $deletedLogical, self::getNameTable());
    }

    /**
     * Método para insertar en una tabla usuario
     *
     * @param array $data Array asociativo donde las claves son los nombres de
     * los campos y su valor sería el valor a insertar. Ejemplo:
     * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
     * @return PDOException|boolean
     */
    public static function insert($data, $table = null) {
        return parent::insert(self::getNameTable(), $data);
    }

    /**
     * Método para leer todos los registros de una tabla
     *
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param array $orderBy [optional] Array con el o los nombres de los campos
     * por los cuales se ordenará la consulta
     * @param string $order [optional] Forma de ordenar la consulta
     * (por defecto NULL), pude ser ASC o DESC
     * @param integer $limit [optional] Cantidad de resultados a mostrar
     * @param integer $offset [optional] Página solicitadad sobre la cantidad
     * de datos a mostrar
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica los nombres de las columnas de la consulta o una
     * instancia de \PDOException en caso de fracaso.
     */
    public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
        return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }

    /**
     * Método para actualizar un registro en una tabla de una base de datos
     *
     * @param array $ids Array asociativo con las posiciones por nombres de los
     * campos y los valores son quienes serían las llaves a buscar.
     * @param array $data Array asociativo con los datos a modificar,
     * las posiciones por nombres de las columnas con los valores por los nuevos
     * datos a escribir
     * @return PDOException|boolean
     */
    public static function update($ids, $data, $table = null) {
        return parent::update($ids, $data, self::getNameTable());
    }

    /**
     * Método para contar todos los registros de una tabla
     *
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param integer $lines variable con la cantidad de de campos que devuelve
     * el sistema
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica cantidad de paginas para visualizar en el paginador.
     * instancia de \PDOException en caso de fracaso.
     */
    public static function getAllCount($fields, $deletedLogical = true, $lines = null, $where = null, $table = null) {
        return parent::getAllCount(self::getNameTable(), $fields, $deletedLogical, $lines, $where);
    }

    /**
     * Método para leer todos los registros de una tabla
     *
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param array $orderBy [optional] Array con el o los nombres de los campos
     * por los cuales se ordenará la consulta
     * @param string $order [optional] Forma de ordenar la consulta
     * (por defecto NULL), pude ser ASC o DESC
     * @param integer $limit [optional] Cantidad de resultados a mostrar
     * @param integer $offset [optional] Página solicitadad sobre la cantidad
     * de datos a mostrar
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica los nombres de las columnas de la consulta o una
     * instancia de \PDOException en caso de fracaso.
     */
    public static function getAllJoin($fields, $fields2, $fields3 = null, $fields4 = null, $fJoin1 = null, $fJoin2 = null, $fJoin3 = null, $fJoin4 = null, $fJoin5 = null, $fJoin6 = null, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null, $table2 = null, $table3 = null) {
        return parent::getAllJoin(self::getNameTable(), self::getNameTable2(), self::getNameTable3(), self::getNameTable4(), $fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }

}
