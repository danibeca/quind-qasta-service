<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ComponentController extends ApiController
{

    public function store(Request $request)
    {
        $newComponent = new Component ($request->except('parent_id'));
        $newComponent->save();
        if ($request->has('parent_id') && $request->type_id !== 1)
        {
            $newComponentTree = new ComponentTree();
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->appendToNode(ComponentTree::where('component_id', $request->parent_id)->first())->save();

        } else
        {
            $newComponentTree = new ComponentTree();
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->saveAsRoot();
        }

        ComponentTree::fixTree();

        return $this->respondResourceCreated();

    }

    public function show($id)
    {
        if (Input::has('details'))
        {

            $component = Component::find($id);

            $info = $component->getInformation();
            if ($info)
            {
                return $this->respondData([
                    'systems'      => $info->systems,
                    'applications' => $component->getInformation()->applications,
                    'debt'         => $this->secondsToTime($component->getInformation()->debt * 60)
                ]);
            }

            return $this->respondData([
                'systems'      => 0,
                'applications' => 0,
                'debt'         => 0
            ]);


        }

        return $this->respondData(Component::find($id));
    }


    function secondsToTime($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a días, %h horas, %i minutos');
    }


    public function update(Request $request, $id)
    {
        /** @var Component $component */
        $component = Component::find($id);
        /** @var ComponentTree $componentTree */
        $componentTree = ComponentTree::where('component_id', $component->id)->get()->first();
        if (! $componentTree->isRoot())
        {
            $component->update($request->all());
            if ($request->parent_id)
            {
                $componentTree->parent_id = $request->parent_id;
                $componentTree->save();
                ComponentTree::fixTree();
            }
        }

        return $this->respond('OK');
    }

    public function destroy($id)
    {
        /** @var Component $component */
        $component = Component::find($id);
        /** @var ComponentTree $componentTree */
        $componentTree = ComponentTree::where('component_id', $component->id)->get()->first();
        if (! $componentTree->isRoot())
        {
            $children = $componentTree->getDescendants();
            $parent_id = $componentTree->parent_id;
            foreach ($children as $child){
                $child->parent_id = $parent_id;
                $child->save();
            }
            Component::find($id)->delete();
            ComponentTree::fixTree();
        }

        return $this->respondResourceDeleted();
    }
}
