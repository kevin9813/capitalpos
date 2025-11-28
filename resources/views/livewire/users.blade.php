<div class="p-4">

    <div x-data="{ tab: 'usuarios' }">

    <!-- Tabs -->
    <div class="flex border-b border-gray-300 dark:border-gray-700">
        <button @click="tab = 'usuarios'"
            :class="tab === 'usuarios' ? 'px-4 py-2 border-b-2 border-blue-600 text-blue-600 font-medium' : 'px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600'">
            Usuarios
        </button>

        <button @click="tab = 'permisos'"
            :class="tab === 'permisos' ? 'px-4 py-2 border-b-2 border-blue-600 text-blue-600 font-medium' : 'px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600'">
            Permisos
        </button>
    </div>

    <!-- Contenido -->
    <div class="mt-4">

        {{-- usuarios  --}}
        <div x-show="tab === 'usuarios'">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold">Usuarios</h1>

                <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow">
                    + Nuevo usuario
                </button>
            </div>

            <!-- Tabla -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <table class="w-full">
                    <thead class="border-b dark:border-gray-700">
                        <tr class="text-left">
                            <th class="p-2">ID</th>
                            <th class="p-2">Nombre</th>
                            <th class="p-2">Usuario</th>
                            <th class="p-2">Rol</th>
                            <th class="p-2">Estado</th>
                            <th class="p-2 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $u)
                        <tr class="border-b dark:border-gray-700">
                            <td class="p-2">{{ $u->id }}</td>
                            <td class="p-2">{{ $u->name }}</td>
                            <td class="p-2">{{ $u->usuario }}</td>
                            <td class="p-2">{{ $u->role ? $u->role->name : 'Sin rol' }}</td>
                            <td class="p-2">{{ ($u->status == 1) ? "Activo" : "Inactivo" }}</td>
                            <td class="p-2 text-right">

                                <button 
                                    wire:click="edit({{ $u->id }})"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    <i class="fa-solid fa-file-pen"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            @if ($showModal)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white text-black dark:bg-gray-900 dark:text-white rounded-xl shadow-lg w-full max-w-md p-6">

                        <h2 class="text-xl font-semibold mb-4">
                            {{ $userIdBeingEdited ? 'Editar usuario' : 'Crear usuario' }}
                        </h2>

                        <!-- Nombre -->
                        <label class="block mb-2 text-sm font-medium">Nombre</label>
                        <input type="text" wire:model="name"
                            class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-black focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-4"
                            placeholder="Nombre">

                        <!-- Usuario -->
                        <label class="block mb-2 text-sm font-medium">Usuario</label>
                        <input type="text" wire:model="user"
                            class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-black focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-4"
                            placeholder="Nombre de usuario">

                        <!-- Rol -->
                        <label class="block mb-2 text-sm font-medium">Rol</label>
                        <select wire:model="roleId"
                            class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-black focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-4">
                            <option value="">Seleccione un rol...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        <label class="block mb-2 text-sm font-medium">Estado</label>
                        <select wire:model="statusId"
                            class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-black focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-4">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>

                        <!-- Clave -->
                        <label class="block mb-2 text-sm font-medium">Clave</label>
                        <input type="password" wire:model="password"
                            class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-blackmfocus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-6"
                            placeholder="">

                        <div class="flex justify-end gap-3">
                            <button wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded">
                                Cancelar
                            </button>
                            <button wire:click="save" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white">
                                Guardar
                            </button>
                        </div>

                    </div>
                </div>
            @endif
        </div>

        {{-- permisos  --}}
        <div x-show="tab === 'permisos'">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold">Permisos</h1>
            </div>

              <!-- Seleccionar rol -->
            <div class="mb-4">
                <label class="fblock mb-2 text-sm font-medium">Seleccionar Rol</label>
                <select wire:model.live="selectedRole" class="w-full px-3 py-2 rounded-lg border bg-gray-100 border-gray-300 text-black focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white mb-4">
                    <option value="">Seleccione un rol...</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($selectedRole)

                @foreach ($permissions as $group => $permission)
                    <div class="grid grid-cols-2 gap-3 p-1">

                        <div class="flex items-center gap-3">
                            <!-- Switch grande -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer"
                                    wire:click="togglePermission({{ $permission->id }})" 
                                    @checked(in_array($permission->id, $rolePermissions))>
                                <div class="w-16 h-8 bg-gray-300 peer-focus:outline-none dark:bg-gray-700 rounded-full peer peer-checked:bg-blue-600 transition-all duration-300"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow-md peer-checked:translate-x-8 transition-all duration-300"></div>
                            </label>
    
                            <span class="text-lg text-gray-300 dark:text-gray-200">{{ $permission->name }}</span>
                        </div>

                    </div>
                @endforeach

            @endif

        </div>

    </div>

    </div>

</div>
