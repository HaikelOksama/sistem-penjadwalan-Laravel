import './bootstrap';

Livewire.on('loadedComplete', () => {
  console.log('showed')
  $('#selectCreate').select2();
})

$('#modal-create').on('show.bs.modal', function () {
  $('.select2').select2();
})

$('#modal-edit').on('show.bs.modal', function () {
  $('.select2').select2();
})

$('.select2').on('change', function () {
  Livewire.emit('select2Changed', $(this).val());
  console.log('changed')
})

Livewire.on('confirmDelete', item => {
    Swal.fire({
        title: `Hapus ${item.nama}?`,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        confirmButtonColor: 'red',
        denyButtonText: `Don't save`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Livewire.emit('deleteDosen', item)
            Swal.fire('Aksi Berhasil', '', 'success')
        }
        })
})

Livewire.on('updated', instance => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
        Toast.fire({
          icon: 'success',
          title: `${instance} Berhasil di Update`
        })
})

Livewire.on('stored', instance => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
      
        Toast.fire({
        icon: 'success',
        title: `${instance.instance} Berhasil di Datambahkan.`
        })
    
    let state = instance.dismiss
    if(state == true) {
        $('.modal').modal('hide')
    }
    console.log(state ? 'continue' : 'end')
})



