document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('.delete-link');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Tugas akan terhapus selamanya!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'controller/delete.php?id=' + id;
                }
            });
        });
    });

    const taskForm = document.getElementById('taskForm');
    taskForm.addEventListener('submit', function (e) {
        const inputTugas = document.getElementById('inputTugas').value.trim();
        const inputMataKuliah = document.getElementById('inputMataKuliah').value.trim();
        const inputDeadline = document.getElementById('inputDeadline').value.trim();

        if (!inputTugas || !inputMataKuliah || !inputDeadline) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Semua kolom harus diisi!',
                icon: 'error'
            });
        }
    });

    const editLinks = document.querySelectorAll('.edit-link');
    editLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const mata_kuliah = this.getAttribute('data-mata_kuliah');
            const deadline = this.getAttribute('data-deadline');
            
            Swal.fire({
                title: 'Edit Tugas',
                html: `
                    <style>
                        .swal2-popup .form-label {
                            text-align: left;
                            display: block;
                            margin-top: 14px;
                            font-size: 16px;
                        }
                    </style>
                    <input type="hidden" id="editId" value="${id}">
                    <label for="editNama" class="form-label">Nama Tugas</label>
                    <input type="text" id="editNama" class="form-control mb-2" value="${nama}">
                    <label for="editMataKuliah" class="form-label">Mata Kuliah</label>
                    <input type="text" id="editMataKuliah" class="form-control mb-2" value="${mata_kuliah}">
                    <label for="editDeadline" class="form-label">Tanggal Deadline</label>
                    <input type="date" id="editDeadline" class="form-control" value="${deadline}">
                `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Kembali',
                preConfirm: () => {
                    const editNama = document.getElementById('editNama').value.trim();
                    const editMataKuliah = document.getElementById('editMataKuliah').value.trim();
                    const editDeadline = document.getElementById('editDeadline').value.trim();

                    if (!editNama || !editMataKuliah || !editDeadline) {
                        Swal.showValidationMessage('Semua kolom harus diisi!');
                        return false;
                    }

                    return {
                        id: id,
                        nama: editNama,
                        mata_kuliah: editMataKuliah,
                        deadline: editDeadline
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = result.value;
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'controller/update.php';
                    
                    for (const key in data) {
                        if (data.hasOwnProperty(key)) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = data[key];
                            form.appendChild(input);
                        }
                    }

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
