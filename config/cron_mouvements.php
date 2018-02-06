<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 29/01/18
 * Time: 11:47
 */

/**
 * Specify your classes, methods to call, params and cron script
 */
return [
    0 => [
        'class' => \Ozyris\Model\MouvementModel::class,
        'method' => 'insertMouvementByInfosMouvement',
        'constructor_params' => [],
        'method_params' => [
            'id_compte' => 1,
            'type_mouvement' => 'depot',
            'montant' => 1200,
            'libelle' => 'Virement mensuel'
        ]
    ],
    1 => [
        'class' => \Ozyris\Model\MouvementModel::class,
        'method' => 'insertMouvementByInfosMouvement',
        'constructor_params' => [],
        'method_params' => [
            'id_compte' => 1,
            'type_mouvement' => 'retrait',
            'montant' => 520,
            'libelle' => 'Crédit Agricole'
        ]
    ],
];