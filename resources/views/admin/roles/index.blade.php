<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Role Button -->
            <div class="mb-6">
                <a href="{{ route('admin.roles.create') }}">
                    <x-button>
                        {{ __('Create Role') }}
                    </x-button>
                </a>
            </div>

            <!-- Roles Table -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Role Name') }}</th>
                                    <th class="px-6 py-3 text-center text-gray-800 dark:text-gray-200">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($roles as $role)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-6 py-2 text-gray-800 dark:text-gray-200">{{ $role->name }}</td>
                                        <td class="px-6 py-2 text-center">
                                            <!-- View Permissions Button -->
                                            <a href="{{ route('admin.roles.viewPermissions', $role->id) }}">
                                                <x-button>
                                                    {{ __('View Permissions') }}
                                                </x-button>
                                            </a>

                                            <!-- Assign Permissions Button -->
                                            <x-button onclick="assignPermissions('{{ $role->id }}')">
                                                {{ __('Assign Permissions') }}
                                            </x-button>

                                            <!-- Edit Role Button -->
                                            <a href="{{ route('admin.roles.edit', $role->id) }}">
                                                <x-button class="bg-yellow-500 hover:bg-yellow-600">
                                                    {{ __('Edit') }}
                                                </x-button>
                                            </a>

                                            <!-- Delete Role Button -->
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button
                                                    onclick="confirmDelete('{{ $role->id }}', '{{ $role->name }}')">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Assign Permissions Modal -->
                                    <div id="assignPermissionsModal_{{ $role->id }}" class="fixed inset-0 hidden bg-gray-900 bg-opacity-75 flex justify-center items-center">
                                        <div class="bg-gray-800 dark:bg-gray-900 rounded-lg shadow-xl p-6 max-w-md w-full">
                                            <h2 class="text-lg font-bold text-gray-100">
                                                {{ __('Assign Permissions to Role: ') . $role->name }}
                                            </h2>
                                            <form id="assignPermissionsForm_{{ $role->id }}" method="POST" action="{{ route('admin.roles.assignPermissions', $role->id) }}">
                                                @csrf
                                                <div class="mt-4">
                                                    <label for="permission_ids_{{ $role->id }}" class="block text-sm font-medium text-gray-300">
                                                        {{ __('Select Permissions') }}
                                                    </label>
                                                    <select name="permissions[]" id="permission_ids_{{ $role->id }}" multiple required
                                                        class="mt-1 block w-full border-gray-700 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:focus:ring-blue-500 bg-gray-700 text-gray-300">
                                                        @foreach ($permissions as $permission)
                                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <button type="button" onclick="closeModal('assignPermissionsModal_{{ $role->id }}')"
                                                        class="mr-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                                        {{ __('Cancel') }}
                                                    </button>
                                                    <x-button type="submit">
                                                        {{ __('Assign') }}
                                                    </x-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                            



    <script>
        // Delete Modal Logic
        function confirmDelete(roleId, roleName) {
            const modal = document.getElementById('deleteModal');
            const confirmButton = document.getElementById('confirmDeleteButton');
            const inputField = document.getElementById('deleteConfirmationInput');
    
            // Set the modal message dynamically
            document.getElementById('modalMessage').textContent = 
                `Are you sure you want to delete the role "${roleName}"? This action cannot be undone.`;
    
            // Show the modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            inputField.value = ''; // Clear the input field
    
            // Add event listener to the confirm button
            confirmButton.onclick = function () {
                if (inputField.value === 'DELETE') {
                    submitDelete(roleId);
                } else {
                    alert('Please type DELETE to confirm.');
                }
            };
        }
    
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    
        function submitDelete(roleId) {
            // Create and configure the form dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/roles/${roleId}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE'; // Simulate DELETE method
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
    
            // Append and submit the form
            document.body.appendChild(form);
            form.submit(); // Submit the form
        }
    
        // Assign Permissions Modal Logic
        // Function to open the Assign Permissions Modal
        function assignPermissions(roleId) {
    console.log(`Opening modal for roleId: ${roleId}`);
    const modal = document.getElementById(`assignPermissionsModal_${roleId}`);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        console.error(`Modal for roleId ${roleId} not found`);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    } else {
        console.error(`Modal with ID ${modalId} not found`);
    }
}

    </script>
    
    
    
    
</x-app-layout>
