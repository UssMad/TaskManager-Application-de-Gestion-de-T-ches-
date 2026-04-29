@extends('layouts.app')
@section('title', 'Edit Task — TaskFlow')
@section('content')

<div class="max-w-2xl mx-auto">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-6">
        <a href="{{ route('tasks.index') }}" class="hover:text-primary transition-colors">My Tasks</a>
        <span class="material-symbols-outlined" style="font-size:14px;">chevron_right</span>
        <a href="{{ route('tasks.show', $task) }}" class="hover:text-primary transition-colors truncate max-w-[200px]">{{ Str::limit($task->title, 30) }}</a>
        <span class="material-symbols-outlined" style="font-size:14px;">chevron_right</span>
        <span class="text-on-surface font-medium">Edit</span>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden">

        {{-- Card Header --}}
        <div class="px-8 py-5 border-b border-surface-variant bg-surface-bright flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-surface-container-high flex items-center justify-center">
                <span class="material-symbols-outlined text-on-surface-variant" style="font-size:18px;">edit</span>
            </div>
            <div>
                <h1 class="text-on-surface font-semibold" style="font-size:18px;line-height:28px;letter-spacing:-0.01em;">Edit Task</h1>
                <p class="text-on-surface-variant" style="font-size:13px;">Update the details of this task.</p>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('tasks.update', $task) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="flex flex-col gap-1.5">
                <label for="title" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Title <span class="text-error">*</span></label>
                <input id="title" type="text" name="title" value="{{ old('title', $task->title) }}" required
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('title') border-error @enderror">
                @error('title')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div class="flex flex-col gap-1.5">
                <label for="description" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Description</label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Add more detail about this task..."
                          class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none">{{ old('description', $task->description) }}</textarea>
                @error('description')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Category + Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1.5">
                    <label for="category_id" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Category <span class="text-error">*</span></label>
                    <div class="relative">
                        <select id="category_id" name="category_id" required
                                class="appearance-none w-full bg-surface-container-lowest border border-outline-variant rounded-lg pl-3 pr-9 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 cursor-pointer @error('category_id') border-error @enderror">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $task->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" style="font-size:18px;">expand_more</span>
                    </div>
                    @error('category_id')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="status" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Status <span class="text-error">*</span></label>
                    <div class="relative">
                        <select id="status" name="status" required
                                class="appearance-none w-full bg-surface-container-lowest border border-outline-variant rounded-lg pl-3 pr-9 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 cursor-pointer @error('status') border-error @enderror">
                            <option value="todo" {{ old('status', $task->status) === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" style="font-size:18px;">expand_more</span>
                    </div>
                    @error('status')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Due Date --}}
            <div class="flex flex-col gap-1.5">
                <label for="due_date" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Due Date</label>
                <input id="due_date" type="date" name="due_date" value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('due_date') border-error @enderror">
                @error('due_date')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-2 border-t border-surface-variant">
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" x-data x-on:submit.prevent="confirm('Delete this task permanently?') && $el.submit()">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-error border border-error-container rounded-lg hover:bg-error-container transition-colors">
                        <span class="material-symbols-outlined" style="font-size:16px;">delete</span>Delete
                    </button>
                </form>
                <div class="flex items-center gap-3">
                    <a href="{{ route('tasks.show', $task) }}" class="px-4 py-2.5 text-sm font-medium text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">Cancel</a>
                    <button type="submit" id="update-task-btn"
                            class="bg-primary text-on-primary text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                        <span class="material-symbols-outlined" style="font-size:18px;">save</span>Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
