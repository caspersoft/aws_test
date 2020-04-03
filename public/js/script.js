document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll('.user_id').forEach(item => {

        item.addEventListener('change', event => {

            id = item.getAttribute('data-id')
            submitField(id, item.value)
            
        });

    });

});

async function submitField(id, value) {

    const formData = new FormData();
    
    formData.append('id',       id);
    formData.append('value',    value);

    let url = '/distribute'

    let response = await fetch(url,
        {
            method: 'POST',
            body: formData
        });

    let result = await response.json();
    if (result.status && result.status == 'ok') {
        alert('Пользователь назначен!');
    } else {
        alert('Error: '+result.message)
    }
}