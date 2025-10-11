<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { margin-bottom: 20px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; }
        .error { color: #dc3545; font-size: 14px; margin-top: 4px; }
        .btn { padding: 10px 20px; border: none; cursor: pointer; margin-right: 8px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Class</h1>

        <form action="{{ route('classes.update', $classes) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Class Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $classes->name) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="section">Section</label>
                <input type="text" id="section" name="section" value="{{ old('section', $classes->section) }}" required>
                @error('section')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="students">Number of Students</label>
                <input type="number" id="students" name="students" value="{{ old('students', $classes->students) }}" min="1" required>
                @error('students')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="teacher">Teacher Name</label>
                <input type="text" id="teacher" name="teacher" value="{{ old('teacher', $classes->teacher) }}" required>
                @error('teacher')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Class</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>