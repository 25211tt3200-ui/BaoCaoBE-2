CREATE DATABASE IF NOT EXISTS ai_widget CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ai_widget;

-- Dữ liệu nội bộ để AI tìm kiếm
CREATE TABLE IF NOT EXISTS knowledge_base (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  category VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Lưu câu hỏi và câu trả lời
CREATE TABLE IF NOT EXISTS chat_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_id VARCHAR(64) NOT NULL,
  question TEXT NOT NULL,
  answer MEDIUMTEXT NOT NULL,
  sources VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (session_id)
) ENGINE=InnoDB;

INSERT INTO knowledge_base (title, content, category) VALUES
('Chính sách nghỉ phép', 'Nhân viên chính thức được 12 ngày phép năm. Đơn xin nghỉ phép gửi cho quản lý trực tiếp trước ít nhất 3 ngày làm việc.', 'Nhân sự'),
('Quy trình hoàn tiền', 'Khách hàng được hoàn tiền trong 7 ngày kể từ ngày mua nếu sản phẩm lỗi. Tiền được hoàn về phương thức thanh toán ban đầu trong 5-7 ngày làm việc.', 'Chăm sóc khách hàng'),
('Giờ làm việc', 'Văn phòng làm việc từ 8:00 đến 17:30, thứ Hai đến thứ Sáu. Nghỉ trưa từ 12:00 đến 13:00.', 'Chung'),
('Hướng dẫn đặt lại mật khẩu', 'Vào trang đăng nhập, chọn "Quên mật khẩu", nhập email công ty. Liên kết đặt lại có hiệu lực 30 phút.', 'IT');
