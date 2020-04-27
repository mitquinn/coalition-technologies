<?php

namespace App\Models;

use App\User;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $name
 * @property int $priority
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @property-read User $user
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereName($value)
 * @method static Builder|Task wherePriority($value)
 * @method static Builder|Task whereProjectId($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task whereUserId($value)
 * @mixin Eloquent
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
            $highestPriority = (int)Task::whereUserId($model->getUserId())->whereProjectId($model->getProjectId())->max('priority');
            $model->setPriority($highestPriority+=1);
        });

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'asc');
        });
    }

    /*** Relationships ***/

    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
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
