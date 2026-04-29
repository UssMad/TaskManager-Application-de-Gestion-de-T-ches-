@extends('layouts.app')
@section('title', 'My Tasks — TaskFlow')
@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-on-surface font-semibold mb-1" style="font-size:32px;line-height:40px;letter-spacing:-0.02em;">My Tasks</h1>
        <p class="text-on-surface-variant text-sm">Manage, track, and complete your ongoing work.</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="bg-primary text-on-primary rounded-lg font-medium text-sm px-5 py-2.5 flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
        <span class="material-symbols-outlined" style="font-size:18px;">add</span>New Task
    </a>
</div>

{{-- Filters --}}
<div class="flex items-center justify-between mb-6 pb-6 border-b border-surface-variant flex-wrap gap-4">
    <div class="flex items-center gap-2 flex-wrap">
        @php $statuses = ['' => 'All Tasks', 'todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Completed']; @endphp
        @foreach($statuses as $val => $label)
            <a href="{{ route('tasks.index', array_filter(['status' => $val ?: null, 'category_id' => request('category_id')])) }}"
               class="rounded-full px-4 py-1.5 font-medium transition-colors" style="font-size:12px;letter-spacing:0.02em;
               {{ request('status', '') === $val ? 'background:#302f39;color:#f3effc;' : 'background:#f0ecf9;border:1px solid #c7c4d8;color:#464555;' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
    <form method="GET" action="{{ route('tasks.index') }}">
        @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
        <div class="relative">
            <select name="category_id" onchange="this.form.submit()" class="appearance-none bg-surface-container-lowest border border-outline-variant text-on-surface rounded-lg pl-4 pr-9 py-2 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary cursor-pointer">
                <option value="">Category: All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" style="font-size:18px;">expand_more</span>
        </div>
    </form>
</div>

{{-- Task List --}}
@if($tasks->isEmpty())
    <div class="flex flex-col items-center justify-center text-center py-24">
        <div class="w-24 h-24 rounded-full bg-surface-container-high flex items-center justify-center mb-6 border border-outline-variant">
            <span class="material-symbols-outlined text-primary" style="font-size:48px;opacity:0.8;">checklist</span>
        </div>
        <h2 class="text-on-surface font-semibold mb-3" style="font-size:24px;letter-spacing:-0.015em;">No tasks found</h2>
        <p class="text-on-surface-variant mb-8 max-w-xs text-sm">{{ request('status') || request('category_id') ? 'No tasks match your current filters.' : 'Create your first task to get started.' }}</p>
        <a href="{{ route('tasks.create') }}" class="bg-primary text-on-primary text-sm font-medium px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant border-t border-white/20 shadow-sm">
            <span class="material-symbols-outlined" style="font-size:18px;">add</span>New Task
        </a>
    </div>
@else
    <div class="flex flex-col gap-3">
        @foreach($tasks as $task)
            @php $isOverdue = $task->due_date && $task->status !== 'done' && \Carbon\Carbon::parse($task->due_date)->isPast(); @endphp
            <div class="bg-surface-container-lowest border {{ $isOverdue ? 'border-error/30' : 'border-outline-variant' }} rounded-lg p-4 shadow-[0_4px_12px_rgba(0,0,0,0.02)] flex items-center justify-between hover:bg-surface-container hover:shadow-[0_4px_12px_rgba(0,0,0,0.04)] transition-all duration-200 group relative overflow-hidden">
                @if($isOverdue)
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-error"></div>
                @endif

                <div class="flex items-center gap-4 flex-1 min-w-0 {{ $isOverdue ? 'pl-2' : '' }}">
                    @if($task->status === 'done')
                        <div class="w-5 h-5 rounded border-2 border-secondary bg-secondary flex items-center justify-center text-on-secondary shrink-0">
                            <span class="material-symbols-outlined" style="font-size:12px;font-variation-settings:'FILL' 1;">check</span>
                        </div>
                    @else
                        <form method="POST" action="{{ route('tasks.updateStatus', $task) }}" class="shrink-0">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="{{ $task->status === 'todo' ? 'in_progress' : 'done' }}">
                            <button type="submit" title="Advance status" class="w-5 h-5 rounded border-2 border-outline-variant hover:border-primary transition-colors flex items-center justify-center text-transparent hover:text-primary">
                                <span class="material-symbols-outlined" style="font-size:12px;">check</span>
                            </button>
                        </form>
                    @endif

                    <div class="min-w-0">
                        <a href="{{ route('tasks.show', $task) }}" class="font-semibold hover:text-primary transition-colors block truncate {{ $task->status === 'done' ? 'line-through text-on-surface-variant' : 'text-on-surface' }}" style="font-size:15px;line-height:28px;letter-spacing:-0.01em;">
                            {{ $task->title }}
                        </a>
                        <div class="flex items-center gap-3 mt-0.5 flex-wrap">
                            @if($task->category)
                                <span class="bg-surface-variant text-on-surface-variant rounded px-2 py-0.5 flex items-center gap-1" style="font-size:11px;font-weight:500;">
                                    <span class="material-symbols-outlined" style="font-size:11px;">label</span>{{ $task->category->name }}
                                </span>
                            @endif
                            <span class="text-on-surface-variant flex items-center gap-1" style="font-size:12px;">
                                <span class="material-symbols-outlined" style="font-size:12px;">calendar_today</span>{{ $task->created_at->format('M d') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-5 shrink-0 ml-4">
                    @if($task->due_date)
                        <div class="flex flex-col items-end hidden sm:flex">
                            <span class="{{ $isOverdue ? 'text-error flex items-center gap-0.5' : 'text-on-surface-variant' }} uppercase tracking-wider" style="font-size:11px;font-weight:500;">
                                @if($isOverdue)
                                    <span class="material-symbols-outlined" style="font-size:11px;">warning</span>Overdue
                                @else
                                    Due Date
                                @endif
                            </span>
                            <span class="{{ $isOverdue ? 'text-error font-medium' : 'text-on-surface' }}" style="font-size:13px;">{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                        </div>
                    @endif

                    <div class="w-[110px] flex justify-end">
                        @if($task->status === 'in_progress')
                            <span class="bg-primary-fixed text-on-primary-fixed rounded-full px-3 py-1 flex items-center gap-1" style="font-size:11px;font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>In Progress
                            </span>
                        @elseif($task->status === 'done')
                            <span class="bg-secondary-fixed text-on-secondary-fixed rounded-full px-3 py-1 flex items-center gap-1" style="font-size:11px;font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary inline-block"></span>Done
                            </span>
                        @else
                            <span class="bg-surface-container-highest text-on-surface-variant rounded-full px-3 py-1 flex items-center gap-1 border border-outline-variant" style="font-size:11px;font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-outline inline-block"></span>To Do
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('tasks.edit', $task) }}" class="p-1.5 rounded hover:bg-surface-variant text-on-surface-variant hover:text-on-surface transition-colors" title="Edit">
                            <span class="material-symbols-outlined" style="font-size:18px;">edit</span>
                        </a>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" x-data x-on:submit.prevent="confirm('Delete this task?') && $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 rounded hover:bg-error-container text-on-surface-variant hover:text-error transition-colors" title="Delete">
                                <span class="material-symbols-outlined" style="font-size:18px;">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($tasks->hasPages())
        <div class="mt-8 pt-6 border-t border-surface-variant flex items-center justify-between flex-wrap gap-4">
            <p class="text-on-surface-variant text-sm">
                Showing <span class="font-medium text-on-surface">{{ $tasks->firstItem() }}</span>–<span class="font-medium text-on-surface">{{ $tasks->lastItem() }}</span> of <span class="font-medium text-on-surface">{{ $tasks->total() }}</span> tasks
            </p>
            <div class="flex items-center gap-1">
                @if($tasks->onFirstPage())
                    <span class="px-3 py-1.5 rounded-md border border-outline-variant text-on-surface-variant text-sm font-medium opacity-40 cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $tasks->previousPageUrl() }}" class="px-3 py-1.5 rounded-md border border-outline-variant text-on-surface-variant hover:bg-surface-container text-sm font-medium transition-colors">Previous</a>
                @endif
                @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                    @if($page == $tasks->currentPage())
                        <span class="w-8 h-8 rounded-md bg-inverse-surface text-inverse-on-surface flex items-center justify-center text-sm font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 rounded-md hover:bg-surface-container text-on-surface-variant flex items-center justify-center text-sm font-medium transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
                @if($tasks->hasMorePages())
                    <a href="{{ $tasks->nextPageUrl() }}" class="px-3 py-1.5 rounded-md border border-outline-variant text-on-surface-variant hover:bg-surface-container text-sm font-medium transition-colors">Next</a>
                @else
                    <span class="px-3 py-1.5 rounded-md border border-outline-variant text-on-surface-variant text-sm font-medium opacity-40 cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    @endif
@endif

@endsection
