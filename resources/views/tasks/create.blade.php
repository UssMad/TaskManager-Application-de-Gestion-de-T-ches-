@extends('layouts.app')
@section('title', 'New Task — iTask')
@section('content')

<div class="max-w-2xl mx-auto">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-6">
        <a href="{{ route('tasks.index') }}" class="hover:text-primary transition-colors">My Tasks</a>
        <span class="material-symbols-outlined" style="font-size:14px;">chevron_right</span>
        <span class="text-on-surface font-medium">New Task</span>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden">

        {{-- Card Header --}}
        <div class="px-8 py-5 border-b border-surface-variant bg-surface-bright flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-primary-container flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary" style="font-size:18px;font-variation-settings:'FILL' 1;">add_task</span>
            </div>
            <div>
                <h1 class="text-on-surface font-semibold" style="font-size:18px;line-height:28px;letter-spacing:-0.01em;">Create New Task</h1>
                <p class="text-on-surface-variant" style="font-size:13px;">Fill in the details below to add a new task.</p>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="p-8 space-y-6">
            @csrf

            {{-- Title --}}
            <div class="flex flex-col gap-1.5">
                <label for="title" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Title <span class="text-error">*</span></label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required
                       placeholder="e.g. Prepare weekly report"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('title') border-error @enderror">
                @error('title')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div class="flex flex-col gap-1.5">
                <label for="description" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Description</label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Add more detail about this task..."
                          class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none @error('description') border-error @enderror">{{ old('description') }}</textarea>
                @error('description')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Row: Category + Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1.5">
                    <label for="category_id" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Category <span class="text-error">*</span></label>
                    <div class="relative">
                        <select id="category_id" name="category_id" required
                                class="appearance-none w-full bg-surface-container-lowest border border-outline-variant rounded-lg pl-3 pr-9 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 cursor-pointer @error('category_id') border-error @enderror">
                            <option value="">Select category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                            <option value="todo" {{ old('status', 'todo') === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" style="font-size:18px;">expand_more</span>
                    </div>
                    @error('status')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Due Date --}}
            <div class="flex flex-col gap-1.5">
                <label for="due_date" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Due Date</label>
                <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('due_date') border-error @enderror">
                @error('due_date')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2 border-t border-surface-variant">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2.5 text-sm font-medium text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container hover:text-on-surface transition-colors">
                    Cancel
                </a>
                <button type="submit" id="create-task-btn"
                        class="bg-primary text-on-primary text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                    <span class="material-symbols-outlined" style="font-size:18px;">add_task</span>
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
