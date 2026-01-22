<x-app-layout>
    @section('styles')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(126deg, rgba(52, 249, 220, 1) 5%, rgba(16, 152, 132, 1) 18%, rgba(5, 17, 16, 1) 59%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #ffffff;
        }

        .neon-text {
            color: #ffffff;
            text-shadow: 0 0 15px rgba(52, 249, 220, 0.4);
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #87e8da;
            opacity: 0.85;
        }

        .btn-neon {
            background: #34f9dc;
            color: #051110;
            padding: 16px 36px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border: none;
            box-shadow: 0 10px 20px rgba(16, 153, 132, 0.35);
            transition: all 0.3s;
            display: inline-block;
            text-decoration: none;
        }

        .btn-neon:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(52, 249, 220, 0.5);
        }

        .semester-card {
            margin-bottom: 40px;
            border-radius: 20px;
            overflow: hidden;
        }

        .course-row {
            display: grid;
            grid-template-columns: 1.2fr 3fr 0.9fr 1.2fr;
            gap: 20px;
            padding: 16px 28px;
            align-items: center;
            transition: background 0.2s;
        }

        .course-row:hover {
            background: rgba(52, 249, 220, 0.08);
        }

        .table-header {
            display: grid;
            grid-template-columns: 1.2fr 3fr 0.9fr 1.2fr;
            gap: 20px;
            padding: 0 28px 12px;
            border-bottom: 1px solid rgba(52, 249, 220, 0.3);
        }

        .table-header span {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            color: #34f9dc;
        }
    </style>
    @endsection

    <div style="padding: 32px 20px 100px;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 16px;">

            <!-- Cumulative CGPA + Standing -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 34px; @media (min-width: 768px) { grid-template-columns: 2fr 1fr; }">
                <div class="glass-card" style="padding: 40px; position: relative; overflow: hidden;">
                    <div style="position: relative; z-index: 10;">
                        <span class="stat-label" style="color:white;">Cumulative CGPA</span>
                        <h2 class="neon-text" style="color:white; font-size: 5rem; font-weight: 900; margin-top: 8px; line-height: 1;">
                            {{ number_format($cgpa ?? 0, 2) }}
                        </h2>
                        <p style="margin-top: 24px; color: #d1d5db; font-size: 1.125rem;">
                            You have completed 
                            <span style="color: white; font-weight: bold;">{{ number_format($totalCredits ?? 0, 1) }}</span> credits 
                            across 
                            <span style="color: white; font-weight: bold;">{{ $semesters->count() }}</span> semester/s.
                        </p>
                    </div>
                    <div style="position: absolute; right: -5px; bottom: -40px; width: 356px; height: 256px; background: #34f9dc; opacity: 0.05; border-radius: 9999px; filter: blur(64px);"></div>
                </div>

                <!-- <div class="glass-card" style="padding: 40px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                    <span class="stat-label" style="color: white;">Academic Standing</span>
                    <div style="margin-top: 16px; padding: 16px 32px; border-radius: 9999px; border: 2px dashed rgba(52, 249, 220, 0.3);">
                        <span style="font-size: 1.5rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; color: white;">
                            {{ $cgpa >= 3.5 ? 'Honors' : ($cgpa >= 2.0 ? 'Good' : 'Warning') }}
                        </span>
                    </div>
                    <a href="{{ route('cgpa.create') }}" class="btn-neon" style="padding:10px;margin-top: 32px; font-size: 0.875rem; letter-spacing: 0.08em; background:#34f9dc; border-radius:10px;">
                        + Update Record
                    </a>
                </div> -->
            </div>

            <!-- Semester Breakdown -->
            <div style="display: flex;justify-content:space-between; margin-bottom:20px">
                <div>
                    <h3 class="stat-label" style="color:white; padding: 0 8px; font-size: 18px;">Semester Breakdown</h3>
                </div>
                @if($semesters->isNotEmpty())
                <div style="text-align: center;">
                    <a href="{{ route('cgpa.create') }}" 
                    style="padding:10px;
                    font-size: 0.875rem; 
                    letter-spacing: 0.06em; 
                    background:#34f9dc; 
                    border-radius:10px;" 
                    >
                        + Add New Semester
                    </a>
                </div>
            @endif
            </div>
            

            @forelse ($semesters as $semester)
                <div style="border: 1px solid #ffffff; border-radius:10px;padding:10px 0;margin-bottom:22px;">
                    <div style="display:flex; justify-content:space-between; padding:0 45px;font-size: 32px; font-weight: 700; color: white; margin-bottom: 5px;">
                        <div>
                            <h4">
                                {{ $semester->name }}
                            </h4>
                            <span style="font-size: 15px; color: #9ca3af; text-transform: uppercase; display:block">
                                Term Performance
                            </span>
                        </div>
                        <div style="text-align: right;">
                            <span class="stat-label" style="color:white; font-size: 15px; display: block;">Term GPA</span>
                            <span>
                                {{ number_format($semester->gpa ?? 0, 2) }}
                            </span>
                        </div>
                    </div>

                    <table style="width:100%; border-collapse: collapse; background: rgba(5,17,16,0.4); border-radius: 12px; overflow: hidden;">
                        <thead>
                            <tr style="background: rgba(52,249,220,0.08); text-align:center;">
                                <th style="color:white; padding:12px 50px; font-weight:600;">Code</th>
                                <th style="color:white; padding:12px 50px; font-weight:600;">Course Title</th>
                                <th style="color:white; padding:12px 50px; font-weight:600;">Credits</th>
                                <th style="color:white; padding:12px 50px; font-weight:600;">Grade Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($semester->courses as $course)
                                <tr style="border-bottom: 1px solid rgba(52,249,220,0.15);text-align:center;">
                                    <td style="font-family: 'SF Mono', Menlo, monospace; color: #a5f3fc; font-size: 16px; padding: 12px 50px;">
                                        {{ $course->code }}
                                    </td>
                                    <td style="color: #e5e7eb; font-weight: 500; padding: 12px 50px;">
                                        {{ $course->title }}
                                    </td>
                                    <td style="color: #9ca3af; padding: 12px 50px;">
                                        {{ number_format($course->credits, 1) }}
                                    </td>
                                    <td style="font-weight: bold; color: #34f9dc; padding: 12px 50px;">
                                        {{ number_format($course->grade, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 40px 28px; text-align: center; color: rgba(255,255,255,0.6);">
                                        No courses recorded for this semester
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @empty
                <div class="glass-card" style="padding: 80px 40px; text-align: center;">
                    <p style="color: #9ca3af; font-size: 1.125rem; margin-bottom: 24px;">
                        No academic data found yet.
                    </p>
                    <a href="{{ route('cgpa.create') }}" class="btn-neon" style="padding: 14px 40px;">
                        Initialize First Term
                    </a>
                </div>
            @endforelse

            

        </div>
    </div>
</x-app-layout>