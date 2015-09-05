<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of createDetalleSalidaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $id_registro = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_SALIDA, true));
                $tipo_insumo = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true));
                $id_insumo = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true));
                $cantidad = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true));
                 $lote = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::LOTE, true));

                detalleSalidaBodegaTableClass::validateCreate( $tipo_insumo, $id_insumo, $cantidad);


                //Manejo de inventario
                $fieldsInventario = array(
                    insumoTableClass::CANTIDAD
                );
                $whereInventario = array(
                    insumoTableClass::ID => $id_insumo
                );
                $objInsumoInventario = insumoTableClass::getAll($fieldsInventario, true, null, null, null, null, $whereInventario);
                $insumoInventario = ($objInsumoInventario[0]->cantidad) - $cantidad;
                $id_inventario_insumo = array(
                    insumoTableClass::ID => $id_insumo
                );
                $data_inventario_insuom = array(
                    insumoTableClass::CANTIDAD => $insumoInventario
                );

                $flag = false;
                if ($cantidad > $objInsumoInventario[0]->cantidad) {
                    session::getInstance()->setError('La cantidad del insumo no es suficiente');
                    $flag = true;
                    session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
                }

                if ($flag == true) {
                    request::getInstance()->setMethod('GET');
                    routing::getInstance()->forward('bodega', 'indexSalida');
                }
                insumoTableClass::update($id_inventario_insumo, $data_inventario_insuom);

                $data = array(
                    detalleSalidaBodegaTableClass::CANDITDAD => $cantidad,
                    detalleSalidaBodegaTableClass::ID_SALIDA => $id_registro,
                    detalleSalidaBodegaTableClass::ID_INSUMO => $id_insumo,
                    detalleSalidaBodegaTableClass::TIPO_INSUMO => $tipo_insumo,
                    detalleSalidaBodegaTableClass::LOTE => $lote
                );
//                print_r($data);
//                                exit();

                detalleSalidaBodegaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate3', null, 'bodega'));
                log::register(i18n::__('create'), detalleSalidaBodegaTableClass::getNameTable());
                routing::getInstance()->redirect('bodega', 'indexSalida');
            } else {
                log::register(i18n::__('create'), detalleSalidaBodegaBaseTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
