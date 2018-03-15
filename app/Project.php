<?php

namespace App;

use Facades\App\Upload\Uploads;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'preloader',
        'hero_image',
        'hero_image_preview',
        'hero_image_footer',
        'hero_color',
        'info_subtitle',
        'info_description',
        'start_date',
        'end_date',
        'country_id',
        'client_id',
        'is_featured',
        'is_dark',
    ];

    /**
     * @var array
     */
    protected $appends = ['areas'];

    /**
     * Project Many => Many Services 1 => Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getAreasAttribute()
    {
        return $this->services->pluck('area')->unique();
    }

    /**
     * Project's Client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Project services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Registers a new section for this project.
     *
     * @param  string $modelClass
     * @param  int $modelId
     */
    public function addSection($modelClass, $modelId, $pivotAttrs = [])
    {
        $this->sections()->save(
            new ProjectSection(array_merge([
                'model_id' => $modelId,
                'model_class' => $modelClass,
            ], $pivotAttrs))
        );
    }

    /**
     * Collection of additional text information for this project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(ProjectSection::class)->orderBy('order');
    }

    /**
     * Scope a query to only include feature projects.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    /**
     * Bulk Remove Sections
     *
     * @param array $sectionIds
     * @return bool
     */
    public function bulkRemoveSections(array $sectionIds)
    {
        if (empty($sectionIds)) {
            return true;
        }

        foreach($this->sections()->find($sectionIds) as $section) {
            $section->delete();
        }

        return true;
    }

    /**
     * Bulk Add Sections
     *
     * @param array $sections
     * @return bool
     */
    public function bulkCreateSections(array $sections, $projectSections)
    {
        foreach($sections as $section) {
            $sectionClass = ('\\App\\'.$section['component']);
            $model = $section['model'];
            $fields = $projectSections[$section['component']];

            //Populate Section Fields
            foreach($model as $key => $data) {
                if ('image' === $key) {
                    if ((preg_match('/^data\:image/', $data))) {
                        $data = Uploads::uploadEncoded64Image($data);
                    } else {
                        //$data = null;
                    }
                }

                //ProjectGallery Images
                if ('images' === $key) {
                    $imgs = [];

                    //Traverse all Gallery Images submitted
                    foreach($data as $image) {
                        //Remove Image
                        if (isset($image['id']) and $image['id'] and isset($image['visible'])) {
                            $img = ProjectGalleryImage::find($image['id']);
                            $img->delete();

                            continue;
                        } elseif(isset($image['visible']) and !$image['visible']) {
                            continue;
                        }

                        $img = (isset($image['id']) and $image['id'] and !isset($image['visible'])) ? ProjectGalleryImage::find($image['id']) : new ProjectGalleryImage();

                        foreach($image as $field => $item) {
                            if ('image' === $field) {
                                if ((preg_match('/^data\:image/', $item))) {
                                    $item = Uploads::uploadEncoded64Image($item);
                                }
                            }

                            $img->{$field} = $item;
                        }

                        $imgs[] = $img;
                    }

                    $fields = [];
                    $fields[$key] = $imgs;

                    break;
                }

                $fields[$key] = $data;
            }

            $fields['project_id'] = $this->id;

            if ((preg_match('/^data\:image/', $section['background_image']))) {
                $background = [ 'background_image' => Uploads::uploadEncoded64Image($section['background_image']) ];
            } else {
                $background = ($section['background_image']) ? [] : ['background_image' => null];
            }

            $attrs = [
                'color' => $section['color'],
                'is_dark' => $section['is_dark'],
                //'background_image' => ($section['background_image']) ? $this->uploadEncoded64Image($section['background_image']) : null,
                'is_parallax' => $section['is_parallax'],
                'order' => $section['order'],
            ];

            $attrs = array_merge($attrs, $background);
            $newSection = $sectionClass::create($fields);
            $this->addSection($sectionClass,  $newSection->id, $attrs);

            if ('ProjectGallery' === $section['component'] and !empty($fields['images'])) {
                foreach($fields['images'] as $image) {
                    if(!$image->id) {
                        $image->project_gallery_id = $newSection->id;
                        $newSection->images()->save($image);
                    } else {
                        $image->save();
                    }
                }
            }
        }

        return true;
    }

    /**
     * Bulk Update Sections
     *
     * @param array $sections
     * @return bool
     */
    public function bulkUpdateSections(array $sections, $projectSections)
    {
        foreach($sections as $section) {
            $projectSection = ProjectSection::find($section['id']);
            $model = $section['model'];
            $fields = $projectSections[$section['component']];

            //Populate Section Fields
            foreach($model as $key => $data) {
                if ('image' === $key) {
                    if ((preg_match('/^data\:image/', $data))) {
                        $data = Uploads::uploadEncoded64Image($data);
                    } else {
                        //$data = null;
                    }
                }

                //ProjectGallery Images
                if ('images' === $key) {
                    $imgs = [];

                    //Traverse all Gallery Images submitted
                    foreach($data as $image) {
                        //Remove Image
                        if (isset($image['id']) and $image['id'] and isset($image['visible'])) {
                            $img = ProjectGalleryImage::find($image['id']);
                            $img->delete();

                            continue;
                        } elseif(isset($image['visible']) and !$image['visible']) {
                            continue;
                        }

                        $img = (isset($image['id']) and $image['id'] and !isset($image['visible'])) ? ProjectGalleryImage::find($image['id']) : new ProjectGalleryImage();

                        foreach($image as $field => $item) {
                            if ('image' === $field) {
                                if ((preg_match('/^data\:image/', $item))) {
                                    $item = Uploads::uploadEncoded64Image($item);
                                }
                            }

                            $img->{$field} = $item;
                        }

                        $imgs[] = $img;
                    }

                    $fields = [];
                    $fields[$key] = $imgs;

                    break;
                }

                $fields[$key] = $data;
            }

            $fields['project_id'] = $this->id;

            //@todo refactor using ternary, check weird behavior when implementing it
            if ((preg_match('/^data\:image/', $section['background_image']))) {
                $background = ['background_image' => Uploads::uploadEncoded64Image($section['background_image'])];
            } else {
                $background = ($section['background_image']) ? [] : ['background_image' => null];
            }

            $attrs = [
                'color' => $section['color'],
                'is_dark' => $section['is_dark'],
                'additional_classes' => $section['additional_classes'],
                'is_parallax' => $section['is_parallax'],
                'order' => $section['order'],
            ];

            $attrs = array_merge($attrs, $background);

            if ('ProjectGallery' === $section['component'] and !empty($fields['images'])) {
                foreach($fields['images'] as $image) {
                    if(!$image->id) {
                        $image->project_gallery_id = $projectSection->model->id;
                        $projectSection->model->images()->save($image);
                    } else {
                        $image->save();
                    }
                }
            }

            $projectSection->update($attrs);
            $projectSection->model->update($fields);
        }

        return true;
    }
}
