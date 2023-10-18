<?php

namespace App\Models\SubDomains;

use App\Models\BaseModel;

class SubDomainTag extends BaseModel
{
    protected $table = 'sub_domains_tags';

    protected $fillable = [
        'sub_domains_tags_categories_id',
        'sub_domains_tag_template_id',
        'listing_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'text_before',
        'text_after',
        'rating_count',
        'rating_value',
        'sidebar_group',
        'status'
    ];

    protected $attributes = [
        'sub_domain_id' => null,
        'category_id' => null,
    ];

    /**
     * @return mixed
     */
    public function getSubDomainIdAttribute()
    {
        return $this->attributes['sub_domain_id'];
    }

    /**
     * @param $value
     */
    public function setSubDomainIdAttribute($value)
    {
        $this->attributes['sub_domain_id'] = $value;
    }

    /**
     * @return mixed
     */
    public function getCategoryIdAttribute()
    {
        return $this->attributes['category_id'];
    }

    /**
     * @param $value
     */
    public function setCategoryIDAttribute($value)
    {
        $this->attributes['category_id'] = $value;
    }

    public function clearAttributes()
    {
        unset($this->attributes['sub_domain_id']);
        unset($this->attributes['category_id']);
    }
}