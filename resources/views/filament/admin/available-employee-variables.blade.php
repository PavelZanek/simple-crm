@php
    $half = ceil(count($tableData) / 2);
    $firstHalf = array_slice($tableData, 0, $half);
    $secondHalf = array_slice($tableData, $half);
@endphp

<p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
    {{ __('admin/employee-document-resource.actions.modals.available_variables.description') }}
</p>

<div class="block md:hidden overflow-auto">
    <div class="grid grid-cols-1 gap-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-1 px-6">
                        {{ __('admin/employee-document-resource.actions.modals.available_variables.variable') }}
                    </th>
                    <th scope="col" class="py-1 px-6">
                        {{ __('admin/employee-document-resource.actions.modals.available_variables.variable_description') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tableData as $row)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 px-6">{{ $row['camelCase'] }}</td>
                        <td class="py-1 px-6">{{ $row['translation'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="hidden md:block">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-1 px-6">
                            {{ __('admin/employee-document-resource.actions.modals.available_variables.variable') }}
                        </th>
                        <th scope="col" class="py-1 px-6">
                            {{ __('admin/employee-document-resource.actions.modals.available_variables.variable_description') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($firstHalf as $row)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-1 px-6">{{ $row['camelCase'] }}</td>
                            <td class="py-1 px-6">{{ $row['translation'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-1 px-6">
                            {{ __('admin/employee-document-resource.actions.modals.available_variables.variable') }}
                        </th>
                        <th scope="col" class="py-1 px-6">
                            {{ __('admin/employee-document-resource.actions.modals.available_variables.variable_description') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($secondHalf as $row)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-1 px-6">{{ $row['camelCase'] }}</td>
                            <td class="py-1 px-6">{{ $row['translation'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
