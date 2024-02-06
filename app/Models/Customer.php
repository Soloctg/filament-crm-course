<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//use App\Models\LeadSource;


class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'description',
        'lead_source_id',
        'pipeline_stage_id'
    ];

    //customer belongsto Pipeline
    public function pipelineStage(): BelongsTo
    {
        return $this->belongsTo(PipelineStage::class);
    }

    public function leadSource(): BelongsTo
    {
        return $this->belongsTo(LeadSource::class);
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // relationship
    public function pipelineStageLogs(): HasMany
    {
        return $this->hasMany(CustomerPipelineStage::class);
    }

    //The last thing to do is to create the Observers to log all the Pipeline Stage changes:
    public static function booted(): void
    {
        self::created(function (Customer $customer) {
            $customer->pipelineStageLogs()->create([
                'pipeline_stage_id' => $customer->pipeline_stage_id,
                'user_id' => auth()->check() ? auth()->id() : null
            ]);
        });
    }
}
