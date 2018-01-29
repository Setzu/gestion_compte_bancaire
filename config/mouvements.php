<?php
/**
 * Created by PhpStorm.
 * User: gfp
 * Date: 29/01/18
 * Time: 11:47
 */

return [
    'mouvement' => [
        'salaire' => [
            'compte_id' => 1,
            'type' => 'depot',
            'libelle' => 'Cindy & David',
            'montant' => 1200
        ],
        'credit' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'emetteur' => 'Crédit Agricole',
            'montant' => 520
        ],
        'electricite' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'libelle' => 'Engie',
            'montant' => 130
        ],
        'eau' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'libelle' => 'Eau',
            'montant' => 180
        ],
        'taxe_fronciere' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'libelle' => 'Taxe froncière',
            'montant' => 600
        ],
        'taxe_habitation' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'emetteur' => 'Taxe d\'habitation',
            'montant' => 600
        ],
        'internet' => [
            'compte_id' => 1,
            'type' => 'retrait',
            'emetteur' => 'Free',
            'montant' => 40
        ]
    ],
];