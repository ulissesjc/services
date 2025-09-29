<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SchoolController extends Controller
{
     use AuthorizesRequests;

    /**
     * Exibe todas as escolas cadastradas de forma paginada.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', School::class);
        $schools = School::paginate(10);
        return view('schools.index', compact('schools'));
    }


    /**
     * Exibe a view de cadastro de uma nova escola.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('create', School::class);
        return view('schools.create', [
            'school' => new School()
        ]);
    }

    /**
     * Exibe a view de atualização de uma escola existente.
     * @param \App\Models\School $school
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(School $school)
    {
        $this->authorize('update', $school);
        return view('schools.edit', compact('school'));
    }

    /**
     * Exibe a view de visualização dos dados de uma escola.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, School $school)
    {
        $this->authorize('view', $school);
        return view('schools.show', compact('school'));
    }

    /**
     * Cadastra uma nova escola no banco de dados.
     * Utiliza transação para garantir integridade dos dados.
     * @param \App\Http\Requests\SchoolRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SchoolRequest $request)
    {
        $this->authorize('create', School::class);
        $request->validated();

        DB::beginTransaction();

        try {
            School::create([
                'name' => $request->name,
                'inep' => $request->inep,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'has_lab' => $request->has_lab,
                'has_resource_room' => $request->has_resource_room
            ]);

            DB::commit();

            return redirect()->route('school-index')
                ->with('success', 'Escola cadastrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('school-index')
                ->with('error', 'Ocorreu um erro ao tentar cadastrar a escola!');
        }
    }

    /**
     * Atualiza os dados de uma escola existente.
     * Utiliza transação para garantir integridade dos dados.
     * @param \App\Http\Requests\SchoolRequest $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SchoolRequest $request, School $school)
    {
        $this->authorize('update', $school);
        $request->validated();

        try {
            $school->update([
                'name' => $request->name,
                'inep' => $request->inep,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'has_lab' => $request->has_lab,
                'has_resource_room' => $request->has_resource_room
            ]);

            DB::commit();

            return redirect()->route('school-index')
                ->with('success', 'Escola atualizada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('school-index')
                ->with('error', 'Ocorreu um erro ao tentar atualizar a escola!');
        }
    }

    /**
     * Remove uma escola específica do banco de dados.
     * @param \App\Models\School $school
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(School $school)
    {
        $this->authorize('delete', $school);
        try {
            $school->delete();
            return redirect()->route('school-index')
                ->with('success', 'Escola removida com sucesso!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return redirect()->route('school-index')
                    ->with('error', 'A escola não pode ser removida, pois existem atendimentos vinculados a ela!');
            }

            return redirect()->route('school-index')
                ->with('error', 'Ocorreu um erro ao tentar remover a escola!');
        }
    }

    /**
     * Exibe as escolas cujo último atendimento foi realizado a mais de n meses.
     * Por padrão, considera 3 meses se nenhum valor for informado.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getPendingSchools(Request $request){

        $months = (int) $request->input('months', 3);

        $monthsAgo = Carbon::now()->subMonths($months)->toDateString();

        $schools = DB::table('schools')
            ->leftJoin('services', function ($join) {
                $join->on('schools.id', '=', 'services.school_id');
            })
            ->select('schools.*', DB::raw('MAX(services.date) as last_service_date'))
            ->groupBy('schools.id')
            ->havingRaw('MAX(services.date) IS NULL OR MAX(services.date) < ?', [$monthsAgo])
            ->orderBy('last_service_date', 'asc')
            ->paginate(10);

        return view('schools.pending-schools', compact('schools', 'months'));
    }
}
