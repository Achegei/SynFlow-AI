@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 sm:p-12">
        <div class="text-center mb-10">
            <h3 class="text-3xl font-bold text-gray-900 mb-2">Let's Connect</h3>
            <p class="text-lg text-gray-600">Share a bit about your company and goals — we’ll get back to you soon.</p>
        </div>

        <!-- The form action is set to '#' as requested. -->
        <form action="#" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Work Email</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Your Role / Title</label>
                    <input type="text" id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>

                <!-- Company Name Field -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                    <input type="text" id="company_name" name="company_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <!-- Company Website Field -->
            <div>
                <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">Website (if available)</label>
                <input type="url" id="company_website" name="company_website" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Company Size Dropdown -->
                <div>
                    <label for="company_size" class="block text-sm font-medium text-gray-700 mb-1">Number of Employees</label>
                    <select id="company_size" name="company_size" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Select company size</option>
                        <option value="Less than 20">Less than 20</option>
                        <option value="20-50">20-50</option>
                        <option value="50-100">50-100</option>
                        <option value="100-500">100-500</option>
                        <option value="More than 500">More than 500</option>
                    </select>
                </div>
                
                <!-- Annual Revenue Dropdown -->
                <div>
                    <label for="revenue" class="block text-sm font-medium text-gray-700 mb-1">Annual Revenue (approx.)</label>
                    <select id="revenue" name="revenue" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Select revenue range</option>
                        <option value="Less than $100K">Less than $100K</option>
                        <option value="$100K-$500K">$100K-$500K</option>
                        <option value="$500K-$1M">$500K-$1M</option>
                        <option value="$1M-$2M">$1M-$2M</option>
                        <option value="More than $2M">More than $2M</option>
                    </select>
                </div>

                <!-- Project Budget Dropdown -->
                <div>
                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Estimated Project Budget</label>
                    <select id="budget" name="budget" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Select budget range</option>
                        <option value="Less than $10K">Less than $10K</option>
                        <option value="$10K-$50K">$10K-$50K</option>
                        <option value="$50K-$100K">$50K-$100K</option>
                        <option value="More than $100K">More than $100K</option>
                    </select>
                </div>
            </div>

            <!-- Services Interested In Checkboxes -->
            <fieldset>
                <legend class="block text-sm font-medium text-gray-700 mb-2">Which areas can we support you with? <span class="text-red-500">*</span></legend>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="service1" name="services[]" value="Identifying AI opportunities" required class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="service1" class="ml-2 block text-sm text-gray-900">Finding the right AI opportunities</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="service2" name="services[]" value="Educating your team on AI" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="service2" class="ml-2 block text-sm text-gray-900">Training your team on AI</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="service3" name="services[]" value="Developing custom AI solutions" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-2 focus:ring-indigo-500">
                        <label for="service3" class="ml-2 block text-sm text-gray-900">Building tailored AI solutions</label>
                    </div>
                </div>
            </fieldset>

            <!-- Message Field -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Tell us more about your project or challenges</label>
                <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"></textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3 px-4 rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
