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
}