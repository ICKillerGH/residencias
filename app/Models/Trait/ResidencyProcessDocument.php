<?php

namespace App\Models\Trait;

use App\Enum\DocumentStatus;
use App\Models\Correction;

trait ResidencyProcessDocument
{ 
    /**
     * Relationships
     */
    public function corrections()
    {
        return $this->morphMany(Correction::class, 'correctionable');
    }

    /**
     * Accessors
     */
    public function getRequestDateFormattedAttribute()
    {
        return "{$this->request_date->day} de {$this->request_date->monthName} de {$this->request_date->year}";
    }

    public function getBtnColorAttribute()
    {
        return [
            DocumentStatus::STATUS_PROCESSING => 'warning',
            DocumentStatus::STATUS_APPROVED => 'success',
            DocumentStatus::STATUS_NEEDS_CORRECTIONS => 'danger',
        ][$this->status] ?? '';
    }

    /**
     * Methods
     */
    public function needsCorrections()
    {
        return $this->status === DocumentStatus::STATUS_NEEDS_CORRECTIONS;
    }
}