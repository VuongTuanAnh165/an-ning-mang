import os
from cryptography.fernet import Fernet

TARGET_DIR = "lab_files"

def load_key():
    with open("secret.key", "rb") as f:
        return f.read()

def decrypt_file(filepath, fernet):
    with open(filepath, "rb") as f:
        data = f.read()
    decrypted = fernet.decrypt(data)
    original = filepath.replace(".locked", "")
    with open(original, "wb") as f:
        f.write(decrypted)
    os.remove(filepath)

def main():
    key = load_key()
    fernet = Fernet(key)

    for root, dirs, files in os.walk(TARGET_DIR):
        for file in files:
            if file.endswith(".locked"):
                filepath = os.path.join(root, file)
                decrypt_file(filepath, fernet)

if __name__ == "__main__":
    main()
