<?php

namespace App\Models;

use App\Enum\DocumentStatus;
use App\Models\Trait\ResidencyProcessDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ResidencyRequest extends Model
{
    use HasFactory, ResidencyProcessDocument;

    protected $guarded = [];

    protected $dates = ['request_date'];

    /**
     * Mutators
     */
    public function setSignedDocumentAttribute($value)
    {
        $this->attributes['signed_document'] = $value instanceof UploadedFile
            ? $value->store('public/residency-request')
            : $value;
    }
}
