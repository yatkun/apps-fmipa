// $('#example').DataTable({
//     // Konfigurasi opsional
//     searching: true, // Mengaktifkan fitur search bar
//     paging: true, // Mengaktifkan fitur pagination
//     info: true // Menampilkan informasi jumlah data
// });

// console.log('Hello World!');

Livewire.on('notif', () => {
    setTimeout(() => {
        const alertBox = document.getElementById('custom-alert');

        if (alertBox) {
            
            alertBox.classList.remove('hidden'); // Ensure the alert is shown
            alertBox.classList.add('fade-in'); // Apply fade-in effect

            setTimeout(() => {
                alertBox.classList.add(
                    'fade-out-up'
                ); // Tambahkan kelas opacity-0 untuk efek fade-out
                setTimeout(() => alertBox.remove(),
                    1000
                ); // Hapus elemen setelah durasi fade-out selesai (1 detik)
            }, 3000)

        }
    });
})