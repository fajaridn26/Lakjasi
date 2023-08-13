const swal = $('.swal').data('swal');
if (swal) {
  Swal.fire({
    title: 'Data Pelaporan ',
    text: swal,
    icon: 'success'
  })
}

const users = $('.users').data('users');
if (users) {
  Swal.fire({
    title: 'Data User ',
    text: users,
    icon: 'success'
  })
}
