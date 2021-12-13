<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ResidencyRequest extends Model
{
    use HasFactory;

    public const STATUS_PROCESSING = 'processing';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_NEEDS_CORRECTIONS = 'needs_corrections';

    protected $guarded = [];

    protected $dates = ['request_date'];

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
            self::STATUS_PROCESSING => 'warning',
            self::STATUS_APPROVED => 'success',
            self::STATUS_NEEDS_CORRECTIONS => 'danger',
        ][$this->status];
    }

    /**
     * Mutators
     */
    public function setSignedDocumentAttribute($value)
    {
        $this->attributes['signed_document'] = $value instanceof UploadedFile
            ? $value->store('public/residency-request')
            : $value;
    }

    /**
     * Methods
     */
    public function needsCorrections()
    {
        return $this->status === self::STATUS_NEEDS_CORRECTIONS;
    }
}
