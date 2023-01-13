require('./bootstrap');

$("#frm-comment").submit(function (event) {
    event.preventDefault();
    const form = document.getElementById('frm-comment');
    let data = new FormData(form);

    axios.post('/comment', data)
        .then(function (response) {
            let result = response.data;
            Swal.fire({
                icon: 'success',
                title: 'Estado.',
                text: 'Comentario enviado y puesto en moderación',
                confirmButtonText:'Aceptar',
              })

                $( "#closeModal" ).trigger( "click" );
                $('#frm-comment')[0].reset();
        })
        .catch(error => {
            
        });
        
});

$("#frm-comment-admin").submit(function (event) {
    event.preventDefault();
    const form = document.getElementById('frm-comment-admin');
    let data = new FormData(form);

    axios.post('/admincomment', data)
        .then(function (response) {
            let result = response.data;
            window.location = '/home'
        })
        .catch(error => {
            
        });
        
});

window.deleteComment = function(comment_id) {
  Swal.fire({
    title: '¿Estas seguro que deseas borrar el comentario?',
    showDenyButton: true,
    confirmButtonText: 'Sí',
    denyButtonText: `No`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      axios.get('/admincomment/'+comment_id+'/comment/delete')
        .then(function (response) {
            let result = response.data;
            window.location = '/home'
        })
        .catch(error => {
            
        });
    }
  })
}