@extends('main.master')

@section('addtohead')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- jQuery -->
    <!-- CSS for map container -->
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">فرم ثبت نام</h2>
        <form action="{{ asset('addplace') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">نام :</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">نوع مکان:</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="1">سفره‌خانه</option>
                        <option value="2">قهوه‌خانه</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12" id="map"></div>
                <div class="col-md-6">
                    <label for="country" class="form-label">کشور:</label>
                    <input type="text" class="form-control" id="country" name="country">
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">شهر:</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                {{--<div class="col-md-6">
                    <label for="county" class="form-label">شهرستان:</label>
                    <input type="text" class="form-control" id="county" name="county">
                </div>--}}
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="address" class="form-label">آدرس:</label>
                    <input type="text" class="form-control" id="address" name="address">
                    <input type="text" class="form-control" id="latitude" name="latitude" hidden>
                    <input type="text" class="form-control" id="longitude" name="longitude" hidden>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">شماره تماس:</label>
                <input type="tel" class="form-control" id="phone" name="phone">
                </div>
                <div class="col-md-6">
                    <label for="instagram" class="form-label">اینستاگرام:</label>
                    <input type="instagram" class="form-control" id="instagram" name="instagram">
                </div>
            </div>
            <div class="row md-5">
                <div class="col-md-12">
                    <label for="description" class="form-label">توضیحات و ساعات کاری:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="input-group mt-3">
                    <input type="file" class="form-control" id="inputGroupFile02" name="photo">
                    <label class="input-group-text" for="inputGroupFile02">بارگذاری عکس</label>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary col-12 mb-5">ثبت</button>
                </div>
            </div>
        </form>
            <!-- JavaScript برای نمایش نقشه و انتخاب مختصات -->
            <script>
                var map = L.map('map').setView([35.6892, 51.3890], 13); // مرکز نقشه و زوم اولیه

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                var marker = L.marker([35.6892, 51.3890], { draggable: true }).addTo(map); // اضافه کردن مارکر با قابلیت حرکت

                // بروزرسانی مختصات و اطلاعات کشور، استان، شهرستان و آدرس دقیق هنگامی که مارکر حرکت می‌کند
                marker.on('dragend', function (e) {
                    var coord = e.target.getLatLng(); // دریافت مختصات جدید مارکر
                    document.getElementById('latitude').value = coord.lat.toFixed(6); // بروزرسانی ورودی عرض جغرافیایی
                    document.getElementById('longitude').value = coord.lng.toFixed(6); // بروزرسانی ورودی طول جغرافیایی

                    // ژئوکدینگ برگشتی برای دریافت اطلاعات کشور، استان، شهرستان و آدرس دقیق
                    var url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + coord.lat + '&lon=' + coord.lng + '&accept-language=fa';
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('country').value = data.address.country || ''; // بروزرسانی ورودی کشور
                            // document.getElementById('state').value = data.address.state || ''; // بروزرسانی ورودی استان
                            document.getElementById('city').value = data.address.county || data.address.city_district || ''; // بروزرسانی ورودی شهرستان
                            document.getElementById('address').value = data.display_name || ''; // بروزرسانی ورودی آدرس دقیق
                        })
                        .catch(error => {
                            console.error('خطا در دریافت اطلاعات:', error);
                        });
                });

                // پردازش ارسال فرم (می‌توانید منطق ارسال خود را جایگزین کنید)
                document.getElementById('locationForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // جلوگیری از ارسال پیش‌فرض فرم

                    // مثال: شما می‌توانید مختصات و اطلاعات کشور، استان، شهرستان و آدرس را از طریق AJAX به سرور ارسال یا در اینجا پردازش کنید
                    var latitude = document.getElementById('latitude').value;
                    var longitude = document.getElementById('longitude').value;
                    var country = document.getElementById('country').value;
                    // var state = document.getElementById('state').value;
                    var county = document.getElementById('city').value;
                    var address = document.getElementById('address').value;
                    alert('عرض جغرافیایی: ' + latitude + ', طول جغرافیایی: ' + longitude + '\nکشور: ' + country + '\nاستان: ' + state + '\nشهرستان: ' + county + '\nآدرس دقیق: ' + address);

                    // پاک کردن ورودی‌های فرم در صورت لزوم
                    // document.getElementById('latitude').value = '';
                    // document.getElementById('longitude').value = '';
                    // document.getElementById('country').value = '';
                    // document.getElementById('state').value = '';
                    // document.getElementById('county').value = '';
                    // document.getElementById('address').value = '';
                });
            </script>

@endsection
