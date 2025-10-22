<?php


namespace App\Data;

use App\Entity\Signalement;

class FilterData
{
/**
 * @var string
 */
public $q = '';

/**
 * @var Signalement.type[]
 */
public $type;

/**
 * @var Structure.departement[]
 */
public $departement;

/**
 * @var Signalement.epidemie[]
 */
public $epidemie;

/**
 * @var Signalement.infection[]
 */
public $infect;

/**
 * @var Signalement.service[]
 */
public $serv;

/**
 * @var null|DateTimeImmutable
 */
public $dateMax;

/**
 * @var null|DateTimeImmutable
 */
public $dateMin;

/**
 * @var Signalement.score[]
 */
public $scoreMin;

/**
 * @var Signalement.score[]
 */
public $scoreMax;

/**
 * @var Signalement.ars[]
 */
public $ARS;

/**
 * @var Signalement.es[]
 */
public $ES;

/**
 * @var Signalement.cpias[]
 */
public $CPIAS;

/**
 * @var Signalement.spf[]
 */
public $SPF;

/**
 * @var Signalement.souche[]
 */
public $souche;

/**
 * @var Signalement.contact[]
 */
public $contact;

}




