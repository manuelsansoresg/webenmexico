require('./bootstrap');

$("#frm-comment").submit(function (event) {
    event.preventDefault();
    const form = document.getElementById('frm-comment');
    let data = new FormData(form);

    axios.post('/comment', data)
        .then(function (response) {
           
        })
        .catch(error => {
            
        });
        
});