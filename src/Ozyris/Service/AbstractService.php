<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/07/17
 * Time: 17:43
 */

namespace Ozyris\Service;


class AbstractService
{

    /**
     * @param AbstractService $oClasse
     * @param array $aInfos
     * @throws \Exception
     */
    public function hydrate(AbstractService $oClasse, array $aInfos)
    {
        foreach($aInfos as $attribut => $value) {

            $method = 'set' . str_replace('_', '', ucfirst(strtolower($attribut)));

            if (!method_exists($oClasse, $method)) {
                throw new \Exception('La méthode set' . ucfirst(strtolower($attribut)) . ' de la classe ' .
                get_class($oClasse) . ' n\'existe pas.');
            }

            $oClasse->$method($value);
        }
    }

    /**
     * @param $object
     * @param array $datas
     * @return bool
     * @throws \Exception
     */
    public function updateProperties($object, array $datas)
    {
        if (!is_array($datas) || count($datas) == 0 || !is_object($object)) {
            return false;
        }

        foreach ($datas as $k => $v) {
            $method = 'set' . ucfirst($k);

            if (!method_exists($object, $method)) {
                throw new \Exception('La méthode ' . $method . ' de la classe ' .
                    get_class($object) . ' n\'existe pas.');
            }

            $object->$method($v);
        }

        return true;
    }
}