<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedFieldsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\LeadBundle\Entity\LeadField;

/**
 * Class ExtendedFieldCommon.
 *
 * Allow custom fields to be stored in EAV tables by doctrine data types.
 */
class ExtendedFieldCommon
{

    /**
     * @param ORM\ClassMetadata $metadata
     * @param null $dataType Acceptable values matching doctrine datatypes:
     *                         datetime
     *                         date
     *                         time
     *                         boolean
     *                         float
     *                         string
     *                         text
     * @param bool $secure
     */
    public static function loadMetadataCommon(ORM\ClassMetadata $metadata, $dataType = null, $secure = false)
    {
        $builder = new ClassMetadataBuilder($metadata);
        if ($dataType) {
            $builder
                ->setTable('lead_fields_leads_'.$dataType.($secure ? '_secure' : '').'_xref');

            $builder->createManyToOne('lead', Lead::class)
                ->cascadePersist()
                ->cascadeMerge()
                ->addJoinColumn('lead_id', 'id')
                ->makePrimaryKey()
                ->build();

            $builder->createManyToOne('leadField', LeadField::class)
                ->cascadePersist()
                ->cascadeMerge()
                ->addJoinColumn('lead_field_id', 'id')
                ->makePrimaryKey()
                ->build();

            $builder->createField('value', $dataType)
                ->columnName('value')
                ->build();
        } else {
            $builder->addId();
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Lead
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param Lead
     *
     * @return ExtendedFieldCommon
     */
    public function setLead($lead)
    {
        $this->lead = $lead;
        return $this;
    }

    /**
     * @return LeadField
     */
    public function getLeadField()
    {
        return $this->leadField;
    }

    /**
     * @param LeadField
     *
     * @return ExtendedFieldCommon
     */
    public function setLeadField($leadField)
    {
        $this->leadField = $leadField;
        return $this;
    }

    /**
     * @return Value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Value
     *
     * @return ExtendedFieldCommon
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
