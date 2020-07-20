<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;   
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate(5);
        return view('admin.pages.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        try {     
            $data = $request->except('_token');
            $data['url'] = Str::kebab($request->name);
            $this->repository->create($data);
            return redirect()->back()->with('message','Os dados foram salvos com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        try {            
            $plan = $this->repository->where('url', $id)->first();
            return view('admin.pages.plans.show', compact('plan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());            
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {            
            $plan = $this->repository->findOrFail($id);
            return view('admin.pages.plans.edit', compact('plan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        
        try {            
            $this->repository->where('id',$id)->update($request->except('_token','_method'));   
            return redirect()->route('plans.index')->with('message','Os dados foram salvos com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('plans.index')->with('error',$e->getMessage());            
        }     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {            
            $plan = $this->repository->where('url', $id)->first();
            $plan->delete();
            return redirect()->route('plans.index')->with('message','Os dados foram excluidos com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());            
        }
    }
    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');            
            $plans = $this->repository->search($request->search);  
            return view('admin.pages.plans.index',[
                'plans' => $plans,
                'filters' => $filters
            ]);
        } catch (\Exception $e) {
            return redirect()->route('plans.index')->with('error',$e->getMessage());            
        }  
        

    }
}
