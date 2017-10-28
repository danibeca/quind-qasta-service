<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ComponentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Input::has('parent_id'))
        {
            $ids = ComponentTree::find(Input::get('parent_id'))->getDescendants()->pluck('component_id');

            return $this->respondData(Component::whereIn('id', $ids)->get());
        }

        return $this->respondData(Component::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Input::has('details'))
        {

            $component = Component::find($id);


            return $this->respondData([
                'systems'      => $component->getInformation()->systems,
                'applications' => $component->getInformation()->applications,
                'debt'         => $this->secondsToTime($component->getInformation()->debt*60)
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Component $component */
        $component = Component::find($id);
        /** @var ComponentTree $componentTree */
        $componentTree = ComponentTree::where('component_id', $component->id)->get()->first();
        if (! $componentTree->isRoot())
        {
            $component->update($request->only('name'));
        } else
        {
            $component->update($request->all());
        }

        return $this->respond('OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $component = Component::find($id);
        if (! $component->isRoot())
        {
            Component::find($id)->delete();
        }

        return $this->respondResourceDeleted();
    }
}
