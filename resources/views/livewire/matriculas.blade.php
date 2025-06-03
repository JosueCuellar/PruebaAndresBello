<div>
    {{-- The Master doesn't talk, he acts. --}}

    

<form wire:submit.prevent = "matricular" class="max-w-sm mx-auto p-10">
  <div class="mb-5">
    <label for="carnet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese carnet del estudiante</label>
    <input wire:model="carnet" type="carnet" id="carnet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese Carnet" required />
  </div>

    <div class="mb-5">
    <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese codigo de materia</label>
    <input wire:model="codigo" type="carnet" id="carnet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese Codigo Materia" required />
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Matricular estudiante</button>
</form>




<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Materia
                </th>
                <th scope="col" class="px-6 py-3">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if (sizeof($materias_matriculadas) > 0)
                @foreach ( $materias_matriculadas as $item )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->nombre }}
                </th>
                <td class="px-6 py-4">
                    <button type="button" wire:click = "eliminar({{ $item->id }})"  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar matricula</button>
                </td>
            </tr>
            @endforeach     
            @endif
        </tbody>
    </table>
</div>



</div>
