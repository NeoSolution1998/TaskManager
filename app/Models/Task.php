<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'assigned_to_id'
    ];

    /**
     * Get current task status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * Get task author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Get collection of labels associated with given task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels()
    {
        return $this->belongsToMany(Label::class)->using(LabelTask::class);
    }
}
