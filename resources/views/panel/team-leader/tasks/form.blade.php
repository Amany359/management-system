<div class="mb-3">
    <label>العنوان</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
</div>

@error('programmer_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('tester_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('status')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('priority')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('scheduled_for_date')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('original_scheduled_date')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="mb-3">
    <label>الوصف</label>
    <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>المبرمج</label>
    <select name="programmer_id" class="form-control" required>
        @foreach($programmers as $user)
            <option value="{{ $user->id }}" {{ old('programmer_id', $task->programmer_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>المختبر (اختياري)</label>
    <select name="tester_id" class="form-control">
        <option value="">-- اختر المختبر --</option>
        @foreach($testers as $user)
            <option value="{{ $user->id }}" {{ old('tester_id', $task->tester_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>الحالة</label>
    <select name="status" class="form-control" required>
        @foreach(['proposed','approved','in_progress','done','in_testing','tested_done','needs_fix'] as $status)
            <option value="{{ $status }}" {{ old('status', $task->status ?? '') == $status ? 'selected' : '' }}>
                {{ 
                    [
                        'proposed' => 'مقترحة',
                        'approved' => 'موافقة',
                        'in_progress' => 'قيد التنفيذ',
                        'done' => 'تمت',
                        'in_testing' => 'قيد الاختبار',
                        'tested_done' => 'تم الاختبار',
                        'needs_fix' => 'تحتاج لتعديل'
                    ][$status] 
                }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>الأولوية</label>
    <select name="priority" class="form-control" required>
        @foreach(['low','medium','high'] as $priority)
            <option value="{{ $priority }}" {{ old('priority', $task->priority ?? '') == $priority ? 'selected' : '' }}>
                {{ 
                    [
                        'low' => 'منخفضة',
                        'medium' => 'متوسطة',
                        'high' => 'مرتفعة'
                    ][$priority] 
                }}
            </option>
        @endforeach
    </select>
</div>


@isset($task)
    <div class="mb-3">
        <label>Scheduled For</label>
        <input type="date" name="scheduled_for_date" class="form-control" value="{{ old('scheduled_for_date', $task->scheduled_for_date ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Original Scheduled Date</label>
        <input type="date" name="original_scheduled_date" class="form-control" value="{{ old('original_scheduled_date', $task->original_scheduled_date ?? '') }}" required>
    </div>
@endisset

<button type="submit" class="btn btn-success">{{ $buttonText }}</button>

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
