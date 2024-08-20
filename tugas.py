# Fungsi untuk menambahkan dua angka
def tambah(x, y):
    return x + y

# Fungsi untuk mengurangkan dua angka
def kurang(x, y):
    return x - y

# Fungsi untuk mengalikan dua angka
def kali(x, y):
    return x * y

# Fungsi untuk membagi dua angka
def bagi(x, y):
    if y != 0:
        return x / y
    else:
        return "Error: Pembagian dengan nol tidak diizinkan."

# Fungsi utama untuk menjalankan kalkulator
def kalkulator():
    print("Pilih operasi:")
    print("1. Penambahan")
    print("2. Pengurangan")
    print("3. Perkalian")
    print("4. Pembagian")

    # Meminta input dari pengguna
    pilihan = input("Masukkan pilihan (1/2/3/4): ")

    # Meminta input angka dari pengguna
    angka1 = float(input("Masukkan angka pertama: "))
    angka2 = float(input("Masukkan angka kedua: "))

    # Menentukan operasi yang dipilih dan melakukan perhitungan
    if pilihan == '1':
        print(f"Hasil: {tambah(angka1, angka2)}")
    elif pilihan == '2':
        print(f"Hasil: {kurang(angka1, angka2)}")
    elif pilihan == '3':
        print(f"Hasil: {kali(angka1, angka2)}")
    elif pilihan == '4':
        print(f"Hasil: {bagi(angka1, angka2)}")
    else:
        print("Pilihan tidak valid")

# Menjalankan kalkulator
if __name__ == "__main__":
    kalkulator()
