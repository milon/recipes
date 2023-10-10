---
image: /assets/images/contact-bg.jpg
title: যোগাযোগ
subtitle: আপনার যদি কোন প্রশ্ন থাকে, স্বাচ্ছন্দে লিখুন
---

@extends('_layouts.page')

@section('content')
    <p class="font-normal">আমি নিজে কোন প্রফেশনাল শেফ নই, তবুও আপনার মনের যেকোন প্রশ্নের উত্তর দেয়ার সর্বাত্মক চেষ্টা করবো। স্বাচ্ছন্দে প্রশ্ন করুন।</p>
    <form method="POST" action="{{ $page->contactFormUrl }}">
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>নাম</label>
                <input type="text" class="form-control" placeholder="আপনার নাম" name="name" id="name" required>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>ইমেইল ঠিকানা</label>
                <input type="email" class="form-control" placeholder="ইমেইল এড্রেস" name="email" id="email" required>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>ম্যাসেজ</label>
                <textarea rows="5" class="form-control" placeholder="আপনার ম্যাসেজ লিখুন" name="message" id="message" required></textarea>
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary font-cursive">পাঠিয়ে দিন</button>
        </div>
        <input type="text" name="_gotcha" style="display:none" />
    </form>
@endsection
