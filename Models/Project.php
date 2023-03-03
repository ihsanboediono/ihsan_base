<?php

namespace App\Models;

use App\Traits\Model\ImageUrl;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\DescriptionEnPlain;
use App\Traits\Model\DescriptionIdPlain;
use App\Traits\Model\DescriptionPlain;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements Searchable
{
    use HasFactory;
    use ImageUrl;
    use DescriptionIdPlain;
    use DescriptionEnPlain;
    use DescriptionPlain;

    protected $fillable = [
        'coordinate',
        'type',
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'start_date',
        'end_date',
        'status',
        'image',
        'slug',
    ];

    // protected $casts = [
    //     'start_date' => 'date:d-m-Y',
    // ];

    protected $appends = ['image_url', 'description_id_plain', 'description_id_plain_short', 'description_en_plain', 'description_en_plain_short', 'year_start', 'url_project'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            searchable: $this,
            title: $this->name_en,
            url: null
        );
    }


    public function scopeByMonth($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }
    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', date('Y'));
    }

    public function scopeStartedAtYear($query, $year)
    {
        return $query->whereYear('start_date', $year);
    }

    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            'name_'.$locale.' as name',
            'description_'.$locale.' as description',

        );
    }

    public function yearStart() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($this->start_date)->year,
        );
    }

    public function urlProject() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('admin.project.index', ['locale' => get_the_locale(), 'project' => $this->slug]),
        );
    }

    // public function scopeSelectAll($query)
    // {
    //     return $query->addSelect([
    //         'coordinate',
    //         'type',
    //         'name_id',
    //         'name_en',
    //         'description_id',
    //         'description_en',
    //         'start_date',
    //         'end_date',
    //         'status',
    //         'image',
    //     ]);
    // }

}
