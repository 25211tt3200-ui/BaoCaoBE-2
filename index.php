<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sao Mai Tech – Phần mềm cho doanh nghiệp Việt</title>
  <meta name="description"
    content="Đầu trâu công nghệ xây dựng website, ứng dụng và hệ thống nội bộ cho doanh nghiệp nhỏ.">
  <link rel="stylesheet" href="assets/widget.css">
  <style>
    :root {
      --ink: #14203f;
      --muted: #5a6482;
      --paper: #f6f7fb;
      --white: #fff;
      --line: #dfe3ee;
      --accent: #4f46e5;
      --accent-dark: #3d35c4;
      --mint: #d9f5ec;
      --pad: clamp(20px, 5vw, 64px);
    }

    * {
      box-sizing: border-box
    }

    html {
      scroll-behavior: smooth
    }

    body {
      margin: 0;
      background: var(--paper);
      color: var(--ink);
      font: 16px/1.65 "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif
    }

    a {
      color: inherit
    }

    :focus-visible {
      outline: 3px solid var(--accent);
      outline-offset: 3px;
      border-radius: 4px
    }

    .wrap {
      max-width: 1120px;
      margin: 0 auto;
      padding: 0 var(--pad)
    }

    /* Header */
    header {
      background: var(--white);
      border-bottom: 1px solid var(--line);
      position: sticky;
      top: 0;
      z-index: 50
    }

    header .wrap {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 64px
    }

    .logo {
      font-weight: 800;
      font-size: 20px;
      text-decoration: none;
      letter-spacing: -.3px
    }

    .logo span {
      color: var(--accent)
    }

    nav {
      display: flex;
      gap: 28px
    }

    nav a {
      text-decoration: none;
      color: var(--muted);
      font-weight: 600;
      font-size: 15px
    }

    nav a:hover {
      color: var(--ink)
    }

    /* Hero */
    .hero {
      padding: 72px 0 64px
    }

    .hero .wrap {
      display: grid;
      grid-template-columns: 1.1fr .9fr;
      gap: 56px;
      align-items: center
    }

    h1 {
      font-size: clamp(34px, 5vw, 54px);
      line-height: 1.1;
      margin: 0 0 20px;
      letter-spacing: -1.2px
    }

    .hero p {
      font-size: 18px;
      color: var(--muted);
      max-width: 30em;
      margin: 0 0 28px
    }

    .btns {
      display: flex;
      gap: 12px;
      flex-wrap: wrap
    }

    .btn {
      display: inline-block;
      padding: 13px 22px;
      border-radius: 10px;
      font-weight: 700;
      text-decoration: none;
      border: 2px solid var(--accent);
      cursor: pointer;
      font: inherit;
      font-weight: 700
    }

    .btn.primary {
      background: var(--accent);
      color: #fff
    }

    .btn.primary:hover {
      background: var(--accent-dark);
      border-color: var(--accent-dark)
    }

    .btn.ghost {
      background: transparent;
      color: var(--accent)
    }

    .btn.ghost:hover {
      background: var(--white)
    }

    /* Hội thoại mẫu trong hero */
    .demo {
      background: var(--white);
      border: 1px solid var(--line);
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 18px 40px -22px rgba(20, 32, 63, .35)
    }

    .demo-top {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--muted);
      border-bottom: 1px solid var(--line);
      padding-bottom: 12px;
      margin-bottom: 16px
    }

    .dot {
      width: 9px;
      height: 9px;
      border-radius: 50%;
      background: #2dd4a7
    }

    .bub {
      padding: 10px 14px;
      border-radius: 14px;
      margin: 0 0 12px;
      max-width: 88%;
      font-size: 15px;
      line-height: 1.5
    }

    .bub.q {
      background: var(--accent);
      color: #fff;
      margin-left: auto;
      border-bottom-right-radius: 4px
    }

    .bub.a {
      background: var(--paper);
      border-bottom-left-radius: 4px
    }

    .src {
      font-size: 12.5px;
      color: var(--muted);
      margin: -4px 0 0 4px
    }

    /* Dịch vụ */
    section {
      padding: 64px 0
    }

    h2 {
      font-size: clamp(26px, 3.5vw, 34px);
      letter-spacing: -.6px;
      margin: 0 0 8px
    }

    .lead {
      color: var(--muted);
      margin: 0 0 36px;
      max-width: 36em
    }

    .services {
      background: var(--white);
      border-top: 1px solid var(--line);
      border-bottom: 1px solid var(--line)
    }

    .svc {
      display: grid;
      grid-template-columns: 220px 1fr;
      gap: 24px;
      padding: 22px 0;
      border-top: 1px solid var(--line)
    }

    .svc:first-of-type {
      border-top: 0
    }

    .svc h3 {
      margin: 0;
      font-size: 18px
    }

    .svc p {
      margin: 0;
      color: var(--muted)
    }

    /* Về chúng tôi */
    .about .wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 56px
    }

    .about p {
      color: var(--muted);
      margin: 0 0 14px
    }

    .facts {
      list-style: none;
      margin: 0;
      padding: 0;
      display: grid;
      gap: 14px
    }

    .facts li {
      background: var(--mint);
      border-radius: 12px;
      padding: 16px 18px
    }

    .facts b {
      display: block;
      margin-bottom: 2px
    }

    /* Liên hệ */
    .contact {
      background: var(--ink);
      color: #fff
    }

    .contact .lead {
      color: #b9c1dc
    }

    .contact .row {
      display: flex;
      gap: 40px;
      flex-wrap: wrap
    }

    .contact dt {
      color: #b9c1dc;
      font-size: 14px
    }

    .contact dd {
      margin: 0 0 14px;
      font-weight: 600
    }

    footer {
      padding: 22px 0;
      text-align: center;
      color: var(--muted);
      font-size: 14px;
      background: var(--paper)
    }

    @media (max-width:820px) {

      .hero .wrap,
      .about .wrap {
        grid-template-columns: 1fr;
        gap: 36px
      }

      .svc {
        grid-template-columns: 1fr;
        gap: 6px
      }

      nav {
        display: none
      }
    }
  </style>
