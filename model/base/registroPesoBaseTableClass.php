<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of proveedorBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class registroPesoBaseTableClass extends tableBaseClass {

    private $id,
            $fecha_registro,
            $empleado,
            $numero_animal,
            $valor_kilo,
            $valor_total,
            $peso_diario;

    const ID = 'id';
    const FECHA = 'fecha_registro';
    const EMPLEADO = 'empleado';
    const ANIMAL = 'numero_animal';
    const KILO = 'valor_kilo';
    const VALOR = 'valor_total';
    const PESO = 'peso_diario';

    function getId() {
        return $this->id;
    }

    function getFecha_Registro() {
        return $this->fecha_Registro;
    }

    function getEmpleado() {
        return $this->empleado;
    }

    function getNumero_animal() {
        return $this->numero_animal;
    }

    function getValor_kilo() {
        return $this->valor_kilo;
    }

    function getValor_total() {
        return $this->valor_total;
    }

    function getPeso_diario() {
        return $this->peso_diario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha_Registro($fecha_Registro) {
        $this->fecha_Registro = $fecha_Registro;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }

    function setNumero_animal($numero_animal) {
        $this->numero_animal = $numero_animal;
    }

    function setValor_kilo($valor_kilo) {
        $this->valor_kilo = $valor_kilo;
    }

    function setValor_total($valor_total) {
        $this->valor_total = $valor_total;
    }

    function setPeso_diario($peso_diario) {
        $this->peso_diario = $peso_diario;
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
     * Obtiene el nombre de la tabla
     * @return string
     */
    public static function getNameTable() {
        return 'registro_peso';
    }

    public static function getNameTable2() {
        return 'empleado';
    }

    public static function getNameTable3() {
        return 'animal';
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
