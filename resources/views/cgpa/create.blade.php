<x-guest-layout>
    @section('styles')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #34F9DC;
            background: linear-gradient(126deg, rgba(52, 249, 220, 1) 5%, rgba(16, 152, 132, 1) 18%, rgba(5, 17, 16, 1) 59%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        .card {
            background: rgba(5, 17, 16, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(52, 249, 220, 0.15);
            width: 820px;
            max-width: 96vw;
            margin: 20px auto;
        }

        .form-header h2 {
            font-size: 28px;
            margin: 0;
            color:#34F9DC;
            font-weight: 700;
            text-align: center;
        }

        .form-header p {
            color: #87e8da;
            opacity: 0.8;
            text-align: center;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Semester Picker - Dark Mode */
        .semester-picker {
            background: rgba(255, 255, 255, 0.03);
            padding: 24px;
            border-radius: 16px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 35px;
            border: 1px solid rgba(135, 232, 218, 0.1);
        }

        .course-list-header {
            display: grid;
            grid-template-columns: 1.2fr 2fr 0.8fr 1.5fr 45px;
            gap: 15px;
            padding: 0 10px 12px;
            border-bottom: 1px solid rgba(52, 249, 220, 0.3);
            margin-bottom: 15px;
        }

        .header-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            color: #34f9dc;
        }

        .course-row {
            display: grid;
            grid-template-columns: 1.2fr 2fr 0.8fr 1.5fr 45px;
            gap: 15px;
            align-items: center;
            margin-bottom: 12px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .form-input, .form-select {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(135, 232, 218, 0.2);
            border-radius: 10px;
            font-size: 14px;
            background: rgba(5, 17, 16, 0.6);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #34f9dc;
            box-shadow: 0 0 0 4px rgba(52, 249, 220, 0.1);
            background: rgba(5, 17, 16, 0.8);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2334f9dc'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .btn-add {
            background: transparent;
            color: #87e8da;
            border: 1px dashed rgba(135, 232, 218, 0.4);
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin: 10px 0 30px;
            transition: all 0.2s;
        }

        .btn-add:hover {
            border-color: #34f9dc;
            color: #34f9dc;
            background: rgba(52, 249, 220, 0.05);
        }

        .remove-btn {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 8px;
            width: 38px;
            height: 38px;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: #ef4444;
            color: white;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(90deg, #109884, #34f9dc);
            color: #051110; 
            padding: 18px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(16, 153, 132, 0.3);
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(52, 249, 220, 0.4);
            filter: brightness(1.1);
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
        }

        .back-link a {
            color: #87e8da;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .back-link a:hover {
            opacity: 1;
            text-decoration: underline;
        }
    </style>
    @endsection

    <div class="card">
        <div class="form-header">
            <h2>Add Courses</h2>
            <p>Update your academic portfolio for the new term</p>
        </div>

        <form method="POST" action="#">
            @csrf

            <div class="semester-picker">
                <div>
                    <label class="header-label" style="display:block; margin-bottom:10px;">Semester</label>
                    <select name="semester_season" class="form-select" required>
                        <option value="">Choose Semester</option>
                        <option value="Fall">Autumn</option>
                        <option value="Spring">Spring</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>
                <div>
                    <label class="header-label" style="display:block; margin-bottom:10px;">Year</label>
                    <select name="semester_year" class="form-select" required>
                        <option value="">Choose Year</option>
                        @for ($y = date('Y') - 2; $y <= date('Y') + 4; $y++)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="course-list-header">
                <span class="header-label">Code</span>
                <span class="header-label">Course Title</span>
                <span class="header-label">Credits</span>
                <span class="header-label">Grade</span>
                <span></span>
            </div>

            <div id="courses-container">
                <div class="course-row">
                    <input type="text" name="courses[0][code]" class="form-input" placeholder="SWE-101" required>
                    <input type="text" name="courses[0][title]" class="form-input" placeholder="Programming I" required>
                    <input type="number" name="courses[0][credits]" step="0.5" min="1" max="6" class="form-input" placeholder="3.0" required>
                    <select name="courses[0][grade]" class="form-select" required>
                        <option value="">Select Grade</option>
                        <option value="4.00">A+ (4.00)</option>
                        <option value="3.75">A  (3.75)</option>
                        <option value="3.50">A- (3.50)</option>
                        <option value="3.25">B+ (3.25)</option>
                        <option value="3.00">B  (3.00)</option>
                        <option value="2.75">B- (2.75)</option>
                        <option value="2.50">C+ (2.50)</option>
                        <option value="2.25">C  (2.25)</option>
                        <option value="2.00">C- (2.00)</option>
                        <option value="0.00">F  (0.00)</option>
                    </select>
                    <button type="button" class="remove-btn" style="visibility: hidden;">&times;</button>
                </div>
            </div>

            <button type="button" class="btn-add" id="add-course-btn">
                + Add Another Course
            </button>

            <button type="submit" class="btn-submit">
                Confirm & Save Records
            </button>

            <div class="back-link">
                <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
            </div>
        </form>
    </div>

    <script>
        let courseIndex = 1;
        const container = document.getElementById('courses-container');

        const gradeOptions = `
            <option value="">Select Grade</option>
            <option value="4.00">A+ (4.00)</option>
            <option value="3.75">A  (3.75)</option>
            <option value="3.50">A- (3.50)</option>
            <option value="3.25">B+ (3.25)</option>
            <option value="3.00">B  (3.00)</option>
            <option value="2.75">B- (2.75)</option>
            <option value="2.50">C+ (2.50)</option>
            <option value="2.25">C  (2.25)</option>
            <option value="2.00">C- (2.00)</option>
            <option value="0.00">F  (0.00)</option>
        `;

        document.getElementById('add-course-btn').addEventListener('click', function () {
            const newRow = document.createElement('div');
            newRow.className = 'course-row';
            newRow.innerHTML = `
                <input type="text" name="courses[${courseIndex}][code]" class="form-input" placeholder="SWE-101" required>
                <input type="text" name="courses[${courseIndex}][title]" class="form-input" placeholder="Course Title" required>
                <input type="number" name="courses[${courseIndex}][credits]" step="0.5" min="1" max="6" class="form-input" placeholder="3.0" required>
                <select name="courses[${courseIndex}][grade]" class="form-select" required>${gradeOptions}</select>
                <button type="button" class="remove-btn">&times;</button>
            `;
            container.appendChild(newRow);
            courseIndex++;
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-btn')) {
                e.target.closest('.course-row').remove();
            }
        });
    </script>
</x-guest-layout>