</head>

<body>

  <header>
    <div class="wrap">
      <a class="logo" href="#top">Đầu trâu <span>Công nghệ</span></a>
      <nav aria-label="Menu chính">
        <a href="#dich-vu">Dịch vụ</a>
        <a href="#gioi-thieu">Giới thiệu</a>
        <a href="#lien-he">Liên hệ</a>
      </nav>
    </div>
  </header>

  <main id="top">
    <div class="hero">
      <div class="wrap">
        <div>
          <h1>Phần mềm giúp doanh nghiệp làm việc nhanh hơn</h1>
          <p>Đầu trâu công nghệ xây dựng website, ứng dụng và hệ thống nội bộ cho doanh nghiệp vừa và nhỏ. Nhân viên hỏi, hệ
            thống tìm và trả lời ngay từ dữ liệu của công ty.</p>
          <div class="btns">
            <button class="btn primary" type="button" id="open-chat">Hỏi trợ lý AI</button>
            <a class="btn ghost" href="#dich-vu">Xem dịch vụ</a>
          </div>
        </div>

        <div class="demo" aria-label="Ví dụ hội thoại với trợ lý AI">
          <div class="demo-top"><span class="dot"></span> Trợ lý AI nội bộ đang hoạt động</div>
          <p class="bub q">Nghỉ phép năm được mấy ngày?</p>
          <p class="bub a">Nhân viên chính thức được 12 ngày phép năm. Đơn xin nghỉ gửi quản lý trực tiếp trước ít nhất
            3 ngày làm việc.</p>
          <p class="src">Nguồn: Chính sách nghỉ phép</p>
        </div>
      </div>
    </div>

    <section class="services" id="dich-vu">
      <div class="wrap">
        <h2>Chúng tôi làm gì</h2>
        <p class="lead">Ba mảng việc chính, từ ý tưởng đến vận hành.</p>
        <div class="svc">
          <h3>Website doanh nghiệp</h3>
          <p>Thiết kế và lập trình website giới thiệu, bán hàng, đặt lịch; tối ưu tốc độ và hiển thị trên điện thoại.
          </p>
        </div>
        <div class="svc">
          <h3>Hệ thống quản lý nội bộ</h3>
          <p>Quản lý khách hàng, kho, nhân sự, hợp đồng bằng phần mềm riêng, phù hợp quy trình của từng công ty.</p>
        </div>
        <div class="svc">
          <h3>Trợ lý AI cho dữ liệu nội bộ</h3>
          <p>Tích hợp AI để nhân viên tra cứu quy định, tài liệu và quy trình bằng cách đặt câu hỏi thông thường.</p>
        </div>
      </div>
    </section>

    <section class="about" id="gioi-thieu">
      <div class="wrap">
        <div>
          <h2>Đội ngũ nhỏ, làm việc kỹ</h2>
          <p>Đầu trâu công nghệ là công ty phần mềm tại TP. Hồ Chí Minh. Chúng tôi làm việc trực tiếp với người dùng cuối để
            phần mềm giải quyết đúng việc họ gặp hằng ngày.</p>
          <p>Mỗi dự án có một đầu mối phụ trách và lịch bàn giao rõ ràng theo từng giai đoạn.</p>
        </div>
        <ul class="facts">
          <li><b>Bàn giao từng giai đoạn</b>Bạn dùng thử và góp ý trước khi sang bước tiếp theo.</li>
          <li><b>Dữ liệu của bạn ở lại với bạn</b>Hệ thống chạy trên máy chủ do bạn chọn.</li>
          <li><b>Hỗ trợ sau triển khai</b>Có người trả lời khi hệ thống gặp sự cố.</li>
        </ul>
      </div>
    </section>

    <section class="contact" id="lien-he">
      <div class="wrap">
        <h2>Liên hệ</h2>
        <p class="lead">Mô tả ngắn việc bạn cần, chúng tôi phản hồi trong 1 ngày làm việc.</p>
        <dl class="row">
          <div>
            <dt>Email</dt>
            <dd>lienhe@dautraucongnghe.example</dd>
          </div>
          <div>
            <dt>Điện thoại</dt>
            <dd>028 1234 5678</dd>
          </div>
          <div>
            <dt>Địa chỉ</dt>
            <dd>TP. Hồ Chí Minh</dd>
          </div>
          <div>
            <dt>Giờ làm việc</dt>
            <dd>8:00 – 17:30, thứ Hai đến thứ Sáu</dd>
          </div>
        </dl>
      </div>
    </section>
  </main>

  <footer>© 2026 Đầu trâu công nghệ. Thông tin trên trang chỉ là nội dung mẫu.</footer>

  <script src="assets/widget.js"></script>
  <script>
    // Nút "Hỏi trợ lý AI" ở hero sẽ mở khung chat do widget.js tạo
    document.getElementById('open-chat').addEventListener('click', function () {
      var b = document.getElementById('aiw-btn');
      if (b) b.click();
    });
  </script>
</body>

</html>