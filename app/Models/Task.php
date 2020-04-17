<?php

namespace App\Models;

use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $name
 * @property int $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    /** @var string[] $fillable */
    protected $fillable = ['name', 'priority', 'project_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function(Task $model) {
            $model->setUserId(Auth::user()->getAuthIdentifier());
        });
    }

    /*** Relationships ***/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*** Getters and Setters ***/

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function setId(int $id): Task
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return Task
     */
    public function setUserId(int $user_id): Task
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     * @return Task
     */
    public function setProjectId(int $project_id): Task
    {
        $this->project_id = $project_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Task
     */
    public function setName(string $name): Task
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return Task
     */
    public function setPriority(int $priority): Task
    {
        $this->priority = $priority;
        return $this;
    }

}
