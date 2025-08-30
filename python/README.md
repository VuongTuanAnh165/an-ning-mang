# 🛡️ Demo Ransomware trong Phòng Lab

## 📂 Cấu trúc thư mục
python/
├── lab_files/ # Chứa file giả lập để bị mã hóa
│ ├── test1.txt
│ └── test2.txt
├── ransomware.py # Script mã hóa
├── decrypt.py # Script giải mã
├── secret.key # Key bí mật (tạo sẵn)
└── README.md # Hướng dẫn

## 🚀 Cài đặt
1. Cài Python >= 3.8  
2. Cài thư viện cần thiết:
   ```bash
   pip install cryptography
🔐 Cách chạy
Bước 1: Mã hóa file
python ransomware.py
👉 Toàn bộ file trong thư mục lab_files/ sẽ bị mã hóa.

Bước 2: Giải mã file
python decrypt.py
👉 Toàn bộ file trong thư mục lab_files/ sẽ được khôi phục về trạng thái ban đầu.

⚠️ Lưu ý: Đây chỉ là demo học thuật trong môi trường lab. Tuyệt đối không dùng cho mục đích xấu.

---







Ask ChatGPT
