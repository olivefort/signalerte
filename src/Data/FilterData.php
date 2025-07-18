<?php


namespace App\Data;

use App\Entity\Signalement;

class FilterData
{
/**
 * @var string
 */
public $recherche = '';

/**
 * @var null|integer[]
 */
public $departement;

/**
 * @var null|integer[]
 */
public $epidemie;

/**
 * @var null|string[]
 */
public $infect;

/**
 * @var null|DateTimeImmutable
 */
public $dateMax;

/**
 * @var null|DateTimeImmutable
 */
public $dateMin;

}


