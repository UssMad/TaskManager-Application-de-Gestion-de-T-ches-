<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + {{ __('New Task') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="category_id" :value="__('Filter by Category')" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-secondary-button type="submit">
                        {{ __('Filter') }}
                    </x-secondary-button>
                    @if(request()->anyFilled(['category_id']))
                        <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900 px-2 py-2">
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Task List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($tasks->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400 italic">{{ __('No tasks found.') }}</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-4 px-2 font-semibold text-sm">{{ __('Title') }}</th>
                                        <th class="py-4 px-2 font-semibold text-sm text-center">{{ __('Category') }}</th>
                                        <th class="py-4 px-2 font-semibold text-sm text-center">{{ __('Status') }}</th>
                                        <th class="py-4 px-2 font-semibold text-sm text-center">{{ __('Due Date') }}</th>
                                        <th class="py-4 px-2 font-semibold text-sm text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                            <td class="py-4 px-2">
                                                <div class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</div>
                                                <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($task->description, 50) }}</div>
                                            </td>
                                            <td class="py-4 px-2 text-center">
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                    {{ $task->category->name }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-2 text-center">
                                                @php
                                                    $statusClasses = [
                                                        'todo' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                                        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                        'done' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                                    ];
                                                @endphp
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$task->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-2 text-center text-sm">
                                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '-' }}
                                            </td>
                                            <td class="py-4 px-2 text-right space-x-2">
                                                <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium">
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('tasks.edit', $task) }}" class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 text-sm font-medium">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium" onclick="return confirm('Are you sure?')">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $tasks->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
