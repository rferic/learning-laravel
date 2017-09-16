<?php

namespace App\Transformers;

use App\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    /**
     * Related models to include in this transformation.
     *
     * @var array
     */
    protected $availableIncludes = [
        //TODO for return User relation
        'user'
    ];

    //For include Default Relations
    protected $defaultIncludes = [
        //TODO for return User relation
       'user'
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @param Project $project
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            //TODO Attributes of Transform for return
            'id' => (int) $project->id,
            'name' => (string) $project->name,
            //'description' => (string) $project->description,
            'user_id' => (int) $project->user_id
        ];
    }

    //TODO Method for include use
    public function includeUser(Project $project){
        $user = $project->user;
        //TODO Call Transformer Relation (User)
        return $this->item($user, new UserTransformer);
    }
}
