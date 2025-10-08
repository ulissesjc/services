<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\School;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceController extends Controller
{
    use AuthorizesRequests;

    /**
     * Exibe todos os atendimentos cadastrados de forma paginada.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Service::class);
        $services = Service::with('school')->when($request->filled('start_date'), function($whenQuery) use ($request) {
            $whenQuery->where('date', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
        })
        ->when($request->filled('end_date'), function($whenQuery) use ($request) {
            $whenQuery->where('date', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
        })
        ->when($request->filled('city'), function ($whenQuery) use ($request){
            $whenQuery->whereHas('school', function($whenQueryAux) use ($request) {
                $whenQueryAux->where('city', $request->city);
            });
        })
        ->when($request->filled('schoolName'), function ($whenQuery) use ($request){
            $whenQuery->whereHas('school', function ($whenQueryAux) use ($request) {
                $whenQueryAux->where('id', $request->schoolName);
            });
        })
        ->when($request->filled('mode'), function ($whenQuery) use ($request) {
            $whenQuery->where('mode', $request->mode);
        })
        ->when($request->filled('user'), function ($whenQuery) use ($request) {
            $whenQuery->whereHas('user', function ($whenQueryAux) use ($request) {
                $whenQueryAux->where('name', $request->user);
            });
        })
        ->when($request->filled('category'), function($whenQuery) use ($request) {
            $whenQuery->where('category', $request->category);
        })
        ->orderByDesc('date')
        ->paginate(10)
        ->withQueryString();

        $schools = School::all();
        $users = User::pluck('name');

        return view('services.index', [
            'services' => $services,
            'schools' => $schools,
            'users' => $users,
            'cities' => School::select('city')->distinct()->orderBy('city')->pluck('city'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'city' => $request->city,
            'schoolName' => $request->schoolName,
            'mode' => $request->mode,
            'user' => $request->user,
            'category' => $request->category
        ]);
    }

    /**
     * Exibe a view de cadastro de um atendimento.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('create', Service::class);
        $cities = School::select('city')
                        ->groupBy('city')
                        ->pluck('city')
                        ->sortBy(function ($city) {
                            return $city;
                        });

        $schools = School::all();

        return view('services.create', compact('cities', 'schools'));
    }

    /**
     * Exibe a view de atualização de um atendimento existente.
     * @param \App\Models\Service $service
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        $city = $service->school->city;
        $school = $service->school_id;

        return view('services.edit', compact('service', 'city', 'school'));
    }

    /**
     * Cadastra um novo atendimento no banco de dados.
     * Utiliza transação para garantir integridade dos dados.
     * @param \App\Http\Requests\ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function store(ServiceRequest $request)
    {
        $this->authorize('create', Service::class);
        $request -> validated();

        DB::beginTransaction();

        try {
            Service::create([
                'glpi_number_call' => $request->glpi_number_call,
                'category' => $request->category,
                'description' => $request->description,
                'date' => $request->date,
                'mode' => $request->mode,
                'user_id' => Auth::id(),
                'school_id' => $request->school_id
            ]);

            DB::commit();

            return redirect()->route('service-index')
                ->with('success', 'Atendimento cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('service-index')
                ->with('error', 'Ocorreu um erro ao tentar cadastrar o atendimento!');
        }
    }

    /**
     * Atualiza os dados de um atendimento existente.
     * Utiliza transação para garantir a integridade dos dados.
     * @param \App\Http\Requests\ServiceRequest $request
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);
        $request->validated();

        try {
            $service->update([
                'glpi_number_call' => $request->glpi_number_call,
                'category' => $request->category,
                'description' => $request->description,
                'date' => $request->date,
                'mode' => $request->mode,
                'user_id' => Auth::id(),
                'school_id' => $request->school_id
            ]);

            DB::commit();

            return redirect()->route('service-index')
                ->with('success', 'Atendimento atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('service-index')
                ->with('error', 'Ocorreu um erro ao tentar atualizar o atendimento!');
        }
    }

    /**
     * Remove um atendimento específico do banco de dados.
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        try {
            $service->delete();
            return redirect()->route('service-index')
                ->with('success', 'Atendimento removido com sucesso!');
        } catch (\Exception $e){
            return redirect()->route('service-index')
                ->with('error', 'Ocorreu um erro ao tentar remover o atendimento');
        }
    }

}
