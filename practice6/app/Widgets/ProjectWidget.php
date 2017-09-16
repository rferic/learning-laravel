<?php
namespace App\Widgets;

use App\Project;
use Arrilot\Widgets\AbstractWidget;

//TODO For Create And Print on Dashboard a Widget (Project Widget)
class ProjectWidget extends AbstractWidget{
    protected $config = [];

    public function run(){
        $count = Project::all()->count();
        $string = $count === 1 ? 'project' : 'projects';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon' => 'voyager-rum-1',
            'title' => "{$count} {$string}",
            'text' => "You have {$count} {$string}. Click on button below to view all projects",
            'button' => [
                'text' => 'View all projects',
                'link' => route('voyager.projects.index')
            ],
            'image'=> voyager_asset('images/widget-backgrounds/01.png')
        ]));
    }
}
