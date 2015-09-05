<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of registroPartoBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class registroPartoBaseTableClass extends tableBaseClass {

    private $id,
            $fecha_parto,
            $hembras_nacidas_vivas,
            $machos_nacidos_vivos,
            $nacidos_muertos,
            $raza_id,
            $animal_id;

    const ID = 'id';
    const FECHA_NACIMIENTO = 'fecha_parto';
    const HEMBRAS_NACIDAS_VIVAS = 'hembras_nacidas_vivas';
    const MACHOS_NACIDOS_VIVOS = 'machos_nacidos_vivos';
    const NACIDOS_MUERTOS = 'nacidos_muertos';
    const RAZA_ID = 'raza_id';
    const ANIMAL_ID = 'animal_id';

    function getId() {
        return $this->id;
    }

    function getFecha_parto() {
        return $this->fecha_parto;
    }

    function getHembras_nacidas_vivas() {
        return $this->hembras_nacidas_vivas;
    }

    function getMachos_nacidos_vivos() {
        return $this->machos_nacidos_vivos;
    }

    function getNacidos_muertos() {
        return $this->nacidos_muertos;
    }

    function getRaza_id() {
        return $this->raza_id;
    }

    function getAnimal_id() {
        return $this->animal_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha_parto($fecha_parto) {
        $this->fecha_parto = $fecha_parto;
    }

    function setHembras_nacidas_vivas($hembras_nacidas_vivas) {
        $this->hembras_nacidas_vivas = $hembras_nacidas_vivas;
    }

    function setMachos_nacidos_vivos($machos_nacidos_vivos) {
        $this->machos_nacidos_vivos = $machos_nacidos_vivos;
    }

    function setNacidos_muertos($nacidos_muertos) {
        $this->nacidos_muertos = $nacidos_muertos;
    }

    function setRaza_id($raza_id) {
        $this->raza_id = $raza_id;
    }

    function setAnimal_id($animal_id) {
        $this->animal_id = $animal_id;
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
        return 'registro_parto';
    }

    public static function getNameTable2() {
        return 'animal';
    }

    public static function getNameTable3() {
        return null;
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

    public static function getAllJoin($fields, $fields2, $fields3 = null, $fields4 = null, $fJoin1 = null, $fJoin2 = null, $fJoin3 = null, $fJoin4 = null, $fJoin5 = null, $fJoin6 = null, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null, $table2 = null, $table3 = null) {
        return parent::getAllJoin(self::getNameTable(), self::getNameTable2(), self::getNameTable3(), self::getNameTable4(), $fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }

    public static function getAllCount($fields, $deletedLogical = true, $lines = null, $table = null) {
        return parent::getAllCount(self::getNameTable(), $fields, $deletedLogical, $lines);
    }

}
