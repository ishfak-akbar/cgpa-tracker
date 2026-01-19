<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #051110; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#051110] overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                <h1 class="text-4xl font-bold mb-6" style="color: #34f9dc;">
                    Welcome to CGPA Tracker
                </h1>

                <p class="text-xl mb-10" style="color: #e2f3f0;">
                    You're logged in!<br>
                    Let's start tracking your academic progress.
                </p>

                <a href="{{ route('cgpa.create') }}"
                   class="inline-block px-10 py-5 text-xl font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#87e8da]/50"
                   style="
                       background: linear-gradient(135deg, #34f9dc 0%, #109884 100%);
                       color: #051110;
                       box-shadow: 0 10px 25px rgba(52, 249, 220, 0.4);
                   ">
                    Go to Add Courses Form →
                </a>

                <div class="mt-16 text-sm" style="color: #87e8da;">
                    (You will enter your semesters and grades here)
                </div>
            </div>
        </div>
    </div>
</x-app-layout>