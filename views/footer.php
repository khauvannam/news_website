<style>
 .footer-flex a {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  overflow: hidden;
  color: inherit;
  transition: color 0.3s ease;
}

.footer-flex a .fab {
  position: relative;
  z-index: 1;
}

.footer-flex a::before {
  content: "";
  position: absolute;
  inset: 0;
  transform: translateY(-100%);
  transition: transform 0.3s ease;
  z-index: 0;
}

.footer-flex a:hover::before {
  transform: translateY(0);
}

.footer-flex a:hover {
  color: white; /* Màu icon khi hover */
}

/* Màu nền khi hover cho từng icon */
.footer-facebook::before {
  background-color: #1877f2; /* Màu xanh dương cho Facebook */
}

.footer-youtube::before {
  background-color: #ff0000; /* Màu đỏ cho YouTube */
}

.footer-tiktok::before {
  background-color: #000000; /* Màu đen cho TikTok */
}


</style>

<footer class="bg-cover bg-center h-100" style="background-image: url('<?php ROOT_URL ?>public/image/footerbackground.webp');">
  <div class="bg-black bg-opacity-70 h-full">
    <div class="max-w-7xl mx-auto text-white py-16 px-8">
      <div class="text-center mb-10">
        <h1 class="text-2xl font-bold mb-3">CÔNG TY CỔ PHẦN DỊCH VỤ DOANH NGHIỆP VINA OFFICE</h1>
        <p>Mã số thuế: 0107959367 do Sở kế hoạch và Đầu tư cấp ngày 11/08/2017</p>
        <div class="footer-flex justify-center space-x-4 mt-4">
            <a href="#" class="text-xl footer-facebook"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-xl footer-youtube"><i class="fab fa-youtube"></i></a>
            <a href="#" class="text-xl footer-tiktok"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h2 class="font-bold text-lg mb-4">THÔNG TIN LIÊN HỆ</h2>
          <p><i class="fa-solid fa-location-dot"></i> Tầng 2, Tòa nhà Detech Tower, Số 8 Tôn Thất Thuyết, Quận Nam Từ Liêm, Hà Nội</p>
          <p><i class="fa-solid fa-phone"></i> 0389 323 228</p>
          <p><i class="fa-solid fa-phone"></i> 0936 283 815</p>
          <p><i class="fa-solid fa-envelope"></i> contact@vinaoffice.com.vn</p>
        </div>
        <div>
          <h2 class="font-bold text-lg mb-4">DỊCH VỤ VĂN PHÒNG</h2>
          <ul class="space-y-2">
            <li><i class="fa-solid fa-caret-right"></i> Cho thuê văn phòng ảo</li>
            <li><i class="fa-solid fa-caret-right"></i> Cho thuê chỗ ngồi làm việc</li>
            <li><i class="fa-solid fa-caret-right"></i> Cho thuê văn phòng trọn gói</li>
            <li><i class="fa-solid fa-caret-right"></i> Cho thuê phòng họp</li>
          </ul>
        </div>
        <div>
          <h2 class="font-bold text-lg mb-4">DỊCH VỤ DOANH NGHIỆP</h2>
          <ul class="space-y-2">
            <li><i class="fa-solid fa-caret-right"></i> Thành lập công ty</li>
            <li><i class="fa-solid fa-caret-right"></i> Hóa đơn điện tử & chữ ký số</li>
            <li><i class="fa-solid fa-caret-right"></i> Dịch vụ kế toán thuế</li>
            <li><i class="fa-solid fa-caret-right"></i> Dịch vụ marketing & branding</li>
          </ul>
        </div>
        <div>
          <h2 class="font-bold text-lg mb-4">VỀ CHÚNG TÔI</h2>
          <ul class="space-y-2">
            <li><i class="fa-solid fa-caret-right"></i> Giới thiệu</li>
            <li><i class="fa-solid fa-caret-right"></i> Hồ sơ năng lực</li>
            <li><i class="fa-solid fa-caret-right"></i> Thông tin tuyển dụng</li>
            <li><i class="fa-solid fa-caret-right"></i> Tin tức & sự kiện</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="text-center text-sm bg-blue-500 text-white p-4 rounded-md">
  <p>© Copyright 2017-2024 by Vina Office. All Rights Reserved.</p>
</div>
