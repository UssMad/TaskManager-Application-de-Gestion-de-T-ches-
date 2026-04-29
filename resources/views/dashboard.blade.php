@extends('layouts.app')

@section('title', 'Dashboard — TaskFlow')

@section('content')

{{-- Welcome Section --}}
<div class="mb-10">
    <h1 class="text-on-surface mb-2" style="font-size:32px; font-weight:600; line-height:40px; letter-spacing:-0.02em;">
        Hello, {{ Auth::user()->name }} 👋
    </h1>
    <p class="text-on-surface-variant" style="font-size:14px; line-height:24px;">
        Here is your daily task overview. Let's make today productive.
    </p>
</div>

{{-- Task Statistics Bento Grid --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-10">

    {{-- To Do --}}
    <a href="{{ route('tasks.index', ['status' => 'todo']) }}"
       class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-[0_4px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between h-32 hover:-translate-y-0.5 transition-transform duration-200 cursor-pointer group">
        <div class="flex items-center justify-between">
            <span class="text-on-surface-variant font-medium uppercase tracking-wider" style="font-size:12px; letter-spacing:0.02em;">To Do</span>
            <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant group-hover:bg-surface-container-highest transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px;">assignment</span>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-on-surface font-semibold" style="font-size:32px; line-height:40px; letter-spacing:-0.02em;">{{ $taskCounts['todo'] }}</span>
        </div>
    </a>

    {{-- In Progress --}}
    <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}"
       class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-[0_4px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between h-32 hover:-translate-y-0.5 transition-transform duration-200 cursor-pointer group relative overflow-hidden">
        <div class="absolute inset-x-0 bottom-0 h-1 bg-primary-container opacity-40"></div>
        <div class="flex items-center justify-between">
            <span class="text-on-surface-variant font-medium uppercase tracking-wider" style="font-size:12px; letter-spacing:0.02em;">In Progress</span>
            <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-primary group-hover:bg-primary-fixed-dim transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px; font-variation-settings: 'FILL' 1;">pending</span>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-primary font-semibold" style="font-size:32px; line-height:40px; letter-spacing:-0.02em;">{{ $taskCounts['in_progress'] }}</span>
        </div>
    </a>

    {{-- Done --}}
    <a href="{{ route('tasks.index', ['status' => 'done']) }}"
       class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-[0_4px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between h-32 hover:-translate-y-0.5 transition-transform duration-200 cursor-pointer group relative overflow-hidden">
        <div class="absolute inset-x-0 bottom-0 h-1 bg-secondary opacity-30"></div>
        <div class="flex items-center justify-between">
            <span class="text-on-surface-variant font-medium uppercase tracking-wider" style="font-size:12px; letter-spacing:0.02em;">Completed</span>
            <div class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary group-hover:bg-secondary-fixed-dim transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px; font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-secondary font-semibold" style="font-size:32px; line-height:40px; letter-spacing:-0.02em;">{{ $taskCounts['done'] }}</span>
        </div>
    </a>

    {{-- Overdue --}}
    <a href="{{ route('tasks.index') }}"
       class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-[0_4px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between h-32 hover:-translate-y-0.5 transition-transform duration-200 cursor-pointer group relative overflow-hidden">
        <div class="absolute inset-x-0 bottom-0 h-1 bg-error opacity-30"></div>
        <div class="flex items-center justify-between">
            <span class="text-on-surface-variant font-medium uppercase tracking-wider" style="font-size:12px; letter-spacing:0.02em;">Overdue</span>
            <div class="w-8 h-8 rounded-full bg-error-container flex items-center justify-center text-error group-hover:bg-error/20 transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px; font-variation-settings: 'FILL' 1;">warning</span>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-error font-semibold" style="font-size:32px; line-height:40px; letter-spacing:-0.02em;">{{ $taskCounts['overdue'] }}</span>
        </div>
    </a>
</div>

{{-- Recent Tasks Section --}}
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden">

    {{-- Header --}}
    <div class="px-lg py-md border-b border-surface-variant flex items-center justify-between bg-surface-bright">
        <h3 class="text-on-surface font-semibold" style="font-size:18px; line-height:28px; letter-spacing:-0.01em;">Recent Tasks</h3>
        <a href="{{ route('tasks.create') }}"
           class="bg-primary text-on-primary text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-1.5 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
            <span class="material-symbols-outlined" style="font-size:16px;">add</span>
            New Task
        </a>
    </div>

    {{-- Recent task rows --}}
    @php
        $recentTasks = \App\Models\Task::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    @endphp

    @if($recentTasks->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center mb-4 border border-outline-variant">
                <span class="material-symbols-outlined text-primary" style="font-size:32px; opacity:0.7;">checklist</span>
            </div>
            <h3 class="text-on-surface font-semibold mb-2" style="font-size:18px;">No tasks yet</h3>
            <p class="text-on-surface-variant mb-6" style="font-size:14px;">Get started by creating your first task.</p>
            <a href="{{ route('tasks.create') }}"
               class="bg-primary text-on-primary text-sm font-medium px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors border-t border-white/20 shadow-sm">
                <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                Create First Task
            </a>
        </div>
    @else
        <div class="flex flex-col divide-y divide-surface-variant">
            @foreach($recentTasks as $task)
                @php
                    $isOverdue = $task->due_date && $task->status !== 'done' && \Carbon\Carbon::parse($task->due_date)->isPast();
                @endphp
                <div class="px-lg py-4 flex items-center justify-between hover:bg-surface-container-low transition-colors duration-200 group">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        {{-- Status dot --}}
                        @if($task->status === 'done')
                            <div class="w-5 h-5 rounded border-2 border-secondary bg-secondary flex items-center justify-center text-on-secondary shrink-0">
                                <span class="material-symbols-outlined" style="font-size:12px; font-variation-settings: 'FILL' 1;">check</span>
                            </div>
                        @else
                            <div class="w-5 h-5 rounded border-2 border-outline-variant flex items-center justify-center text-transparent hover:border-primary transition-colors shrink-0 cursor-default"></div>
                        @endif

                        <div class="min-w-0">
                            <a href="{{ route('tasks.show', $task) }}"
                               class="font-semibold text-on-surface hover:text-primary transition-colors truncate block {{ $task->status === 'done' ? 'line-through text-on-surface-variant' : '' }}"
                               style="font-size:14px;">
                                {{ $task->title }}
                            </a>
                            <div class="flex items-center gap-3 mt-0.5">
                                @if($task->category)
                                    <span class="bg-surface-variant text-on-surface-variant rounded px-2 py-0.5 flex items-center gap-1" style="font-size:11px; font-weight:500;">
                                        <span class="material-symbols-outlined" style="font-size:11px;">label</span>
                                        {{ $task->category->name }}
                                    </span>
                                @endif
                                @if($task->due_date)
                                    <span class="flex items-center gap-1 {{ $isOverdue ? 'text-error' : 'text-on-surface-variant' }}" style="font-size:13px;">
                                        <span class="material-symbols-outlined" style="font-size:13px;">calendar_today</span>
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 shrink-0">
                        {{-- Status badge --}}
                        @if($task->status === 'in_progress')
                            <span class="bg-primary-fixed text-on-primary-fixed rounded-full px-3 py-1 flex items-center gap-1" style="font-size:12px; font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
                                In Progress
                            </span>
                        @elseif($task->status === 'done')
                            <span class="bg-secondary-fixed text-on-secondary-fixed rounded-full px-3 py-1 flex items-center gap-1" style="font-size:12px; font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary inline-block"></span>
                                Done
                            </span>
                        @else
                            <span class="bg-surface-container-highest text-on-surface-variant rounded-full px-3 py-1 flex items-center gap-1 border border-outline-variant" style="font-size:12px; font-weight:500;">
                                <span class="w-1.5 h-1.5 rounded-full bg-outline inline-block"></span>
                                {{ $isOverdue ? 'Overdue' : 'To Do' }}
                            </span>
                        @endif

                        {{-- Actions --}}
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="p-1.5 rounded hover:bg-surface-variant text-on-surface-variant hover:text-on-surface transition-colors" title="Edit">
                                <span class="material-symbols-outlined" style="font-size:16px;">edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="px-lg py-3 border-t border-surface-variant bg-surface-container-low/50 flex justify-end">
            <a href="{{ route('tasks.index') }}" class="text-primary hover:underline text-sm font-medium flex items-center gap-1">
                View all tasks
                <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
            </a>
        </div>
    @endif
</div>

@endsection
