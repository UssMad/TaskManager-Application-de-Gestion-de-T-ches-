<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $task->title }}</h1>
                            <div class="flex items-center gap-3">
                                <span class="px-3 py-1 text-sm rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400 font-medium">
                                    {{ $task->category->name }}
                                </span>
                                @php
                                    $statusClasses = [
                                        'todo' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                        'done' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-sm rounded-full {{ $statusClasses[$task->status] ?? 'bg-gray-100 text-gray-800' }} font-medium border border-current">
                                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ __('Due Date') }}</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('F j, Y') : __('No date set') }}
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Description') }}</h3>
                        <div class="text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-wrap">
                            {{ $task->description ?: __('No description provided.') }}
                        </div>
                    </div>

                    <div class="mt-12 flex justify-end pt-8 border-t border-gray-100 dark:border-gray-700">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this task?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium transition duration-150">
                                {{ __('Delete this task') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
