<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ExtendedFieldBooleanSecure
 * {@inheritdoc}
 */
class ExtendedFieldBooleanSecure extends ExtendedFieldCommon
{
    /**
     * @var \Mautic\LeadBundle\Entity\Lead
     */
    private $lead;

    /**
     * @var \Mautic\LeadBundle\Entity\LeadField
     */
    private $leadField;

    /**
     * @var string
     */
    private $value;

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata(ORM\ClassMetadata $metadata)
    {
        parent::loadMetadataCommon($metadata, 'boolean', true);
    }
}
