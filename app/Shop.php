<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\OpeningHours\OpeningHours;

class Shop extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia;

    public $table = 'shops';

    protected $appends = [
        'photos', 'thumbnail'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'traffic_from',
        'traffic_to',
        'active',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'latitude',
        'longitude',
        'featured',
        'created_by_id',
    ];


    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(325)->height(210);
    }

    public function getPhotosAttribute(): Collection
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function getThumbnailAttribute(): string
    {
        return $this->getFirstMediaUrl('photos', 'thumb');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function roads(): BelongsToMany
    {
        return $this->belongsToMany(Road::class);
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Day::class)->withPivot('from_hours', 'from_minutes', 'to_hours', 'to_minutes');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getWorkingHoursAttribute(): OpeningHours
    {
        $hours = $this->days
            ->pluck('pivot', 'name')
            ->map(function($pivot) {
                return [
                    $pivot['from_hours'].':'.$pivot['from_minutes'].'-'.$pivot['to_hours'].':'.$pivot['to_minutes']
                ];
            });

        return OpeningHours::create($hours->toArray());
    }

    public function scopeSearchResults($query)
    {
        return $query->where('active', 1)
            ->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('description', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('category'), function($query) {
                $query->whereHas('categories', function($query) {
                    $query->where('id', request()->input('category'));
                });
            });
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }
}
