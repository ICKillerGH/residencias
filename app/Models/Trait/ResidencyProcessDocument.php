<?php

namespace App\Models\Trait;

use App\Enum\DocumentStatus;

trait ResidencyProcessDocument
{    
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
}