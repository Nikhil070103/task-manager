@csrf
<input name="title" value="{{ old('title', $task->title ?? '') }}" placeholder="Title" class="border w-full p-2 mb-1">
@error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

<textarea name="description" placeholder="Description" class="border w-full p-2 mt-3">{{ old('description', $task->description ?? '') }}</textarea>

@isset($task)
    <label class="block mt-3"><input type="checkbox" name="is_done" {{ $task->is_done ? 'checked' : '' }}> Done</label>
@endisset

<button class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Save</button>