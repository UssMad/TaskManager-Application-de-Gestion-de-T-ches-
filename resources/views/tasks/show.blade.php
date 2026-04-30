@extends('layouts.app')
@section('title', $task->title . ' — iTask')
@section('content')

@php $isOverdue = $task->due_date && $task->status !== 'done' && \Carbon\Carbon::parse($task->due_date)->isPast(); @endphp

{{-- Breadcrumb + Actions --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-2 text-sm text-on-surface-variant">
        <a href="{{ route('tasks.index') }}" class="hover:text-primary transition-colors">My Tasks</a>
        <span class="material-symbols-outlined" style="font-size:14px;">chevron_right</span>
        <span class="text-on-surface font-medium truncate max-w-xs">{{ Str::limit($task->title, 40) }}</span>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('tasks.edit', $task) }}"
           class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-on-surface border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
            <span class="material-symbols-outlined" style="font-size:16px;">edit</span>Edit
        </a>
        <form method="POST" action="{{ route('tasks.destroy', $task) }}" x-data x-on:submit.prevent="confirm('Delete this task permanently?') && $el.submit()">
            @csrf @method('DELETE')
            <button type="submit"
                    class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-error border border-error-container rounded-lg hover:bg-error-container transition-colors">
                <span class="material-symbols-outlined" style="font-size:16px;">delete</span>
            </button>
        </form>
        @if($task->status !== 'done')
            <form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="{{ $task->status === 'todo' ? 'in_progress' : 'done' }}">
                <button type="submit"
                        class="flex items-center gap-1.5 px-4 py-1.5 text-sm font-medium text-on-primary bg-primary rounded-lg hover:bg-on-primary-fixed-variant transition-colors border-t border-white/20 shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                    <span class="material-symbols-outlined" style="font-size:16px;">{{ $task->status === 'todo' ? 'play_arrow' : 'check_circle' }}</span>
                    {{ $task->status === 'todo' ? 'Start Task' : 'Mark Done' }}
                </button>
            </form>
        @endif
    </div>
</div>

{{-- Main Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left Column --}}
    <div class="lg:col-span-2 flex flex-col gap-6">

        {{-- Title + Status --}}
        <div>
            <h1 class="text-on-surface font-semibold mb-3" style="font-size:32px;line-height:40px;letter-spacing:-0.02em;">
                {{ $task->title }}
            </h1>
            <div class="flex items-center gap-3 flex-wrap">
                @if($task->status === 'in_progress')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed" style="font-size:12px;font-weight:500;">
                        <span class="material-symbols-outlined" style="font-size:12px;">schedule</span>In Progress
                    </span>
                @elseif($task->status === 'done')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed" style="font-size:12px;font-weight:500;">
                        <span class="material-symbols-outlined" style="font-size:12px;">check_circle</span>Completed
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-container-highest text-on-surface-variant border border-outline-variant" style="font-size:12px;font-weight:500;">
                        <span class="material-symbols-outlined" style="font-size:12px;">radio_button_unchecked</span>To Do
                    </span>
                @endif
                @if($isOverdue)
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-error" style="font-size:12px;font-weight:500;">
                        <span class="material-symbols-outlined" style="font-size:12px;">warning</span>Overdue
                    </span>
                @endif
            </div>
        </div>

        {{-- Description Card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 shadow-[0_4px_12px_rgba(0,0,0,0.03)]">
            <h3 class="text-on-surface font-semibold mb-4" style="font-size:18px;line-height:28px;letter-spacing:-0.01em;">Description</h3>
            @if($task->description)
                <div class="text-on-surface-variant text-sm leading-relaxed whitespace-pre-wrap">{{ $task->description }}</div>
            @else
                <p class="text-on-surface-variant text-sm italic">No description provided.</p>
            @endif
        </div>

        {{-- Quick Status Change --}}
        @if($task->status !== 'done')
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 shadow-[0_4px_12px_rgba(0,0,0,0.03)]">
            <h3 class="text-on-surface font-semibold mb-4" style="font-size:18px;line-height:28px;letter-spacing:-0.01em;">Quick Status Update</h3>
            <div class="flex items-center gap-3 flex-wrap">
                @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $val => $label)
                    <form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $val }}">
                        <button type="submit"
                                class="px-4 py-2 rounded-lg text-sm font-medium border transition-colors
                                       {{ $task->status === $val
                                          ? 'bg-primary text-on-primary border-primary shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]'
                                          : 'bg-surface-container-lowest text-on-surface-variant border-outline-variant hover:bg-surface-container hover:text-on-surface' }}">
                            {{ $label }}
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Right Column: Metadata --}}
    <div class="flex flex-col gap-6">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 shadow-[0_4px_12px_rgba(0,0,0,0.03)]">
            <h3 class="text-on-surface font-semibold mb-4 uppercase tracking-wider" style="font-size:12px;letter-spacing:0.05em;">Details</h3>
            <div class="space-y-4">

                {{-- Category --}}
                <div>
                    <span class="text-on-surface-variant block mb-1" style="font-size:12px;font-weight:500;">Category</span>
                    @if($task->category)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-surface-container-high text-on-surface-variant border border-outline-variant">
                            {{ $task->category->name }}
                        </span>
                    @else
                        <span class="text-on-surface-variant text-sm">—</span>
                    @endif
                </div>

                {{-- Due Date --}}
                <div>
                    <span class="text-on-surface-variant block mb-1" style="font-size:12px;font-weight:500;">Due Date</span>
                    @if($task->due_date)
                        <div class="flex items-center gap-1.5 text-sm {{ $isOverdue ? 'text-error font-medium' : 'text-on-surface' }}">
                            <span class="material-symbols-outlined" style="font-size:15px;">calendar_today</span>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            @if($isOverdue)<span class="text-xs font-medium">(overdue)</span>@endif
                        </div>
                    @else
                        <span class="text-on-surface-variant text-sm">No due date</span>
                    @endif
                </div>

                {{-- Created --}}
                <div>
                    <span class="text-on-surface-variant block mb-1" style="font-size:12px;font-weight:500;">Created</span>
                    <div class="text-sm text-on-surface-variant">{{ $task->created_at->format('M d, Y') }}</div>
                </div>

                {{-- Last Updated --}}
                <div>
                    <span class="text-on-surface-variant block mb-1" style="font-size:12px;font-weight:500;">Last Updated</span>
                    <div class="text-sm text-on-surface-variant">{{ $task->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        {{-- Back link --}}
        <a href="{{ route('tasks.index') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container hover:text-on-surface transition-colors">
            <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span>
            Back to Tasks
        </a>
    </div>
</div>

@endsection
